<?php

namespace App\Support\SoftwareUpdater\Db1000n;

use App\Support\SoftwareUpdater\FileUpdaterException;
use App\Support\SoftwareUpdater\FileUpdaterInterface;
use App\Support\SoftwareUpdater\GithubLatestRealiseCrawler;

class Db1000nUpdater implements FileUpdaterInterface
{
    private string $repoLink = 'https://github.com/Arriven/db1000n';
    private string $fileName = 'db1000n_windows_amd64.zip';
    private string $savedFilePath = 'files/db1000n.exe';

    public function __construct()
    {
        $this->savedFilePath = public_path($this->savedFilePath);
    }

    /**
     * @return bool
     * @throws FileUpdaterException
     */
    public function update(): bool
    {
        try {
            $crawler = new GithubLatestRealiseCrawler($this->repoLink, $this->fileName);
            $link = $crawler->getDownloadLink();

            return (new Db1000nSaver($link, $this->savedFilePath))->save();
        } catch (\Throwable $throwable) {
            throw FileUpdaterException::createFrom($throwable);
        }
    }
}
