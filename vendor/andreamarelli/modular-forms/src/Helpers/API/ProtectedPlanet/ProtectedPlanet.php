<?php

namespace AndreaMarelli\ModularForms\Helpers\API\ProtectedPlanet;

use AndreaMarelli\ModularForms\Helpers\API\API;


class ProtectedPlanet
{
    public const URL_PREFIX = 'https://api.protectedplanet.net/v3/';
    public const WEBSITE_URL = 'https://www.protectedplanet.net/';

    /**
     * Execute request to API
     *
     * @param $url
     * @param $params
     * @return object
     */
    private static function request($url, $params = []): object
    {
        $params = array_merge($params, [
            'token' => config('modular-forms.protected_planet_api_key')
        ]);
        return (object) API::execute_api_request($url, $params);
    }

    /**
     * @param $country
     * @return object
     */
    public static function get_country($country): object
    {
        return (object) self::request(self::URL_PREFIX . 'countries/' .$country);
    }

    /**
     * @param $protected_area
     * @return object
     */
    public static function get_protected_area($protected_area): object
    {
        return (object) self::request(self::URL_PREFIX . 'protected_areas/' .$protected_area);
    }

}
