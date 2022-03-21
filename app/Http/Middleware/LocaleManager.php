<?php

namespace App\Http\Middleware;

use App\Support\Str;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Request as RequestFacade;
use Stevebauman\Location\Facades\Location;

class LocaleManager
{
    public const DEFAULT_LOCALE = 'ua';
    private const SEGMENT_INDEX = 1;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = self::routePrefixFromRequest();

        // Locale is missing in URI, try to detect country code.
        if (!$locale) {
            $locale = self::detectLocaleByCountryCode();
        }

        self::setLocale($locale);

        return $next($request);
    }

    private function detectLocaleByCountryCode(): string
    {
        $ip = request()->ip();

        // No client IP so nothing to detect
        if (!$ip || app()->environment() !== 'production') {
            return '';
        }

        // Maybe we have already detected country code?
        $cacheKey = 'detectedCountryCode_'. Str::slug($ip);
        $countryCode = Cache::get($cacheKey);

        // If nothing was cached, try to get country code
        if (!$countryCode && $position = Location::get($ip)) {
            // In case of success, format code and save to cache
            $countryCode = Str::lower($position->countryCode ?? '');

            Cache::put(
                $cacheKey,
                $countryCode,
                now()->addWeek()
            );
        }

        // If country code is here
        if ($countryCode) {
            // If code is location, set location to this code; 'en' otherwise
            return self::isValidLocale($countryCode) ? $countryCode : 'en';
        }

        return '';
    }

    /**
     * Resolve locale prefix for route.
     *
     * @return string
     */
    public static function routePrefixFromRequest(): string
    {
        $locale = RequestFacade::segment(self::SEGMENT_INDEX, '');

        if (self::isValidLocale($locale)) {
            return $locale;
        }

        return '';
    }

    /**
     * @param mixed $locale
     * @return string
     */
    private static function setLocale($locale): string
    {
        if (!self::isValidLocale($locale)) {
            $locale = config('app.fallback_locale', self::DEFAULT_LOCALE);
        }

        if (app()->getLocale() === $locale) {
            return $locale;
        }

        app()->setLocale($locale);

        return $locale;
    }

    /**
     * @param string $uri
     * @param string $locale
     * @return string
     */
    public static function addToUri(string $uri, string $locale): string
    {
        $segments = explode('/', $uri);

        if (self::isValidLocale($segments[1] ?? null)) {
            $segments[1] = $locale;
        } else {
            array_unshift($segments, $locale);
        }

        $segments = array_filter($segments);

        return implode('/', $segments);
    }

    /**
     * @param mixed $locale
     * @return bool
     */
    public static function isValidLocale(mixed $locale): bool
    {
        if ($locale && is_string($locale) && isset(config('app.locales', [])[$locale])) {
            return true;
        }

        return false;
    }
}
