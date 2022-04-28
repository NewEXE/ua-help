<?php

namespace App\Support;

use Illuminate\Http\Request;
use Spatie\ResponseCache\CacheProfiles\CacheAllSuccessfulGetRequests;

class CacheProfile extends CacheAllSuccessfulGetRequests
{
    public function useCacheNameSuffix(Request $request): string
    {
        return Str::slug($request->userAgent());
    }
}
