<?php

namespace App\Support;

use App\Http\Middleware\LocaleManager;
use Illuminate\Http\Request;

/**
 * Misc helpers class.
 */
class Helpers
{
    public static function getViewUrlInRepository(string $path)
    {
        return
            Str::finish(config('app.repository_url'), '/') .
            'edit/master/'.
            'resources/views/' .
            LocaleManager::getLocale() .
            Str::start($path, '/') .
            '.blade.php'
        ;
    }

    /**
     * @param Request $request
     * @return string|null
     */
    public static function detectClientDevice(Request $request): ?string
    {
        $rules = [
            '/win/i'                => 'win',
            '/android/i'            => 'android',
            '/mac/i'                => 'mac',
            '/linux|ubuntu/i'       => 'linux',
            '/iphone|ipod|ipad/i'   => 'ios',
        ];

        $userAgent = $request->userAgent();
        foreach ($rules as $regex => $device) {
            if (preg_match($regex, $userAgent)) {
                return $device;
            }
        }

        return null;
    }
}
