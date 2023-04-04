<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Rules\FileSharingUpload;
use App\Support\Str;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Mime\MimeTypes;

class FileSharing extends Controller
{
    /**
     * File will have this lifetime interval, then will be deleted permanently.
     * Use supported param of @see Carbon::add() (value will be used as first param of add())
     *
     * @var string
     * @example 1 day
     * @example 8 hours
     */
    public const FILE_LIFETIME = '1 day';

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
     * Set "false" for disable limit.
     *
     * @var int|false
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
        $files = File::latest()->get(['name', 'slug', 'delete_at']);

        $supportedExtensions = $this->getSupportedExtensions();
        $maxFilesize = self::MAX_FILESIZE;

        return view('file-sharing.index', compact(
            'files',
            'supportedExtensions',
            'maxFilesize',
        ));
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
                'max:'.self::MAX_FILESIZE,
                new FileSharingUpload,
            ],
        ]);

        $totalFilesLimit = self::MAX_FILES;
        if ($totalFilesLimit !== false) {
            // Validate total files limit.
            $totalFiles = File::count();
            abort_if($totalFiles >= $totalFilesLimit, 400, 'File limit reached.');
        }

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
            'path' => $filePath,
            'delete_at' => now()->add(self::FILE_LIFETIME),
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

    /**
     * @return string
     */
    private function getSupportedExtensions(): string
    {
        $supportedExtensions = [];

        foreach (FileSharingUpload::SUPPORTED_MIMES as $mime) {
            $supportedExtensions = array_merge(
                $supportedExtensions,
                MimeTypes::getDefault()->getExtensions($mime)
            );
        }
        sort($supportedExtensions);

        return implode(', ', $supportedExtensions);
    }
}
