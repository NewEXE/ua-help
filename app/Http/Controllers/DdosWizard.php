<?php

namespace App\Http\Controllers;

use App\Http\Middleware\LocaleManager;
use App\Support\ClientInfoDetector;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DdosWizard extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function intro()
    {
        return view(LocaleManager::getLocale().'.ddos.intro', ['path' => 'ddos/intro']);
    }

    /**
     * @param Request $request
     * @return View
     */
    public function selectDevice(Request $request): View
    {
        $viewData = [
            'path' => 'ddos/select-device',
            'device' => ClientInfoDetector::getDevice()
        ] + ClientInfoDetector::get($request->userAgent());

        return view(LocaleManager::getLocale().'.ddos.select-device', $viewData);
    }

    public function software(Request $request)
    {
        dump($request->all());
    }
}
