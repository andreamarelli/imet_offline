<?php

namespace App\Library\API\ProtectedPlanet;

use App\Library\API\API;


class ProtectedPlanet
{
    public const URL_PREFIX = 'https://api.protectedplanet.net/v3/';
    public const TOKEN = '3c520c8b64cf0f903c351b702486e14b';
    public const WEBSITE_URL = 'https://www.protectedplanet.net/';

    /**
     * Execute request to API
     *
     * @param $url
     * @param $params
     * @return array|mixed
     */
    private static function request($url, $params = [])
    {
        $params = array_merge($params, [
            'token' => self::TOKEN
        ]);
        $response = API::execute_api_request($url, $params);
        return  (array) $response;
    }


    public static function get_country($country)
    {
        return self::request(self::URL_PREFIX . 'countries/' .$country);
    }

    public static function get_protected_area($protected_area)
    {
        return self::request(self::URL_PREFIX . 'protected_areas/' .$protected_area);
    }




}
