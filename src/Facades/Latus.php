<?php

namespace Latus\PluginAPI\Facades;

use Illuminate\Support\Facades\Facade;

class Latus extends Facade
{
    /**
     * @inheritDoc
     */
    protected static function getFacadeAccessor(): string
    {
        return 'latus';
    }
}