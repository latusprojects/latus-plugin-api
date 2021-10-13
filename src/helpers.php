<?php

use Latus\PluginAPI\Latus;

if (!function_exists('latus')) {
    function latus(): Latus
    {
        return app('latus');
    }
}
