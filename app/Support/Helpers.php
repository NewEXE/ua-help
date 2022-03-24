<?php

namespace App\Support;

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
            app()->getLocale() .
            Str::start($path, '/') .
            '.blade.php'
        ;
    }
}
