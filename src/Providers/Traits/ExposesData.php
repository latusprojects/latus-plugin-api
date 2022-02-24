<?php

namespace Latus\PluginAPI\Providers\Traits;

use Latus\PluginAPI\Services\ExposedDataService;

trait ExposesData
{
    public function getExposedDataService(): ExposedDataService
    {
        return app(ExposedDataService::class);
    }

    public function exposeData(string $key, array $values)
    {
        $this->getExposedDataService()->expose($key, $values);
    }
}