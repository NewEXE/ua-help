<?php

namespace App\Providers;

use App\Http\Middleware\LocaleManager;
use Illuminate\Support\ServiceProvider;

class ConfigServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Set actual locale (from request)
        config(['app.locale' => LocaleManager::getLocale()]);

        config([
            /*
             * SEOTools config post-processing
             */
            'seotools.meta.defaults.title'              => __(config('seotools.meta.defaults.title')),
            'seotools.meta.defaults.description'        => __(config('seotools.meta.defaults.description')),

            'seotools.opengraph.defaults.title'         => __(config('seotools.opengraph.defaults.title')),
            'seotools.opengraph.defaults.description'   => __(config('seotools.opengraph.defaults.description')),
            'seotools.opengraph.defaults.site_name'     => __(config('seotools.opengraph.defaults.site_name')),
            'seotools.opengraph.defaults.images'        => [
                url('/img/bg.jpg'), ['alt' => __(config('app.name'))]
            ],

            'seotools.json-ld.defaults.images'          => [url('/img/bg.jpg')],
        ]);
    }
}
