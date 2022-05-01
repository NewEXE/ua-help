<?php

namespace App\Support\SoftwareUpdater\Db1000n;
use App\Support\SoftwareUpdater\FileSaver;
use App\Support\SoftwareUpdater\FileUpdaterException;
use Illuminate\Support\Facades\File;

class WinSaver extends FileSaver
{
    protected string $filenameInZip = 'db1000n.exe';

    /**
     * @return bool
     */
    public function save(): bool
    {
        if (File::mimeType($this->fromPath) !== 'application/zip') {
            throw new FileUpdaterException($this->fromPath.' must be ZIP');
        }

        $zip = new \ZipArchive();

        if (!$zip->open($this->fromPath)) {
            throw new FileUpdaterException('Open ZIP error: '.$this->fromPath);
        }

        // Unzip exe-file to cache dir
        $isExtractSuccess = $zip->extractTo($this->cacheDirPath(), $this->filenameInZip);
        $zip->close();

        if (!$isExtractSuccess) {
            throw new FileUpdaterException('Extract ZIP error');
        }

        // Move exe-file to destination

        $from = $this->cacheDirPath($this->filenameInZip);
        $to = $this->toPath;

        if (
            File::exists($to) &&
            File::size($from) === File::size($to)
        ) {
            File::delete($from);
            return true;
        }

        if (!File::move($from, $to)) {
            throw new FileUpdaterException(
                sprintf('Move failed: "%s" -> "%s"', $from, $to)
            );
        }

        return true;
    }
}
