<?php

use Illuminate\Support\Facades\App;


/**
 * Check if App::environment is IMET related (ex. imetoffline or imetglobal)
 *
 * @return bool|string
 */
function is_imet_environment(){
    return App::environment('imetoffline')
        || App::environment('imetglobal');
}

/**
 * Check if App::environment is IMET related (ex. imetoffline or imetglobal)
 *
 * @return bool|string
 */
function imet_offline_version(){
    return env('IMET_OFFLINE_VERSION');
}
