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
        return RequestFacade::segment(self::SEGMENT_INDEX, '');
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
        if (!$locale || !isset(config('app.locales', [])[$locale])) {
            $locale = config('app.fallback_locale', self::DEFAULT_LOCALE);
        }

        app()->setLocale($locale);

        return $locale;
    }

    public static function setInUri(string $uri, string $locale)
    {
        $segments = explode('/', $uri);

        $locales = array_keys(config('app.locales', []));

        if (isset($segments[1]) && in_array($segments[1], $locales, true)) {
            $segments[1] = $locale;
        } else {
            array_unshift($segments, $locale);
        }

        $segments = array_filter($segments);

        return implode('/', $segments);
    }
}
