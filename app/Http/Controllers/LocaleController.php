<?php

namespace App\Http\Controllers;

use App\Http\Middleware\LocaleManager;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LocaleController extends Controller
{
    /**
     * Show the profile for a given user.
     *
     * @return RedirectResponse
     */
    public function switch(Request $request)
    {
        $locale = $request->get('locale');

        $locale = LocaleManager::set($locale);

        $prev = url()->previous();

        $prev = LocaleManager::setInUri(parse_url($prev, PHP_URL_PATH) ?? '/', $locale);

        return redirect()->to($prev);
    }
}
