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
     * @return string
     * @throws FileUpdaterException
     */
    public function getDownloadLink(): string
    {
        $response = Http::get($this->latestRealiseApiLink);

        if (!$response->ok()) {
            throw new FileUpdaterException(
                sprintf('Response from "%s" is not OK', $this->latestRealiseApiLink)
            );
        }

        try {
            $json = json_decode($response->body(), true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            throw new FileUpdaterException('Response has invalid JSON');
        }

        if (!is_array($json['assets'] ?? null)) {
            throw new FileUpdaterException('Unsupported JSON format');
        }

        foreach ($json['assets'] as $item) {
            $downloadUrl = $item['browser_download_url'] ?? null;
            if (!is_string($downloadUrl)) {
                throw new FileUpdaterException('Unsupported JSON format');
            }

            if (!Str::endsWith($downloadUrl, $this->fileName)) {
                continue;
            }

            return $downloadUrl;
        }

        throw new FileUpdaterException('Link not found');
    }
}
