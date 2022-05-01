<?php

namespace App\Support\SoftwareUpdater\UaCyberShield;

use App\Support\SoftwareUpdater\FileUpdater;

class UaCyberShieldUpdater extends FileUpdater
{
    protected function getRepoLink(): string
    {
        return 'https://github.com/opengs/uashield';
    }

    protected function getRealizeFilename(): string
    {
        return 'UA-Cyber-SHIELD-Setup-*.exe';
    }

    protected function getSavedFilePath(): string
    {
        return storage_path('app/public/software/UA-Cyber-SHIELD-Setup.exe');
    }
}
