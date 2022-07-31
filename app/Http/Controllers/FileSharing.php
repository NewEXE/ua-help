<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Support\Str;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class FileSharing extends Controller
{
    private const SUPPORTED_EXTENSIONS = 'mobi,txt,pdf';

    /**
     * @return View
     */
    public function index(): View
    {
        $files = File::latest()->get(['name', 'slug']);

        return view('file-sharing.index', ['files' => $files, 'supportedExtensions' => self::SUPPORTED_EXTENSIONS]);
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

        $filePath = $file->storeAs(
            'file-sharing',
            $fileName
        );
        $filePath = "app/$filePath";

        do {
            $slug = Str::lower(Str::random(3));
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

        return response()->download(storage_path($file->path), $file->name);
    }
}
