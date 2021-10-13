<?php

namespace Latus\PluginAPI\Repositories\Cache;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Latus\PluginAPI\Repositories\Contracts\AssetRepository as AssetRepositoryContract;

class AssetRepository implements AssetRepositoryContract
{
    protected const CACHE_KEY = 'latus-assets';

    public function attachCss(string $url, string $place = self::PLACE_START, array $tags = null, \Closure $shouldShow = null)
    {
        if (!$shouldShow || app()->call($shouldShow)) {

            $tags = $tags ?? [];
            $tags[] = 'place.' . $place;

            $this->putItemIntoCache([
                'url' => $url,
                'place' => $place,
                'tags' => $tags ?? [],
            ], 'css');
        }
    }

    public function attachJs(string $url, string $place = self::PLACE_START, array $tags = null, bool $defer = false, \Closure $shouldShow = null)
    {
        if (!$shouldShow || app()->call($shouldShow)) {

            $tags = $tags ?? [];
            $tags[] = 'place.' . $place;

            if ($defer) {
                $tags[] = 'defer';
            }

            $this->putItemIntoCache([
                'url' => $url,
                'place' => $place,
                'tags' => $tags,
            ], 'js');
        }
    }

    public function getCss(array $tags = null): Collection
    {
        $cachedItems = $this->getCachedItems('css');

        return $this->filterItemsByTags($cachedItems, $tags);
    }

    public function getJs(array $tags = null): Collection
    {
        $cachedItems = $this->getCachedItems('js');

        return $this->filterItemsByTags($cachedItems, $tags);
    }

    protected function filterItemsByTags(Collection $unfilteredItems, array $tags = null): Collection
    {
        if (!$tags) {
            return $unfilteredItems;
        }

        $taggedItems = collect();

        foreach ($unfilteredItems as $unfilteredItem) {
            if (!empty(array_intersect($tags, $unfilteredItem['tags']))) {
                $taggedItems->add($unfilteredItem);
            }
        }

        return $taggedItems;
    }

    protected function ensureCacheHasKeyAndAssetType(string $assetType)
    {
        $cache = Cache::get(self::CACHE_KEY);

        if (!$cache) {
            Cache::put(self::CACHE_KEY, []);
            $cache = Cache::get(self::CACHE_KEY);
        }

        if (!isset($cache[$assetType])) {
            $cache[$assetType] = [];
            Cache::put(self::CACHE_KEY, $cache);
        }
    }

    protected function getCachedItems(string $assetType): Collection
    {
        $this->ensureCacheHasKeyAndAssetType($assetType);

        return collect(Cache::get(self::CACHE_KEY)[$assetType]);
    }

    protected function putItemIntoCache(array $item, string $assetType)
    {
        $this->ensureCacheHasKeyAndAssetType($assetType);

        $cache = Cache::get(self::CACHE_KEY)[$assetType];

        $cache[$assetType][$item['url']] = $item;

        Cache::put(self::CACHE_KEY, $cache);
    }
}