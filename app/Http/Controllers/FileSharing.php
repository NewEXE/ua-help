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

        return view('file-sharing.index', [
            'files' => $files,
            'supportedExtensions' => self::SUPPORTED_EXTENSIONS
        ]);
    }

    public function upload(Request $request)
    {
        $validated = $request->validate([
            'file' => [
                'required',
                'file',
                'mimes:'.self::SUPPORTED_EXTENSIONS,
                'max:8192'
            ],
        ]);

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
        $file = File::where('slug', $fileSlug)->firstOrFail(['path', 'name']);

        header('Content-Type: text/plain');
        header(sprintf('Content-Disposition: attachment; filename="%s"', $file->name));

        return Storage::get($file->path);
//        return Storage::download($file->path, $file->name);
    }
}
