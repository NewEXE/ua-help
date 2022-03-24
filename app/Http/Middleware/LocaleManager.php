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
            $locale = self::tryDetectLocaleByCountryCode();
        }

        if (!self::isValidLocale($locale)) {
            $locale = config('app.fallback_locale', self::DEFAULT_LOCALE);
        }

        self::setLocale($locale);

        return $next($request);
    }

    /**
     * @return string
     */
    private function tryDetectLocaleByCountryCode(): string
    {
        $ip = request()->ip();

        // No client IP so nothing to detect
        if (!$ip || !app()->isProduction()) {
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
     * @param string $locale
     * @return void
     */
    private static function setLocale(string $locale): void
    {
        if (app()->getLocale() === $locale) {
            return;
        }

        app()->setLocale($locale);
    }

    /**
     * Build URI in passed locale.
     *
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
        if ($locale && is_string($locale) && isset(self::getLocalesList()[$locale])) {
            return true;
        }

        return false;
    }

    /**
     * Build full URL in passed locale.
     *
     * @param string $locale
     * @param string|null $url Current by default
     * @return string
     */
    public static function addToUrl(string $locale, string $url = null): string
    {
        if ($url === null) {
            $url = url()->current();
        }

        $urlParts = parse_url($url);
        $urlParts['path'] = $urlParts['path'] ?? '/';

        $urlParts['path'] = '/' . LocaleManager::addToUri($urlParts['path'], $locale);

        return Str::httpBuildUrl('', $urlParts);
    }

    /**
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    public static function getLocalesList(): array
    {
        return config('app.locales', []);
    }

    public static function getLocale(): string
    {
        // Sometimes actual app()->getLocale()
        // inconsistent with locale in URL.

        $locale = app()->getLocale();
        if ($locale !== self::DEFAULT_LOCALE) {
            // App locale is not default, so is taken from URL.
            return $locale;
        }

        $locale = self::routePrefixFromRequest();

        if (!$locale) {
            // Locale in URL is not valid or empty, so fallback to default.
            $locale = self::DEFAULT_LOCALE;
        }

        return $locale;
    }
}
