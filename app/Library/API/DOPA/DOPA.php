<?php

namespace App\Library\API\DOPA;

use App\Library\API\API;

class DOPA
{
    use Country;
    use Wdpa;

    public const URL_PREFIX = 'https://dopa-services.jrc.ec.europa.eu/services/';

    /**
     * Execute request to API
     *
     * @param $url
     * @param $params
     * @return array|mixed
     */
    private static function request($url, $params)
    {
        $response = API::execute_api_request($url, $params);
        return  array_key_exists('error', (array) $response)
            ? $response
            : $response->records;
    }

    /**
     * Check if API is available
     *
     * @return bool
     */
    public static function apiAvailable()
    {
        try{
            return file_get_contents(static::URL_PREFIX)!=='';
        } catch (\Exception $e){
            return false;
        }

    }

}