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
            'How can I help Ukraine in war with Russia?', [
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
     * Resolve network issues page.
     *
     * @return \Illuminate\View\View
     */
    public function network()
    {
        $onlyOneLangVersion = true;

        $this->setSeo(
            "Якщо пропав мобільний зв'язок та як дивитися телебачення",
            'Що робити, якщо пропав мобільний звязок чи інтернет? ' .
            'Де дивитися новини шодо війни Росії з Україною? ' .
            'Які джерела достовірні та перевірені? ',
            [
                "як відновити зв'язок",
                'достовірні джерела інформації',
                'дивитися українське тв онлайн',
                'тв онлайн',
            ],
            !$onlyOneLangVersion
        );

        return view('ua.network', ['path' => 'network', 'onlyOneLangVersion' => $onlyOneLangVersion]);
    }
}
