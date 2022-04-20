<?php

namespace App\Support;

use Sinergi\BrowserDetector\Browser;
use Sinergi\BrowserDetector\Device;
use Sinergi\BrowserDetector\Language;
use Sinergi\BrowserDetector\Os;

class ClientInfoDetector
{
    public const OSX = Os::OSX;
    public const IOS = Os::IOS;
    public const IPHONE = Device::IPHONE;
    public const IPAD = Device::IPAD;
    public const ANDROID = Os::ANDROID;
    public const WINDOWS_PHONE = Device::WINDOWS_PHONE;
    public const WINDOWS = Os::WINDOWS;
    public const LINUX = Os::LINUX;
    public const UNKNOWN = 'unknown';

    /**
     * @return array
     */
    public static function supportedDevices(): array
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
                'title' => __('Windows Phone (Smartphone)'),
            ],
            self::ANDROID => [
                'icon' => '<i class="bi bi-phone"></i>',
                'title' => __('Regular Smartphone or Tablet on Android'),
            ],
            self::WINDOWS => [
                'icon' => '<i class="bi bi-windows"></i>',
                'title' => __('Regular Notebook or PC'),
            ],
            self::LINUX => [
                'icon' => '🐧',
                'title' => __('Notebook, PC or other Linux-based device'),
            ],
            self::UNKNOWN => [
                'icon' => '<i class="bi bi-question"></i>',
                'title' => '',
            ],
        ];

        return $devices;
    }

    /**
     * @param string|null $userAgent
     * @return array
     */
    public static function getDevice(string $userAgent = null): array
    {
        $userAgent = $userAgent ?? request()->userAgent();

        // Return detected device by user agent
        return self::supportedDevices()[self::get($userAgent, 'detectedDevice')]
            // or 'unknown' device otherwise
            ?? self::supportedDevices()[self::UNKNOWN];
    }

    /**
     * @param string $userAgent
     * @param string|null $component
     * @return array|string
     */
    public static function get(string $userAgent, string $component = null): array|string
    {
        // 1. win -> win, lin -> lin, andr -> andr, ios -> ios
        // 2. osx -> mac/macbook/iphone/ipad

        // windows -> db1000n, ua cyber shield
        // mac/macbook -> db1000n, ua cyber shield
        // linux -> db1000n, ua cyber shield (also refer to advanced (old /ddos))

        // all others -> websites
        $device = (new Device($userAgent))->getName();
        $os = (new Os($userAgent))->getName();

        $detectedDevice = $os;
        if (
            $device !== Device::UNKNOWN &&
            in_array($os, [Os::OSX, Os::UNKNOWN], true)
        ) {
            $detectedDevice = $device;
        }

        if ($component === 'detectedDevice') {
            return $detectedDevice;
        }

        $browser = (new Browser($userAgent))->getName();
        $lang = (new Language())->getLanguage();

        if ($component) {
            return $$component;
        }

        return compact(
            'detectedDevice',
            'userAgent',
            'device',
            'os',
            'browser',
            'lang'
        );
    }
}
