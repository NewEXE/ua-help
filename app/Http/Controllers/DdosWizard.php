<?php

namespace App\Http\Controllers;

use App\Http\Middleware\LocaleManager;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class DdosWizard extends Controller
{
    public function intro()
    {
        return view(LocaleManager::getLocale().'.ddos.intro', ['path' => 'ddos/intro']);
    }

    public function detectDevice(Request $request)
    {
        $device = (new Agent())->platform($request->userAgent());

        return view(LocaleManager::getLocale().'.ddos.detect-device', [
            'path' => 'ddos/detect-device',
            'device' => $device
        ]);
    }
}
