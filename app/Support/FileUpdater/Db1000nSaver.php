<?php

namespace App\Support\FileUpdater;
use Illuminate\Support\Facades\File;

class Db1000nSaver extends FileSaver
{
    private string $filenameInZip = 'db1000n.exe';

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

        return File::copy($this->fromPath, $this->toPath);
    }
}
