<?php

namespace App\Providers;

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
        config([
            'seotools.opengraph.defaults.images' => [
                url('/img/bg.jpg'), ['alt' => config('app.name')]
            ],
            'seotools.json-ld.defaults.images' => [url('/img/bg.jpg')],
        ]);
    }
}
