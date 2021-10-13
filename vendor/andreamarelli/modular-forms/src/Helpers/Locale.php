<?php
namespace AndreaMarelli\ModularForms\Helpers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

class Locale{

    public static function lower()
    {
        return mb_strtolower(App::getLocale() ?? Config::get('app.locale'));
    }

    public static function upper()
    {
        return mb_strtoupper(App::getLocale() ?? Config::get('app.locale'));
    }

}