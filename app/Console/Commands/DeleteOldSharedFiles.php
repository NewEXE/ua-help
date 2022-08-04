<?php

namespace App\Console\Commands;

use App\Http\Controllers\FileSharing;
use App\Models\File;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DeleteOldSharedFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:old-shared-files';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete old shared files';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $ago = now()->sub(FileSharing::DELETE_FILES_EVERY);

        $this->info('Delete shared files who are older than ' . $ago . '...');

        $oldFiles = File::where('created_at', '<', $ago)->get(['id', 'path']);

        if ($oldFiles->isEmpty()) {
            $this->info('Nothing to delete, exit.');
            return 0;
        }

        /** @var File $file */
        foreach ($oldFiles as $file) {
            Storage::delete($file->path);
        }

        $oldFiles->toQuery()->delete();

        $this->info('Done.');

        return 0;
    }
}
