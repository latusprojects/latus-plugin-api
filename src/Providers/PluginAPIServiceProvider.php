<?php

namespace Latus\PluginAPI\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Latus\Laravel\Http\Middleware\BuildPackageDependencies;
use Latus\PluginAPI\Latus;
use Latus\PluginAPI\Repositories\Cache\AssetRepository;
use Latus\PluginAPI\Repositories\Contracts\AssetRepository as AssetRepositoryContract;
use Latus\PluginAPI\Services\ExposedDataService;

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

        BuildPackageDependencies::addDependencyClosure(function () {
            $exposedDataService = app(ExposedDataService::class);

            $data = $exposedDataService->getExposed();

            File::put(public_path('assets/exposedData.json'), json_encode($data));
        });
    }

    public function boot()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/latus.php', 'latus');
    }
}