<?php

namespace App\Http\Controllers;

use App\Http\Middleware\LocaleManager;
use App\Support\ClientInfoDetector;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DdosWizard extends Controller
{
    /**
     * @return View
     */
    public function intro(): View
    {
        $onlyOneLangVersion = true;

        $this->setSeo(
            'How to DDoS Russian propaganda sites',
            'How to protect Ukraine from Russian forces in the Internet', [
                'it army',
                'it-army',
                'ukraine',
                'ddos',
                'russian propaganda',
            ],
            !$onlyOneLangVersion
        );

        return view(LocaleManager::getLocale().'.ddos.intro', ['path' => 'ddos/intro', 'onlyOneLangVersion' => $onlyOneLangVersion]);
    }

    /**
     * @param Request $request
     * @return View
     * @throws \Throwable
     */
    public function selectDevice(Request $request): View
    {
        $onlyOneLangVersion = true;

        $userAgent = $request->userAgent();

        $viewData = [
            'path' => 'ddos/select-device',
            'device' => ClientInfoDetector::getDevice($userAgent),
            'onlyOneLangVersion' => $onlyOneLangVersion,
            // add debug info
        ] + ClientInfoDetector::get($userAgent);

        return view(LocaleManager::getLocale().'.ddos.select-device', $viewData);
    }

    /**
     * @param string $device
     * @return View
     */
    public function software(string $device): View
    {
        $onlyOneLangVersion = true;

        $title = __('DDoS software for ');
        $title .= $device === ClientInfoDetector::UNKNOWN ? __('any device') : $device;

        $this->setSeo(
            $title,
            'How to DDoS Russian propaganda sites? ' .
            'Help Ukraine protect and win',
            ['ddos russians', 'ddos propaganda', 'attack aggressor sites',],
        );

        $view = ClientInfoDetector::getViewName($device);
        return view(LocaleManager::getLocale() . ".ddos.$view", ['path' => "ddos/$view", 'onlyOneLangVersion' => $onlyOneLangVersion]);
    }
}
