<?php

namespace App\Support\SoftwareUpdater\UaCyberShield;

use App\Support\SoftwareUpdater\FileUpdaterException;
use App\Support\SoftwareUpdater\FileUpdaterInterface;
use App\Support\SoftwareUpdater\GithubLatestRealiseCrawler;

class UaCyberShieldUpdater implements FileUpdaterInterface
{
    private string $repoLink = 'https://github.com/opengs/uashield';
    private string $fileName = 'UA-Cyber-SHIELD-Setup-*.exe';
    private string $savedFilePath = 'files/UA-Cyber-SHIELD-Setup.exe';

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

            return (new UaCyberShieldSaver($link, $this->savedFilePath))->save();
        } catch (\Throwable $e) {
            throw FileUpdaterException::createFrom($e);
        }
    }
}
