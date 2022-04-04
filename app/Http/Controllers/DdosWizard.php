<?php

namespace App\Http\Controllers;

use App\Http\Middleware\LocaleManager;
use Illuminate\Http\Request;
use Sinergi\BrowserDetector\Browser;
use Sinergi\BrowserDetector\Device;
use Sinergi\BrowserDetector\Language;
use Sinergi\BrowserDetector\Os;

class DdosWizard extends Controller
{
    public function intro()
    {
        return view(LocaleManager::getLocale().'.ddos.intro', ['path' => 'ddos/intro']);
    }

    public function detectDevice(Request $request)
    {
        $userAgent = $request->userAgent();
        $os = new Os($userAgent);
        $device = new Device($userAgent);
        $browser = new Browser($userAgent);
        $lang = new Language();

        return view(LocaleManager::getLocale().'.ddos.detect-device', [
            'path' => 'ddos/detect-device',
            'device' => $device,
            'os' => $os,
            'browser' => $browser,
            'lang' => $lang,
        ]);
    }
}
