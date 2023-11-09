<?php

namespace AndreaMarelli\ImetCore;

use AndreaMarelli\ImetCore\Commands\ApplySQL;
use AndreaMarelli\ImetCore\Commands\CalculateScores;
use AndreaMarelli\ImetCore\Commands\ConvertSQLite;
use AndreaMarelli\ImetCore\Commands\Export;
use AndreaMarelli\ImetCore\Commands\GetSerialNumber;
use AndreaMarelli\ImetCore\Commands\Import;
use AndreaMarelli\ImetCore\Commands\InitDB;
use AndreaMarelli\ImetCore\Commands\PopulateMetadata;
use AndreaMarelli\ImetCore\Commands\PopulateSpecies;
use AndreaMarelli\ImetCore\Commands\SetSerialNumber;
use AndreaMarelli\ImetCore\Commands\UpdateOFAC;
use AndreaMarelli\ImetCore\Commands\UpdateProtectedAreasAPI;
use AndreaMarelli\ImetCore\Commands\UpdateProtectedAreasCSV;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;


class ServiceProvider extends BaseServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'imet-core');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Views
        $this->loadViewsFrom(__DIR__.'/../src/Views', 'imet-core');
        $this->publishes([__DIR__.'/../src/Views' => resource_path('views/vendor/imet-core')], 'views');

        // Routes
        Route::group($this->routeConfiguration('web'), function () {
            $this->loadRoutesFrom(__DIR__.'/../src/Routes/web.php');
        });
        Route::group($this->routeConfiguration('api'), function () {
            $this->loadRoutesFrom(__DIR__.'/../src/Routes/api.php');
        });

        // Config
        $this->publishes([__DIR__.'/../config/config.php' => config_path('imet-core.php')], 'config');

        //Lang
        $this->loadTranslationsFrom(__DIR__.'/../src/Lang', 'imet-core');

        // Commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                ApplySQL::class,
                CalculateScores::class,
                ConvertSQLite::class,
                Export::class,
                GetSerialNumber::class,
                Import::class,
                InitDB::class,
                PopulateMetadata::class,
                PopulateSpecies::class,
                SetSerialNumber::class,
                UpdateOFAC::class,
                UpdateProtectedAreasAPI::class,
                UpdateProtectedAreasCSV::class
            ]);
        }
    }

    private function routeConfiguration($route_file): array
    {
        if($route_file === 'web' && config('imet-core.web_routes_prefix')!==null){
            return [
                'prefix' => config('imet-core.web_routes_prefix')
            ];
        } else if ($route_file === 'api' && config('imet-core.api_routes_prefix')!==null){
            return [
                'prefix' => config('imet-core.api_routes_prefix')
            ];
        }

        return [];
    }

}
