<?php

namespace App\Support\FileUpdater;

use App\Support\Str;
use Illuminate\Support\Facades\Http;

class GithubLatestRealiseCrawler
{
    private string $latestRealiseApiLink;
    private string $fileName;

    public function __construct(string $repoLink, string $fileName)
    {
        $repoLink = rtrim($repoLink, '/');
        $explodedRepoLink = explode('/', $repoLink);
        $repo = array_pop($explodedRepoLink);
        $owner = array_pop($explodedRepoLink);

        $this->latestRealiseApiLink = "https://api.github.com/repos/$owner/$repo/releases/latest";
        $this->fileName = $fileName;
    }

    /**
     * @throws \JsonException
     */
    public function getDownloadLink(): ?string
    {
        $response = Http::get($this->latestRealiseApiLink);
        $json = json_decode($response->body(), true, 512, JSON_THROW_ON_ERROR);

        foreach ($json['assets'] as $item) {
            $downloadUrl = $item['browser_download_url'];
            if (!Str::endsWith($downloadUrl, $this->fileName)) {
                continue;
            }

            return $downloadUrl;
        }

        return null;
    }
}
