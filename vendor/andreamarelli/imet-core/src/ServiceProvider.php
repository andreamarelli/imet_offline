<?php

namespace AndreaMarelli\ImetCore;

use AndreaMarelli\ImetCore\Commands\ApplySQL;
use AndreaMarelli\ImetCore\Commands\ConvertSQLite;
use AndreaMarelli\ImetCore\Commands\Export;
use AndreaMarelli\ImetCore\Commands\GetSerialNumber;
use AndreaMarelli\ImetCore\Commands\Import;
use AndreaMarelli\ImetCore\Commands\InitDB;
use AndreaMarelli\ImetCore\Commands\PopulateMetadata;
use AndreaMarelli\ImetCore\Commands\PopulateSpecies;
use AndreaMarelli\ImetCore\Commands\SetSerialNumber;
use AndreaMarelli\ImetCore\Commands\UpdateProtectedAreasAPI;
use AndreaMarelli\ImetCore\Commands\UpdateProtectedAreasCSV;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;


class ServiceProvider extends BaseServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'imet-core');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Views
        $this->loadViewsFrom(__DIR__.'/../src/Views', 'imet-core');
        $this->publishes([__DIR__.'/../src/Views' => resource_path('views/vendor/imet-core')], 'views');

        // Routes
        $this->loadRoutesFrom(__DIR__.'/../src/Routes/web.php');
        $this->loadRoutesFrom(__DIR__.'/../src/Routes/api.php');

        // Config
        $this->publishes([__DIR__.'/../config/config.php' => config_path('imet-core.php')], 'config');

        //Lang
        $this->loadTranslationsFrom(__DIR__.'/../src/Lang', 'imet-core');

        // Commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                ApplySQL::class,
                ConvertSQLite::class,
                Export::class,
                GetSerialNumber::class,
                Import::class,
                InitDB::class,
                PopulateMetadata::class,
                PopulateSpecies::class,
                SetSerialNumber::class,
                UpdateProtectedAreasAPI::class,
                UpdateProtectedAreasCSV::class
            ]);
        }
    }

}
