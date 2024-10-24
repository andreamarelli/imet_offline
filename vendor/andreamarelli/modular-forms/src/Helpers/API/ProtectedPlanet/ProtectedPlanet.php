<?php

namespace AndreaMarelli\ModularForms\Helpers\API\ProtectedPlanet;

use AndreaMarelli\ModularForms\Exceptions\MissingAPITokenException;
use AndreaMarelli\ModularForms\Helpers\API\API;
use Illuminate\Support\Facades\Config;


class ProtectedPlanet extends API
{
    public const WEBSITE_URL = 'https://www.protectedplanet.net/';
    private const API_URL = 'https://api.protectedplanet.net/v3/';

    /**
     * Override: add API token to the request parameters
     * @throws MissingAPITokenException
     */
    public static function request($url, $params, $method = self::METHOD_GET, bool $no_cache = false): object
    {
        // Get API key
        $token = Config::get('PROTECTED_PLANET_API_KEY');
        if($token === null){
            throw new MissingAPITokenException('Protected Planet');
        }
        $params = array_merge($params, ['token' => $token]);

        return parent::request($url, $params, $method, $no_cache);
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
