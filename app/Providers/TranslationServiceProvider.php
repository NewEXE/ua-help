<?php

namespace App\Providers;

use App\Http\Middleware\LocaleManager;
use Illuminate\Translation\TranslationServiceProvider as BaseTranslationServiceProvider;
use Illuminate\Translation\Translator;

class TranslationServiceProvider extends BaseTranslationServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        parent::register();

        $this->app->singleton('translator', function ($app) {
            $loader = $app['translation.loader'];

            $locale = LocaleManager::getLocale();

            $trans = new Translator($loader, $locale);

            $trans->setFallback(LocaleManager::DEFAULT_LOCALE);

            return $trans;
        });
    }
}
