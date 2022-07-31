<?php

namespace App\Console\Commands;

use App\Models\File;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
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
        /** @var Collection $oldFiles */
        $oldFiles = File::where('created_at', '<', now()
            ->sub(1, 'day'))
            ->get(['id', 'path']);

        if ($oldFiles->isEmpty()) {
            return 0;
        }

        /** @var File $file */
        foreach ($oldFiles as $file) {
            Storage::delete($file->path);
        }

        $oldFiles->toQuery()->delete();

        return 0;
    }
}
