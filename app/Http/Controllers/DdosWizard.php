<?php

namespace App\Http\Controllers;

use App\Http\Middleware\LocaleManager;
use App\Http\Requests\DdosSoftwareRequest;
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
        return view(LocaleManager::getLocale().'.ddos.intro', ['path' => 'ddos/intro']);
    }

    /**
     * @param Request $request
     * @return View
     * @throws \Throwable
     */
    public function selectDevice(Request $request): View
    {
        $userAgent = $request->userAgent();

        $viewData = [
            'path' => 'ddos/select-device',
            'device' => ClientInfoDetector::getDevice($userAgent)
            // add debug info
        ] + ClientInfoDetector::get($userAgent);

        return view(LocaleManager::getLocale().'.ddos.select-device', $viewData);
    }

    /**
     * @param DdosSoftwareRequest $request
     * @return View
     */
    public function software(DdosSoftwareRequest $request): View
    {
        $device = $request->validated('device');

        $view = ClientInfoDetector::getViewName($device);
        return view(LocaleManager::getLocale() . ".ddos.$view", ['path' => "ddos/$view"]);
    }
}
