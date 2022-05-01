<?php

namespace App\Support\SoftwareUpdater\Db1000n;

use App\Support\SoftwareUpdater\FileUpdater;

class Win64Updater extends FileUpdater
{
    protected function getRepoLink(): string
    {
        return 'https://github.com/Arriven/db1000n';
    }

    protected function getRealizeFilename(): string
    {
        return 'db1000n_windows_amd64.zip';
    }

    protected function getSavedFilePath(): string
    {
        return storage_path('app/public/software/db1000n.exe');
    }

    protected function getSaverClass(): string
    {
        return Win64Saver::class;
    }
}
