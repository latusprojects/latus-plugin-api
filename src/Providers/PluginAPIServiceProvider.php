<?php

namespace Latus\PluginAPI\Providers;

use Illuminate\Support\ServiceProvider;
use Latus\PluginAPI\Latus;
use Latus\PluginAPI\Repositories\Cache\AssetRepository;
use Latus\PluginAPI\Repositories\Contracts\AssetRepository as AssetRepositoryContract;

class PluginAPIServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('latus', function () {
            return new Latus();
        });

        $this->app->bind(AssetRepositoryContract::class, AssetRepository::class);
    }
}