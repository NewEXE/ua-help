<?php

namespace App\Support\SoftwareUpdater;

class FileUpdaterException extends \RuntimeException
{
    public static function createFrom(\Throwable $throwable): static
    {
        if ($throwable instanceof static) {
            return $throwable;
        }

        return new static($throwable->getMessage(), $throwable->getCode(), $throwable);
    }
}
