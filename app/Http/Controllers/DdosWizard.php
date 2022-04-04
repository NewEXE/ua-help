<?php

namespace App\Http\Controllers;

use App\Http\Middleware\LocaleManager;
use App\Support\Helpers;
use Illuminate\Http\Request;

class DdosWizard extends Controller
{
    public function intro()
    {
        return view(LocaleManager::getLocale().'.ddos.intro', ['path' => 'ddos/intro']);
    }

    public function detectDevice(Request $request)
    {
        $device = Helpers::detectClientDevice($request);

        return view(LocaleManager::getLocale().'.ddos.detect-device', [
            'path' => 'ddos/detect-device',
            'device' => $device
        ]);
    }
}
