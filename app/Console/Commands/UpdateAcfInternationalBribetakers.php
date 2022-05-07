<?php

namespace App\Console\Commands;

use App\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class UpdateAcfInternationalBribetakers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:acf';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update stored files of "List of bribetakers and warmongers"';

    /**
     * Directory path for save crawled files (in storage dir).
     *
     * @var string
     */
    private string $saveDir = 'app/acf-international-bribetakers';

    /**
     * URL for files crawling.
     *
     * @var string
     */
    private string $url = 'https://acf.international/ru/bribetakers-list';

    /**
     * Separator in filename (between file category, name, persons count).
     *
     * @var string
     */
    private string $sep = '-X-';

    /**
     * UpdateAcfInternationalBribetakers constructor.
     */
    public function __construct()
    {
        $this->saveDir = storage_path($this->saveDir);
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $this->info('Start update files from "List of bribetakers and warmongers"...');

        $res = Http::get($this->url);

        if (!$res->successful()) {
            return 1;
        }

        if ($res->body() === '') {
            return 2;
        }

        $htmlDom = new \DOMDocument();

        /**
         * "At symbol" usage:
         * prevent throwing errors when invalid HTML.
         */
        if (!@$htmlDom->loadHTML($res->body())) {
            return 3;
        }

        $json = $htmlDom->getElementById('__NEXT_DATA__');
        if ($json === null) {
            return 4;
        }
        try {
            $json = json_decode($json->nodeValue, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            return 5;
        }

        $atLeastOneSaved = false;
        foreach ($json['props']['pageProps']['villainsListRU'] ?? [] as $item) {
            $categoryName = $item['name'] ?? '';
            foreach ($item['lists'] ?? [] as $fileItem) {
                if (empty($fileItem['file'])) {
                    continue;
                }

                $res = Http::get($fileItem['file']);

                if (!$res->successful() || $res->body() === '') {
                    continue;
                }

                $fileName = $fileItem['name'];
                $fileExt = pathinfo($fileItem['file'], PATHINFO_EXTENSION);
                if (empty($fileExt)) {
                    $fileExt = 'unknown';
                }
                $filePersonsCount = $fileItem['number'];

                $fileName =
                    $categoryName.$this->sep.
                    $fileName.$this->sep.
                    $filePersonsCount.$this->sep.
                    now()->format('Y-m-d H').
                    ".$fileExt"
                ;
                $fileName = Str::toFilename($fileName);

                if (!File::put($this->saveDir.'/'.$fileName, $res->body())) {
                    continue;
                }

                $atLeastOneSaved = true;
                $this->info('Saved: ' . $fileName);
            }
        }

        if (!$atLeastOneSaved) {
            return 6;
        }

        $this->info('...done');
        return 0;
    }
}
