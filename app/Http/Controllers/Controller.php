<?php

namespace App\Http\Controllers;

use App\Http\Middleware\LocaleManager;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->setBasicSeo();
    }

    /**
     * Set basic SEO.
     *
     * @return void
     */
    private function setBasicSeo(): void
    {
        // Add <meta property="og:locale" /> tag
        OpenGraph::addProperty('locale', LocaleManager::getLocale());

        // Add basic keywords for all pages
        SEOMeta::addKeyword([
            'russian invasion of ukraine',
            'stop war',
            'war',
            '2022',
        ]);
    }

    /**
     * Set advanced SEO.
     *
     * @param string $title
     * @param string $description
     * @param array|string $keywords
     * @return void
     */
    protected function setSeo(string $title = '', string $description = '', array|string $keywords = [], bool $addAlternateLanguages = true): void
    {
        $title          = __($title);
        $description    = __($description);
        $keywords       = is_string($keywords) ? __($keywords) : array_map('__', $keywords);

        SEOMeta::setTitle($title)
            ->setDescription($description)
            ->addKeyword($keywords)
        ;

        OpenGraph::setTitle($title)
            ->setDescription($description)
        ;

        JsonLd::setTitle($title)
            ->setDescription($description)
        ;

        if ($addAlternateLanguages) {
            // Add <link rel="alternate"> tags
            foreach (LocaleManager::getLocalesList(true) as $locale => $language) {
                SEOMeta::addAlternateLanguage($locale, LocaleManager::addToUrl($locale));
            }
        }
    }
}
