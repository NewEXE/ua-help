<?php

namespace App\Http\Controllers;

use App\Http\Middleware\LocaleManager;
use Illuminate\Http\RedirectResponse;

class LocaleController extends Controller
{
    /**
     * Show the profile for a given user.
     *
     * @return RedirectResponse
     */
    public function switch(string $locale)
    {
        $locale = LocaleManager::set($locale);

        $prev = url()->previous();

        $prev = LocaleManager::addToUri(parse_url($prev, PHP_URL_PATH) ?? '/', $locale);

        return redirect()->to($prev);
    }
}
