<?php

namespace Latus\PluginAPI\Repositories\Cache\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

trait HasCachedItems
{

    abstract protected function getCacheKey(): string;

    protected function ensureCacheHasKeyAndItemKey(string $itemKey)
    {
        $cache = Cache::get($this->getCacheKey());

        if (!$cache) {
            Cache::put($this->getCacheKey(), []);
            $cache = Cache::get($this->getCacheKey());
        }

        if (!isset($cache[$itemKey])) {
            $cache[$itemKey] = [];
            Cache::put($this->getCacheKey(), $cache);
        }
    }

    protected function getCachedItems(string $itemKey): Collection
    {
        $this->ensureCacheHasKeyAndItemKey($itemKey);

        return collect(Cache::get($this->getCacheKey())[$itemKey]);
    }

    protected function putItemsIntoCache(array $items, string $itemKey)
    {
        $this->ensureCacheHasKeyAndItemKey($itemKey);

        $cache = Cache::get($this->getCacheKey());

        $cache[$itemKey] += $items;

        Cache::put($this->getCacheKey(), $cache);
    }
}