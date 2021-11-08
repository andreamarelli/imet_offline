<?php

namespace AndreaMarelli\ModularForms\Helpers\API\DOPA;

use AndreaMarelli\ModularForms\Helpers\API\API;

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
    protected static function request($url, $params): array
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
