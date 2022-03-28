<?php

namespace App\Http\Controllers;

use App\Http\Middleware\LocaleManager;

class PageController extends Controller
{
    /**
     * Main page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $this->setSeo(
            'How to help Ukraine?',
            'How can I help Ukraine in war with Russia? Ukrainian Help Hub Ukrainian Help Hub', [
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
     * @return \Illuminate\View\View
     */
    public function ddos()
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

        return view(LocaleManager::getLocale().'.ddos', ['path' => 'ddos']);
    }

    /**
     * News channels page.
     *
     * @return \Illuminate\View\View
     */
    public function newsChannels()
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
     * @return \Illuminate\View\View
     */
    public function noConnection()
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
}
