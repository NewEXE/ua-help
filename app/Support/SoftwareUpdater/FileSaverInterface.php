<?php

namespace App\Support\SoftwareUpdater;

interface FileSaverInterface
{
    /**
     * @return bool Is saved successfully?
     */
    public function save(): bool;
}
