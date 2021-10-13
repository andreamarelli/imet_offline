<?php

namespace AndreaMarelli\ModularForms;

use Illuminate\Support\Facades\Blade;
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
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'modular-forms');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Views
        $this->loadViewsFrom(__DIR__.'/../src/Views', 'modular-forms');
        $this->publishes([__DIR__.'/../src/Views' => resource_path('views/vendor/modular-forms')], 'views');

        // Routes
        $this->loadRoutesFrom(__DIR__.'/../src/Routes/web.php');

        // Config
        $this->publishes([__DIR__.'/../config/config.php' => config_path('modular-forms.php')], 'config');

        //Lang
        $this->loadTranslationsFrom(__DIR__.'/../src/Lang', 'modular-forms');

        // Custom blades
        Blade::directive('lang_u', function ($key) {
            return "<?php echo ucfirst(trans($key)); ?>";
        });
    }

}
