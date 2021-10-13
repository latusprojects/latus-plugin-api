<?php

namespace Latus\PluginAPI\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Latus\PluginAPI\Services\AssetService;

class IncludesJsAssets
{
    use Dispatchable;

    protected AssetService $assetService;

    public function assetService(): AssetService
    {
        if (!isset($this->{'assetService'})) {
            $this->assetService = app(AssetService::class);
        }

        return $this->assetService;
    }
}