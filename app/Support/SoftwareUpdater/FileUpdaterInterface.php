<?php

namespace App\Support\SoftwareUpdater;

interface FileUpdaterInterface
{
    public function update(): bool;
}
