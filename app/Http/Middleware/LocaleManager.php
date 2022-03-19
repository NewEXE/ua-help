<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade;

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
        self::set(self::routePrefixFromRequest());

        return $next($request);
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
     * @return string
     */
    public static function get(): string
    {
        return app()->getLocale();
    }

    /**
     * @param mixed $locale
     * @return string
     */
    public static function set($locale): string
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
     * @param $locale
     * @return bool
     */
    private static function isValidLocale($locale): bool
    {
        if ($locale && in_array($locale, array_keys(config('app.locales', [])), true)) {
            return true;
        }

        return false;
    }
}
