<?php

namespace App\Support;

use App\Http\Middleware\LocaleManager;

/**
 * Misc helpers class.
 */
class Helpers
{
    public static function getViewUrlInRepository(string $path)
    {
        return
            Str::finish(config('app.repositoryUrl'), '/') .
            'resources/views/' .
            LocaleManager::getLocale() .
            Str::start($path, '/') .
            '.blade.php'
        ;
    }
}
