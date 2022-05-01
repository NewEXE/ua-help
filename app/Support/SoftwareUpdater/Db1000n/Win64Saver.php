<?php

namespace App\Support\SoftwareUpdater\Db1000n;
use App\Support\SoftwareUpdater\FileSaver;
use App\Support\SoftwareUpdater\FileUpdaterException;
use Illuminate\Support\Facades\File;

class Win64Saver extends FileSaver
{
    protected string $filenameInZip = 'db1000n.exe';

    /**
     * @return bool
     */
    public function save(): bool
    {
        if (File::mimeType($this->fromPath) !== 'application/zip') {
            throw new FileUpdaterException('Must be ZIP');
        }

        $zip = new \ZipArchive();

        if (!$zip->open($this->fromPath)) {
            throw new FileUpdaterException('Open ZIP error');
        }

        $isExtractSuccess = $zip->extractTo(dirname($this->toPath), $this->filenameInZip);

        if (!$isExtractSuccess) {
            throw new FileUpdaterException('Extract ZIP error');
        }

        $zip->close();

        return true;
    }
}
