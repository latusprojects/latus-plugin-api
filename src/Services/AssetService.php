<?php

namespace Latus\PluginAPI\Services;

use Illuminate\Support\Collection;
use Latus\PluginAPI\Events\IncludesCssAssets;
use Latus\PluginAPI\Events\IncludesJsAssets;
use Latus\PluginAPI\Repositories\Contracts\AssetRepository;

class AssetService
{
    public function __construct(
        protected AssetRepository $assetRepository
    )
    {
    }

    public function attachCss(string $url, string $place = AssetRepository::PLACE_START, array $tags = null, \Closure $shouldShow = null): self
    {
        $this->assetRepository->attachCss($url, $place, $tags, $shouldShow);

        return $this;
    }

    public function attachJs(string $url, string $place = AssetRepository::PLACE_START, array $tags = null, bool $defer = false, \Closure $shouldShow = null): self
    {
        $this->assetRepository->attachJs($url, $place, $tags, $defer, $shouldShow);

        return $this;
    }

    public function getCss(array $tags = null): Collection
    {
        return $this->assetRepository->getCss($tags);
    }

    public function getJs(array $tags = null): Collection
    {
        return $this->assetRepository->getJs($tags);
    }

    public function includeJs(array $tags = null): Collection
    {
        if (!defined('JS_ATTACHED')) {
            IncludesJsAssets::dispatch();
            define('JS_ATTACHED', true);
        }

        return $this->getJs($tags);
    }

    public function includeCss(array $tags = null): Collection
    {
        if (!defined('CSS_ATTACHED')) {
            IncludesCssAssets::dispatch();
            define('CSS_ATTACHED', true);
        }

        return $this->getCss($tags);
    }
}