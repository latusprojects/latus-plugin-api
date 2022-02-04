<?php

namespace Latus\PluginAPI\Services;

class ExposedDataService
{
    protected static array $exposedData = [];

    public function expose(string $key, array $values)
    {
        if (!isset(static::$exposedData[$key])) {
            static::$exposedData[$key] = [];
        }

        static::$exposedData[$key] += $values;
    }

    public function getExposed(): array
    {
        return static::$exposedData;
    }
}