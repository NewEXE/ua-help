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
        /*
         * Set basic SEO
         */

        // Add <link rel="alternate"> tags
        foreach (LocaleManager::getLocalesList(true) as $locale => $language) {
            SEOMeta::addAlternateLanguage($locale, LocaleManager::addToUrl($locale));
        }

        OpenGraph::addProperty('locale', LocaleManager::getLocale());
    }

    /**
     * @param string $title
     * @param string $description
     * @param array|string $keywords
     * @return void
     */
    protected function setSeo(string $title = '', string $description = '', array|string $keywords = [])
    {
        $title          = __($title);
        $description    = __($description);
        $keywords       = is_string($keywords) ? __($keywords) : array_map('__', $keywords);

        SEOMeta::setTitle($title)
            ->setDescription($description)
            ->setKeywords($keywords)
        ;

        OpenGraph::setTitle($title)
            ->setDescription($description)
        ;

        JsonLd::setTitle($title)
            ->setDescription($description)
        ;
    }
}
