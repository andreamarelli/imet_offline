<?php

namespace App\Library\Ofac;

use \Illuminate\Support\Facades\Request;


class Breadcrumbs
{

    public static function get()
    {
        $current_url     = Request::url();
        $current_url     = str_replace(Request::getSchemeAndHttpHost(), '', $current_url);
        $current_url     = ltrim($current_url, '/');
        $current_url_obj = explode('/', $current_url);

        if (count($current_url_obj) == 2) {
            return [$current_url_obj[0], $current_url_obj[1]];
        } elseif (count($current_url_obj) > 2) {
            return [$current_url_obj[0], $current_url_obj[1], $current_url_obj[2]];
        }
        return [null, null];
    }
}
