<?php

namespace Latus\PluginAPI;

use Latus\PluginAPI\Services\AssetService;

class Latus
{
    public function __construct()
    {
    }

    public function assets(): AssetService
    {
        return app(AssetService::class);
    }

}