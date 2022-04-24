<?php

namespace App\Support;

use Sinergi\BrowserDetector\Browser;
use Sinergi\BrowserDetector\Device;
use Sinergi\BrowserDetector\Language;
use Sinergi\BrowserDetector\Os;

class ClientInfoDetector
{
    public const OSX            = Os::OSX;
    public const IOS            = Os::IOS;
    public const IPHONE         = Device::IPHONE;
    public const IPAD           = Device::IPAD;
    public const ANDROID        = Os::ANDROID;
    public const WINDOWS_PHONE  = Device::WINDOWS_PHONE;
    public const WINDOWS        = Os::WINDOWS;
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
                'title' => __('iPhone (Apple Smartphone)'),
            ],
            self::IPAD => [
                'icon' => '<i class="bi bi-apple"></i>',
                'title' => __('iPad (Apple Tablet)'),
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
     * @throws \Throwable
     */
    public static function getDevice(string $userAgent): array
    {
        $detectedDevice = self::get($userAgent, 'detectedDevice');

        if (isset(self::supportedDevices()[$detectedDevice])) {
            // Return detected device by user agent...
            return self::supportedDevices()[$detectedDevice];
        }

        // ...otherwise return device based on 'unknown'
        // but with detected device name and changed icon
        $device = self::supportedDevices()[self::UNKNOWN];

        $device['name'] = $detectedDevice;

        if((new Os($userAgent))->isMobile()) {
            $device['icon'] = '<i class="bi bi-phone"></i>';
        } else {
            $device['icon'] = '<i class="bi bi-aspect-ratio"></i>';
        }

        return $device;
    }

    /**
     * @param string $userAgent
     * @param string|null $component
     * @return array|string
     * @throws \Throwable
     */
    public static function get(string $userAgent, string $component = null): array|string
    {
        static $components = [
            'detectedDevice', 'userAgent', 'device', 'os', 'browser', 'language',
        ];

        throw_if(
            $component !== null && !in_array($component, $components, true),
            'Component must be on of: ' . implode(', ', $components)
        );

        static $cache = [];
        if (!isset($cache[$userAgent])) {
            $device = (new Device($userAgent))->getName();
            $os = (new Os($userAgent))->getName();

            $detectedDevice = $os;
            if (
                $device !== Device::UNKNOWN &&
                in_array($os, [Os::OSX, Os::UNKNOWN], true)
            ) {
                $detectedDevice = $device;
            }

            $browser = (new Browser($userAgent))->getName();
            $language = (new Language())->getLanguage();

            $cache[$userAgent] = compact(...$components);
        }

        return $component ? $cache[$userAgent][$component] : $cache[$userAgent];
    }

    /**
     * @param string $device
     * @return string
     */
    public static function getViewName(string $device): string
    {
        if (!in_array($device, self::SOFTWARE_TYPES, true)) {
            $device = self::UNKNOWN;
        }

        return 'device-'.Str::slug($device);
    }
}
