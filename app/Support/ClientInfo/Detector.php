<?php

namespace App\Support\ClientInfo;

use App\Http\Middleware\LocaleManager;
use App\Support\Str;
use Sinergi\BrowserDetector\Browser;
use Sinergi\BrowserDetector\Device;
use Sinergi\BrowserDetector\Language;
use Sinergi\BrowserDetector\Os;

class Detector
{
    public const OSX            = Os::OSX;
    public const IOS            = Os::IOS;
    public const IPHONE         = Device::IPHONE;
    public const IPAD           = Device::IPAD;
    public const ANDROID        = Os::ANDROID;
    public const WINDOWS_PHONE  = Device::WINDOWS_PHONE;
    public const WINDOWS        = Os::WINDOWS;
    public const WINDOWS_32     = Os::WINDOWS.' x86';
    public const LINUX          = Os::LINUX;
    public const CHROME_OS      = Os::CHROME_OS;
    public const UNKNOWN        = Os::UNKNOWN;

    public const SOFTWARE_TYPES = [
        self::OSX,      // db1000n, UA Cyber SHIELD
        self::WINDOWS,  // db1000n, UA Cyber SHIELD
        self::LINUX,    // db1000n, UA Cyber SHIELD, advanced tools
        self::UNKNOWN,  // Universal software (websites for DDoS)
    ];

    /**
     * @return array
     */
    private static function supportedDevices(): array
    {
        static $devices = [];

        if ($devices !== []) {
            return $devices;
        }

        $devices = [
            self::OSX => [ // Ambiguous device
                'icon' => '<i class="bi bi-apple"></i>',
                'title' => __('Apple device (iPad, iPhone, MacBook, Mac, Mac mini, iMac)'),
            ],
            self::IOS => [ // Ambiguous device
                'icon' => '<i class="bi bi-apple"></i>',
                'title' => __('Apple iPhone or iPad'),
            ],
            self::IPHONE => [
                'icon' => '<i class="bi bi-apple"></i>',
                'title' => __('Apple Smartphone'),
            ],
            self::IPAD => [
                'icon' => '<i class="bi bi-apple"></i>',
                'title' => __('Apple Tablet'),
            ],
            self::WINDOWS_PHONE => [
                'icon' => '<i class="bi-microsoft"></i>',
                'title' => __('Windows Phone Smartphone'),
            ],
            self::ANDROID => [
                'icon' => '<i class="bi bi-phone"></i>',
                'title' => __('Regular Smartphone or Tablet on Android'),
            ],
            self::WINDOWS => [
                'icon' => '<i class="bi bi-windows"></i>',
                'title' => __('Regular Notebook or PC on Windows'),
            ],
            self::WINDOWS_32 => [
                'icon' => '<i class="bi bi-windows"></i>',
                'title' => __('Old Notebook or PC on Windows'),
            ],
            self::LINUX => [
                'icon' => '🐧',
                'title' => __('Notebook, PC or other Linux-based device'),
            ],
            self::CHROME_OS => [
                'icon' => '<i class="bi bi-google"></i>',
                'title' => __('Chromebook or other Notebook/PC on Chrome OS'),
            ],
            self::UNKNOWN => [
                'icon' => '<i class="bi bi-question"></i>',
                'title' => '',
            ],
        ];

        foreach ($devices as $name => &$device) {
            $device['name'] = $name;
        }
        unset($device);

        return $devices;
    }

    /**
     * @param string $userAgent
     * @return array
     */
    public static function getDevice(string $userAgent): array
    {
        $detectedDevice = self::getDetectedDeviceName($userAgent);

        if (isset(self::supportedDevices()[$detectedDevice])) {
            // Return detected device by user agent...
            return self::supportedDevices()[$detectedDevice];
        }

        // ...otherwise return device based on 'unknown'
        // but with detected device name and changed icon
        $device = self::supportedDevices()[self::UNKNOWN];

        $device['name'] = $detectedDevice;

        if(self::getDetectedIsMobile($userAgent)) {
            $device['icon'] = '<i class="bi bi-phone"></i>';
        } else {
            $device['icon'] = '<i class="bi bi-aspect-ratio"></i>';
        }

        return $device;
    }

    /**
     * @param string $userAgent
     * @return array
     */
    public static function getAllDetected(string $userAgent): array
    {
        static $components = [
            'detectedDevice',
            'userAgent',
            'device',
            'os',
            'osVersion',
            'browser',
            'language',
            'isMobile',
            'browserVersion',
            'acceptLanguage',
        ];

        static $cache = [];
        $cacheKey = Str::slug($userAgent);
        // Trap for empty user agents
        if ($cacheKey === '') {
            $cacheKey = 'emptyUserAgent';
        }

        if (!isset($cache[$cacheKey])) {
            $device = (new Device($userAgent))->getName();

            $osDetector = new Os($userAgent);
            $os = $osDetector->getName();
            if ($os === self::WINDOWS && self::isWin32($userAgent)) {
                $os = self::WINDOWS_32;
            }

            $osVersion = $osDetector->getVersion();
            $isMobile = $osDetector->getIsMobile();

            $detectedDevice = $os;

            // Try assign most accurate device first
            if ($device !== Device::UNKNOWN) {
                $detectedDevice = $device;
            }

            $browserDetector = new Browser($userAgent);
            $browser = $browserDetector->getName();
            $browserVersion = $browserDetector->getVersion();

            $languageDetector = new Language();
            $acceptLanguage = $languageDetector->getAcceptLanguage()->getAcceptLanguageString();

            // Try to find UA locale first
            if (Str::contains(Str::lower($acceptLanguage), ['ua', 'uk'])) {
                $language = LocaleManager::UA;
            } else {
                $language = $languageDetector->getLanguage();
            }

            $cache[$cacheKey] = compact(...$components);
        }

        return $cache[$cacheKey];
    }

    /**
     * @param string $userAgent
     * @return string
     */
    public static function getDetectedDeviceName(string $userAgent): string
    {
        return self::getAllDetected($userAgent)['detectedDevice'];
    }

    /**
     * @param string $userAgent
     * @return string
     */
    private static function getDetectedIsMobile(string $userAgent): string
    {
        return self::getAllDetected($userAgent)['isMobile'];
    }

    /**
     * @param string $userAgent
     * @return string
     */
    public static function getDetectedLanguage(string $userAgent): string
    {
        return self::getAllDetected($userAgent)['language'];
    }

    /**
     * @param string $device
     * @return string
     */
    public static function getViewName(string $device): string
    {
        if ($device === self::WINDOWS_32) {
            $device = self::WINDOWS;
        }

        if (!in_array($device, self::SOFTWARE_TYPES, true)) {
            $device = self::UNKNOWN;
        }

        return 'device-'.Str::slug($device);
    }

    /**
     * @param string $device
     * @return bool
     */
    public static function isApplePhone(string $device): bool
    {
        return in_array($device, [self::IPHONE, self::IPAD, self::IOS], true);
    }

    private static function isWin32(string $userAgent): bool
    {
        return !in_array(Str::lower($userAgent), ['win64', 'wow64'], true);
    }
}
