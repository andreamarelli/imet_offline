<?php

namespace AndreaMarelli\ImetCore;

use AndreaMarelli\ImetCore\Commands\CalculateScores;
use AndreaMarelli\ImetCore\Commands\ConvertSQLite;
use AndreaMarelli\ImetCore\Commands\Export;
use AndreaMarelli\ImetCore\Commands\Import;
use AndreaMarelli\ImetCore\Commands\PopulateSpecies;
use AndreaMarelli\ImetCore\Commands\UpdateOFAC;
use AndreaMarelli\ImetCore\Commands\UpdateProtectedAreasAPI;
use AndreaMarelli\ImetCore\Commands\UpdateProtectedAreasCSV;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;


class ServiceProvider extends BaseServiceProvider
{

    const BASE_PATH = __DIR__ . '/../';

    /**
     * Register services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(static::BASE_PATH . 'config/config.php', 'imet-core');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

        // Migrations
        $this->loadMigrationsFrom([
            static::BASE_PATH . 'database/migrations/public',
            static::BASE_PATH . 'database/migrations/imet',
            static::BASE_PATH . 'database/migrations/oecm',
        ]);

        // Views
        $this->loadViewsFrom(static::BASE_PATH . 'src/resources/views', 'imet-core');
        $this->publishes([
            static::BASE_PATH . 'src/resources/views/vendor/modular-forms' =>
                resource_path('views/vendor/modular-forms') // Override ModularForms views
        ], 'imet-core');

        // Routes
        Route::group($this->routeConfiguration('web'), function (){
            $this->loadRoutesFrom(static::BASE_PATH . 'src/Routes/web.php');
        });
        Route::group($this->routeConfiguration('api'), function (){
            $this->loadRoutesFrom(static::BASE_PATH . 'src/Routes/api.php');
        });

        // Config
        $this->publishes([
            static::BASE_PATH . 'config/config.php' => config_path('imet-core.php')
        ], 'imet-core');

        //Lang
        $this->loadTranslationsFrom(static::BASE_PATH . 'src/Lang', 'imet-core');

        // Commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                CalculateScores::class,
                ConvertSQLite::class,
                Export::class,
                Import::class,
                PopulateSpecies::class,
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
