<?php

namespace App\Http\Controllers;

use App\Http\Middleware\LocaleManager;
use Illuminate\Http\RedirectResponse;

class SwitchLocaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('doNotCacheResponse');
        parent::__construct();
    }

    /**
     * Switch application locale.
     *
     * @return RedirectResponse
     */
    public function __invoke(string $locale)
    {
        if (!LocaleManager::isValidLocale($locale)) {
            abort(422);
        }

        $prev = url()->previous();

        $prev = LocaleManager::addToUri(parse_url($prev, PHP_URL_PATH) ?? '/', $locale);

        return redirect()->to($prev);
    }
}
