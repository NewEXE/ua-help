<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Support\Str;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileSharing extends Controller
{
    private const SUPPORTED_EXTENSIONS = 'mobi,txt,pdf';
    private const MAX_FILESIZE = '65536'; // in Kilobytes
    private const MAX_FILES = 50;

    public function __construct()
    {
        $this->middleware('doNotCacheResponse');
        parent::__construct();
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $files = File::latest()->get(['name', 'slug']);

        $supportedExtensions = self::SUPPORTED_EXTENSIONS;
        $maxFilesize = self::MAX_FILESIZE;

        return view('file-sharing.index', compact('files', 'supportedExtensions', 'maxFilesize'));
    }

    public function upload(Request $request)
    {
        $validated = $request->validate([
            'file' => [
                'required',
                'file',
                'mimes:'.self::SUPPORTED_EXTENSIONS,
                'max:'.self::MAX_FILESIZE
            ],
        ]);

        $totalFiles = File::count();

        abort_if($totalFiles >= self::MAX_FILES, 400, 'File limit reached.');

        /** @var UploadedFile $file */
        $file = $validated['file'];

        $fileName = Str::toFilename($file->getClientOriginalName());

        abort_if(File::whereName($fileName)->exists(), 400, 'File is already uploaded.');

        $filePath = Storage::putFileAs('file-sharing', $file, $fileName);

        do {
            $slug = Str::lower(Str::random(File::SLUG_LEN));
        } while(File::whereSlug($slug)->exists());

        File::create([
            'name' => $fileName,
            'slug' => $slug,
            'path' => $filePath
        ]);

        return back();
    }

    public function download(Request $request)
    {
        $fileSlug = $request->fileSlug;

        /** @var File $file */
        $file = File::whereSlug($fileSlug)->firstOrFail(['path', 'name']);

        return Storage::download($file->path, $file->name);
    }
}
