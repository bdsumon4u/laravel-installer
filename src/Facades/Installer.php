<?php

namespace Hotash\Installer\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Hotash\Installer\Installer
 */
class Installer extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Hotash\Installer\Installer::class;
    }
}
