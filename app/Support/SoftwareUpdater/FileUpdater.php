<?php

namespace App\Support\SoftwareUpdater;

abstract class FileUpdater
{
    /**
     * @return string
     */
    abstract protected function getRepoLink(): string;

    /**
     * @return string
     */
    abstract protected function getRealizeFilename(): string;

    /**
     * @return string
     */
    abstract protected function getSavedFilePath(): string;

    /**
     * @return string
     */
    protected function getCrawlerClass(): string
    {
        return GithubLatestRealiseCrawler::class;
    }

    /**
     * @return string
     */
    protected function getSaverClass(): string
    {
        return FileSaver::class;
    }

    /**
     * @return bool
     * @throws FileUpdaterException
     */
    public function update(): bool
    {
        $crawlerClass = $this->getCrawlerClass();
        $saverClass = $this->getSaverClass();

        try {
            $crawler = new $crawlerClass($this->getRepoLink(), $this->getRealizeFilename());
            $link = $crawler->getDownloadLink();

            return (new $saverClass($link, $this->getSavedFilePath()))->save();
        } catch (\Throwable $throwable) {
            throw FileUpdaterException::createFrom($throwable);
        }
    }
}
