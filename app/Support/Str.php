<?php

namespace App\Support;

use voku\helper\ASCII;

class Str extends \Illuminate\Support\Str
{
    /**
     * URL constants as defined in the PHP Manual under "Constants usable with
     * http_build_url()".
     *
     * @see http://us2.php.net/manual/en/http.constants.php#http.constants.url
     */
    public const HTTP_URL_REPLACE = 1;
    public const HTTP_URL_JOIN_PATH = 2;
    public const HTTP_URL_JOIN_QUERY = 4;
    public const HTTP_URL_STRIP_USER = 8;
    public const HTTP_URL_STRIP_PASS = 16;
    public const HTTP_URL_STRIP_AUTH = 32;
    public const HTTP_URL_STRIP_PORT = 64;
    public const HTTP_URL_STRIP_PATH = 128;
    public const HTTP_URL_STRIP_QUERY = 256;
    public const HTTP_URL_STRIP_FRAGMENT = 512;
    public const HTTP_URL_STRIP_ALL = 1024;

    /**
     * Build a URL.
     *
     * The parts of the second URL will be merged into the first according to
     * the flags argument.
     *
     * @author Jake Smith <theman@jakeasmith.com>
     * @see https://github.com/jakeasmith/http_build_url/
     *
     * @param string|array $url     (part(s) of) an URL in form of a string or
     *                       associative array like parse_url() returns
     * @param string|array $parts   same as the first argument
     * @param int   $flags   a bitmask of binary or'ed HTTP_URL constants;
     *                       HTTP_URL_REPLACE is the default
     * @param array $new_url if set, it will be filled with the parts of the
     *                       composed url like parse_url() would return
     * @return string
     */
    public static function httpBuildUrl(string|array $url, string|array $parts = [], int $flags = self::HTTP_URL_REPLACE, array &$new_url = []): string
    {
        static $builtInExists = null;

        if ($builtInExists === null) {
            $builtInExists = function_exists('http_build_url');
        }

        if ($builtInExists) {
            return http_build_url($url, $parts, $flags, $new_url);
        }

        is_array($url) || $url = parse_url($url);
        is_array($parts) || $parts = parse_url($parts);

        isset($url['query']) && is_string($url['query']) || $url['query'] = null;
        isset($parts['query']) && is_string($parts['query']) || $parts['query'] = null;

        $keys = ['user', 'pass', 'port', 'path', 'query', 'fragment'];

        // HTTP_URL_STRIP_ALL and HTTP_URL_STRIP_AUTH cover several other flags.
        if ($flags & self::HTTP_URL_STRIP_ALL) {
            $flags |= self::HTTP_URL_STRIP_USER | self::HTTP_URL_STRIP_PASS
                | self::HTTP_URL_STRIP_PORT | self::HTTP_URL_STRIP_PATH
                | self::HTTP_URL_STRIP_QUERY | self::HTTP_URL_STRIP_FRAGMENT;
        } elseif ($flags & self::HTTP_URL_STRIP_AUTH) {
            $flags |= self::HTTP_URL_STRIP_USER | self::HTTP_URL_STRIP_PASS;
        }

        // Schema and host are always replaced
        foreach (['scheme', 'host'] as $part) {
            if (isset($parts[$part])) {
                $url[$part] = $parts[$part];
            }
        }

        if ($flags & self::HTTP_URL_REPLACE) {
            foreach ($keys as $key) {
                if (isset($parts[$key])) {
                    $url[$key] = $parts[$key];
                }
            }
        } else {
            if (isset($parts['path']) && ($flags & self::HTTP_URL_JOIN_PATH)) {
                if (isset($url['path']) && !str_starts_with($parts['path'], '/')) {
                    $url['path'] = rtrim(
                            str_replace(basename($url['path']), '', $url['path']),
                            '/'
                        ) . '/' . ltrim($parts['path'], '/');
                } else {
                    $url['path'] = $parts['path'];
                }
            }

            if (isset($parts['query']) && ($flags & self::HTTP_URL_JOIN_QUERY)) {
                if (isset($url['query'])) {
                    parse_str($url['query'], $url_query);
                    parse_str($parts['query'], $parts_query);

                    $url['query'] = http_build_query(
                        array_replace_recursive(
                            $url_query,
                            $parts_query
                        )
                    );
                } else {
                    $url['query'] = $parts['query'];
                }
            }
        }

        if (isset($url['path']) && !str_starts_with($url['path'], '/')) {
            $url['path'] = '/' . $url['path'];
        }

        foreach ($keys as $key) {
            $strip = 'HTTP_URL_STRIP_' . strtoupper($key);
            if ($flags & constant(self::class . "::$strip")) {
                unset($url[$key]);
            }
        }

        $parsed_string = '';

        if (isset($url['scheme'])) {
            $parsed_string .= $url['scheme'] . '://';
        }

        if (isset($url['user'])) {
            $parsed_string .= $url['user'];

            if (isset($url['pass'])) {
                $parsed_string .= ':' . $url['pass'];
            }

            $parsed_string .= '@';
        }

        if (isset($url['host'])) {
            $parsed_string .= $url['host'];
        }

        if (isset($url['port'])) {
            $parsed_string .= ':' . $url['port'];
        }

        if (!empty($url['path'])) {
            $parsed_string .= $url['path'];
        } else {
            $parsed_string .= '/';
        }

        if (isset($url['query'])) {
            $parsed_string .= '?' . $url['query'];
        }

        if (isset($url['fragment'])) {
            $parsed_string .= '#' . $url['fragment'];
        }

        $new_url = $url;

        return $parsed_string;
    }

    /**
     * @param string $string
     * @return string
     */
    public static function toFilename(string $string): string
    {
        return ASCII::to_filename(str_replace(['/', '\\', '_'], '-', $string));
    }
}
