<?php

namespace App\Http\Controllers;

use App\Http\Middleware\LocaleManager;
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
        $currentLocale = LocaleManager::getLocale();
        foreach (LocaleManager::getLocalesList() as $locale => $language) {
            if ($currentLocale === $locale) continue;
            SEOMeta::addAlternateLanguage($locale, LocaleManager::addToUrl($locale));
        }
    }
}
