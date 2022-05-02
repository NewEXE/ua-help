<?php

namespace App\Support;

use App\Http\Middleware\LocaleManager;
use App\Support\ClientInfo\Detector;
use Illuminate\Http\Request;
use Spatie\ResponseCache\CacheProfiles\CacheAllSuccessfulGetRequests;

class CacheProfile extends CacheAllSuccessfulGetRequests
{
    public function useCacheNameSuffix(Request $request): string
    {
        return LocaleManager::getLocale() . Detector::getDetectedDeviceName($request->userAgent() ?? '');
    }
}
