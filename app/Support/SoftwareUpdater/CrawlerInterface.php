<?php

namespace App\Support\SoftwareUpdater;

interface CrawlerInterface
{
    public function getDownloadLink(): string;
}
