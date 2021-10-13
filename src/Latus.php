<?php

namespace Latus\PluginAPI;

use Illuminate\Support\Traits\Macroable;
use Latus\PluginAPI\Services\AssetService;

class Latus
{
    use Macroable;

    public function __construct()
    {
    }

    public function assets(): AssetService
    {
        return app(AssetService::class);
    }

}