<?php

namespace Latus\PluginAPI\Services;

use Illuminate\Support\Collection;
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

    public function attachJs(string $url, string $place = AssetRepository::PLACE_START, array $tags = null, bool $defer = false, \Closure $shouldShow = null)
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
}