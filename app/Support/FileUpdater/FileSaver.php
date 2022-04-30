<?php

namespace App\Support\FileUpdater;

use App\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;

abstract class FileSaver
{
    protected string $fromLink;
    protected string $fromPath;
    protected string $toPath;

    public function __construct(string $fromLink, string $toPath)
    {
        $this->fromLink = $fromLink;
        $this->toPath = $toPath;
        $this->createFromPathFile();
    }

    /**
     * @return void
     */
    private function createFromPathFile(): void
    {
        $this->fromPath = __DIR__ . '/cache/' . Str::slug($this->fromLink);
        $response = Http::get($this->fromLink);

        if (!$response->ok()) {
            throw new FileUpdaterException(
                sprintf('Response from "%s" is not OK', $this->fromLink)
            );
        }

        $fileContent = $response->body();

        if ($fileContent === '') {
            throw new FileUpdaterException('File content is empty');
        }

        if (!File::put($this->fromPath, $fileContent)) {
            throw new FileUpdaterException(sprintf('File put error (path %s)', $this->fromPath));
        }
    }

    /**
     * @return bool
     */
    abstract public function save(): bool;
}
