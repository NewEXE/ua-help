<?php

namespace App\Http\Controllers;

use App\Http\Middleware\LocaleManager;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Main page.
     *
     * @return View
     */
    public function index(): View
    {
        $this->setSeo(
            'How to help Ukraine?',
            'How can I help Ukraine in war with Russia? Ukrainian Help Hub', [
                'putin',
                'aggression',
                'stand with ukraine',
                'financial support',
            ]
        );

        return view(LocaleManager::getLocale().'.index', ['path' => 'index']);
    }

    /**
     * DDoS possibilities page.
     *
     * @return View
     */
    public function ddos(): View
    {
        $this->setSeo(
            'How to DDoS Russian propaganda sites',
            'How to protect Ukraine from Russian forces in the Internet', [
                'it army',
                'it-army',
                'ukraine',
                'ddos',
                'russian propaganda',
            ]
        );

        return view(LocaleManager::getLocale().'.ddos-full', ['path' => 'ddos-full']);
    }

    /**
     * News channels page.
     *
     * @return View
     */
    public function newsChannels(): View
    {
        $onlyOneLangVersion = true;

        $this->setSeo(
            'Де дізнаватися про новини?',
            'Де дивитися новини шодо війни Росії з Україною? ' .
            'Де читати про стан війни? ' .
            'Які джерела достовірні та перевірені? ' .
            'Що робити, якщо немає українського ефірного мовлення?',
            [
                'війна',
                'новини',
                'інформація про війну',
                'достовірні джерела інформації',
                'дивитися українське тв онлайн',
                'тв онлайн',
            ],
            !$onlyOneLangVersion
        );

        return view('ua.news-channels', ['path' => 'news-channels', 'onlyOneLangVersion' => $onlyOneLangVersion]);
    }

    /**
     * "Resolve no mobile connection issue" page.
     *
     * @return View
     */
    public function noConnection(): View
    {
        $onlyOneLangVersion = true;

        $this->setSeo(
            "Якщо пропав мобільний зв'язок чи інтернет",
            'Що робити, якщо пропав мобільний звязок чи інтернет?',
            [
                "як відновити зв'язок",
                "немає зв'язку",
                "немає мобільного інтернету",
            ],
            !$onlyOneLangVersion
        );

        return view('ua.no-connection', ['path' => 'no-connection', 'onlyOneLangVersion' => $onlyOneLangVersion]);
    }

    /**
     * VPN variants page.
     *
     * @return View
     */
    public function vpn(): View
    {
        $this->setSeo(
            'How to install and use VPN',
            'How to install and use VPN? ' .
            'Best Free and Paid VPNs for support Ukraine, ' .
            'VPN with Russian country',
            ['vpn', 'free vpn', 'best vpn', 'russian vpn', 'belarus vpn'],
        );

        return view(LocaleManager::getLocale().'.ddos/vpn', ['path' => 'ddos/vpn']);
    }
}
