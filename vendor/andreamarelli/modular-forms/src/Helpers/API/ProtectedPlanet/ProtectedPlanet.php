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
     * @param array $params
     * @return object
     */
    private static function request($url, array $params = []): object
    {
        $params = array_merge($params, [
            'token' => config('modular-forms.protected_planet_api_key')
        ]);
        return API::execute_api_request($url, $params);
    }

    /**
     * @param $country
     * @return object
     */
    public static function get_country($country): object
    {
        return self::request(self::URL_PREFIX . 'countries/' .$country);
    }

    /**
     * @param $protected_area
     * @return object
     */
    public static function get_protected_area($protected_area): object
    {
        return self::request(self::URL_PREFIX . 'protected_areas/' .$protected_area);
    }

    /**
     * Retrieve protected areas by given country
     *
     * @param string $country
     * @param int $page
     * @param int $per_page
     * @return object
     */
    public static function get_by_country(string $country, int $page = 1, int $per_page = 50): object
    {
        return self::request(self::URL_PREFIX . 'protected_areas/search', [
            'country' => $country,
            'page' => $page,
            'per_page' => 50
        ]);
    }

}
