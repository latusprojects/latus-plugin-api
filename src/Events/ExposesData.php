<?php

namespace Latus\PluginAPI\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Latus\PluginAPI\Services\ExposedDataService;

class ExposesData
{
    use Dispatchable;

    protected ExposedDataService $exposedDataService;

    public function exposedDataService(): ExposedDataService
    {
        if (!isset($this->{'exposedDataService'})) {
            $this->exposedDataService = app(ExposedDataService::class);
        }

        return $this->exposedDataService;
    }
}