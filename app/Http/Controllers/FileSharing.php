<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Support\Str;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FileSharing extends Controller
{
    /**
     * Files will be deleted in this interval.
     * Use supported param of @see Carbon::sub() (value will be used as first of sub())
     *
     * @var string
     * @example 1 day
     * @example 8 hours
     */
    public const DELETE_FILES_EVERY = '1 day';

    /**
     * Supported extensions.
     * Use "MIME Type By File Extension" validation rule supported format.
     * @see https://laravel.com/docs/validation#rule-mimes
     *
     * @var string
     * @example mobi,txt,pdf
     */
    private const SUPPORTED_EXTENSIONS = 'mobi,txt,pdf';

    /**
     * Max filesize for each file, in kilobytes.
     *
     * @var string
     * @example 4096
     */
    private const MAX_FILESIZE = '65536';

    /**
     * Limit files count allowed in storage.
     * New file uploads over this limit will be blocked.
     *
     * @var int
     * @example 100
     */
    private const MAX_FILES = 50;

    /**
     * Directory in storage.
     * Storage by default is local filesystem: '/storage/app/'.
     *
     * @var string
     * @example For 'file-sharing' will be '/storage/app/file-sharing' (in case of local FS)
     */
    private const FILE_UPLOADS_DIR = 'file-sharing';

    public function __construct()
    {
        $this->middleware('doNotCacheResponse');
        parent::__construct();
    }

    /**
     * Show shared files list.
     *
     * @return View
     */
    public function index(): View
    {
        $files = File::latest()->get(['name', 'slug']);

        $supportedExtensions = self::SUPPORTED_EXTENSIONS;
        $maxFilesize = self::MAX_FILESIZE;

        return view('file-sharing.index', compact('files', 'supportedExtensions', 'maxFilesize'));
    }

    /**
     * Upload new file, then redirects to the back.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function upload(Request $request): RedirectResponse
    {
        // Validate input file.
        $validated = $request->validate([
            'file' => [
                'required',
                'file',
                'mimes:'.self::SUPPORTED_EXTENSIONS,
                'max:'.self::MAX_FILESIZE
            ],
        ]);

        // Validate total files limit.
        $totalFiles = File::count();
        abort_if($totalFiles >= self::MAX_FILES, 400, 'File limit reached.');

        /** @var UploadedFile $file */
        $file = $validated['file'];

        $fileName = Str::toFilename($file->getClientOriginalName());

        // Validate that the file with the same name doesn't upload yet.
        abort_if(File::whereName($fileName)->exists(), 400, 'File is already uploaded.');

        // Save to file storage
        $uploadsDir = trim(self::FILE_UPLOADS_DIR, '/\\');
        $filePath = Storage::putFileAs($uploadsDir, $file, $fileName);

        // Save to database with unique slug.
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

    /**
     * Initialize file downloading.
     *
     * @param Request $request
     * @return StreamedResponse
     */
    public function download(Request $request): StreamedResponse
    {
        $fileSlug = $request->fileSlug;

        /** @var File $file */
        $file = File::whereSlug($fileSlug)->firstOrFail(['path', 'name']);

        return Storage::download($file->path, $file->name);
    }
}
