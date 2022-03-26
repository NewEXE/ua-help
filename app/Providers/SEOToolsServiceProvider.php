<?php

namespace App\Providers;

use App\Support\SEOTools\SEOMeta;
use Artesaos\SEOTools\Providers\SEOToolsServiceProvider as BaseSEOToolsServiceProvider;
use Illuminate\Config\Repository as Config;

class SEOToolsServiceProvider extends BaseSEOToolsServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        parent::register();

        // Register custom SEOMeta class instance
        $this->app->singleton('seotools.metatags', function ($app) {
            return new SEOMeta(new Config($app['config']->get('seotools.meta', [])));
        });
    }
}
