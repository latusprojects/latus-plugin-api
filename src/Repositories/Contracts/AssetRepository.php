<?php

namespace Latus\PluginAPI\Repositories\Contracts;

use Illuminate\Support\Collection;

interface AssetRepository
{
    public const PLACE_START = 'start';
    public const PLACE_END = 'end';

    public const ORDER_FIRST = 'first';
    public const ORDER_LAST = 'last';

    public function attachCss(string $url, string $place = self::PLACE_START, array $tags = null, \Closure $shouldShow = null);

    public function attachJs(string $url, string $place = self::PLACE_START, array $tags = null, bool $defer = false, \Closure $shouldShow = null);

    public function getCss(array $tags = null): Collection;

    public function getJs(array $tags = null): Collection;
}