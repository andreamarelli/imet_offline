<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

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
        if (!App::environment('production')) {
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
        // ###### Custom validation Rules ######
        Validator::extend('custom_text', function($attribute, $value){
            return preg_match('/^[0-9\pL\s\'\+\-\_\/\(\)]+$/u', $value);
        });
    }
}
