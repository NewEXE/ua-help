<?php

namespace App\Http\Controllers;

use App\Http\Middleware\LocaleManager;
use Artesaos\SEOTools\Facades\SEOMeta;

class PageController extends Controller
{
    /**
     * Main page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        SEOMeta::setTitle(__('How to help Ukraine?'))
            ->setDescription(__('How can I help Ukraine in war with Russia?'))
            ->setKeywords([
                __('russian invasion of ukraine'),
                __('putin'),
                __('aggression'),
                __('stand with ukraine'),
                __('financial support'),
                __('stop war'),
                __('war'),
                '2022',
            ])
        ;

        return view(LocaleManager::getLocale().'.index', ['path' => 'index']);
    }

    /**
     * DDoS possibilities page.
     *
     * @return \Illuminate\View\View
     */
    public function ddos()
    {
        SEOMeta::setTitle(__('DDoS attack'))
            ->setDescription(__('How to protect Ukraine from Russian forces in the Internet?'))
            ->setKeywords([
                __('it army'),
                __('it-army'),
                __('ukraine'),
                __('ddos'),
                __('russian propaganda'),
                __('stop war'),
                __('war'),
                '2022',
            ])
        ;

        return view(LocaleManager::getLocale().'.ddos', ['path' => 'ddos']);
    }
}
