<?php

namespace App\Support\FileUpdater;

class Db1000nUpdater implements FileUpdaterInterface
{
    public function update(): void
    {
        $crawler = new GithubLatestRealiseCrawler(
            'https://github.com/Arriven/db1000n',
            'db1000n_windows_amd64.zip'
        );
        $link = $crawler->getDownloadLink();

        $zip = new \ZipArchive();

        if ($zip->open($link) !== true) {
            exit("Невозможно открыть <$link>\n");
        }


    }
}
