<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Load the Laravel IDE Helper on non-production environments
        if (!App::environment('production') && !is_imet_environment()) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // ###### Force HTTPS on production ######
        if(App::environment('production')
                || substr_count(env('APP_URL'), 'h03-stg-ofac')>0
            ){
            URL::forceScheme('https');
        }

        // ###### Custom validation Rules ######
        Validator::extend('custom_text', function($attribute, $value){
            return preg_match('/^[0-9\pL\s\'\+\-\_\/\(\)]+$/u', $value);
        });
        Validator::extend('country_iso', function($attribute, $value){
            return preg_match('/^[a-zA-z]{2,3}$/', $value);
        });
        Validator::extend('id', function($attribute, $value){
            return preg_match('/^[0-9]{1,6}$/', $value);
        });
        Validator::extend('alpha_dash_dot', function($attribute, $value){
            return preg_match('/^[a-zA-Z0-9-_.]+$/', $value);
        });
        Validator::extend('alpha_dash_dot', function($attribute, $value){
            return preg_match('/^[a-zA-Z0-9-_.]+$/', $value);
        });
        Validator::extend('filename', function($attribute, $value){
            return preg_match('/^[a-zA-Z0-9-_.&()]+$/', $value);
        });

        // pagination views (exported with: php artisan vendor:publish --tag=laravel-pagination)
        Paginator::useBootstrap();
        Paginator::defaultView('vendor.pagination');
        Paginator::defaultSimpleView('vendor.pagination');
    }
}
