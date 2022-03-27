<?php

namespace App\Http\Controllers;

use App\Http\Middleware\LocaleManager;

class PageController extends Controller
{
    /**
     * Main page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $this->setSeo(
            'How to help Ukraine?',
            'How can I help Ukraine in war with Russia?', [
                'russian invasion of ukraine',
                'putin',
                'aggression',
                'stand with ukraine',
                'financial support',
                'stop war',
                'war',
                '2022',
            ]
        );

        return view(LocaleManager::getLocale().'.index', ['path' => 'index']);
    }

    /**
     * DDoS possibilities page.
     *
     * @return \Illuminate\View\View
     */
    public function ddos()
    {
        $this->setSeo(
            'How to DDoS Russian propaganda sites',
            'How to protect Ukraine from Russian forces in the Internet', [
                'it army',
                'it-army',
                'ukraine',
                'ddos',
                'russian propaganda',
                'stop war',
                'war',
                '2022',
            ]
        );

        return view(LocaleManager::getLocale().'.ddos', ['path' => 'ddos']);
    }
}
