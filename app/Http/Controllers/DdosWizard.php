<?php

namespace App\Http\Controllers;

use App\Support\ClientInfo\Detector;
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

        return view('ua.ddos.intro', ['path' => 'ddos/intro', 'onlyOneLangVersion' => $onlyOneLangVersion]);
    }

    /**
     * @param Request $request
     * @return View
     */
    public function selectDevice(Request $request): View
    {
        $onlyOneLangVersion = true;

        $userAgent = $request->userAgent() ?? '';

        $viewData = [
            'path' => 'ddos/select-device',
            'device' => Detector::getDevice($userAgent),
            'onlyOneLangVersion' => $onlyOneLangVersion,
            // add debug info
        ] + Detector::getAllDetected($userAgent);

        return view('ua.ddos.select-device', $viewData);
    }

    /**
     * @param string $device
     * @return View
     */
    public function software(string $device): View
    {
        $onlyOneLangVersion = true;

        $title = __('DDoS software for ');
        $title .= $device === Detector::UNKNOWN ? __('any device') : $device;

        $this->setSeo(
            $title,
            'How to DDoS Russian propaganda sites? ' .
            'Help Ukraine protect and win',
            ['ddos russians', 'ddos propaganda', 'attack aggressor sites',],
        );

        $torData = [
            'name' => 'Tor Browser',
            'link' => 'https://www.torproject.org/ru/download/',
        ];

        // For iPhone, iPad and any other iOS device
        // there is an Onion Browser instead of Tor
        if (Detector::isApplePhone($device)) {
            $torData = [
                'name' => 'Onion Browser',
                'link' => 'https://apps.apple.com/ru/app/onion-browser/id519296448',
            ];
        }

        $view = Detector::getViewName($device);
        return view("ua.ddos.$view", [
            'path' => "ddos/$view",
            'onlyOneLangVersion' => $onlyOneLangVersion,
            'torData' => $torData,
            'device' => $device
        ]);
    }
}
