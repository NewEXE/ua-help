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
        $os = (new Os($userAgent))->getName();
        $device = (new Device($userAgent))->getName();

        $detectedDevice = $os;
        if ($device !== Device::UNKNOWN && in_array($detectedDevice, [Os::OSX, Os::UNKNOWN], true)) {
            $detectedDevice = $device;
        }

        $browser = (new Browser($userAgent))->getName();
        $lang = (new Language())->getLanguage();

        return view(LocaleManager::getLocale().'.ddos.detect-device', [
            'path' => 'ddos/detect-device',
            'detectedDevice' => $detectedDevice,

            'userAgent' => $userAgent,
            'device' => $device,
            'os' => $os,
            'browser' => $browser,
            'lang' => $lang,
        ]);
    }
}
