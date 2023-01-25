<?php

namespace App\Providers;

use Illuminate\Foundation\AliasLoader;
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
    // Override ImetCore Aliases in order to extend classes
        $loader = AliasLoader::getInstance();
        $loader->alias(\ImetUser::class, \App\Models\User::class);
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
