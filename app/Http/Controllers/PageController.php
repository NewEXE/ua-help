<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    /**
     * Main page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view(app()->getLocale().'.index', ['path' => 'index']);
    }

    /**
     * DDoS possibilities page.
     *
     * @return \Illuminate\View\View
     */
    public function ddos()
    {
        return view(app()->getLocale().'.ddos', ['path' => 'ddos']);
    }
}
