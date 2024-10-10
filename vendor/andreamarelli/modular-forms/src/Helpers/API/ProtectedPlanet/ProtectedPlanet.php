<?php

namespace AndreaMarelli\ModularForms\Helpers\API\ProtectedPlanet;

use AndreaMarelli\ModularForms\Exceptions\MissingAPITokenException;
use AndreaMarelli\ModularForms\Helpers\API\API;
use Illuminate\Support\Facades\Config;


class ProtectedPlanet
{
    public const WEBSITE_URL = 'https://www.protectedplanet.net/';
    private const API_URL = 'https://api.protectedplanet.net/v3/';

    /**
     * Execute request to API
     * @throws MissingAPITokenException
     */
    private static function request($url, array $params = []): object
    {
        // Get API key
        $token = Config::get('PROTECTED_PLANET_API_KEY');
        if($token === null){
            throw new MissingAPITokenException('Protected Planet');
        }
        $params = array_merge($params, ['token' => $token]);

        return API::execute_api_request($url, $params);
    }

    /**
     * Execute API request: retrieve protected areas by given country
     */
    public static function getByCountry(string $country, int $page = 1, int $per_page = 50): object
    {
        return self::request(self::API_URL . 'protected_areas/search', [
            'country' => $country,
            'page' => $page,
            'per_page' => 50
        ]);
    }

}
