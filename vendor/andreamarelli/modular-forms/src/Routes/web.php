<?php

use AndreaMarelli\ModularForms\controllers\Controller;
use AndreaMarelli\ModularForms\Helpers\Locale;
use Illuminate\Support\Facades\Route;

if(!defined('UPPER_LOCALE')) {
    define('UPPER_LOCALE', Locale::upper());
}
if(!defined('LOWER_LOCALE')) {
    define('LOWER_LOCALE', Locale::lower());
}
