<?php

namespace AndreaMarelli\ModularForms\Helpers\API\DOPA;

use AndreaMarelli\ModularForms\Helpers\API\API;
use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;

class DOPA
{
    use Country;
    use Wdpa;

    public const URL_PREFIX = 'https://dopa-services.jrc.ec.europa.eu/services/';

    public const ON_ERROR_RESPONSE = 0;
    public const ON_ERROR_NULL = 1;
    public const ON_ERROR_ARRAY = 2;
    public const ON_ERROR_MESSAGE = 3;

    /**
     * Execute request to API
     *
     * @param string $url
     * @param array $params
     * @param int $on_error
     * @return array|null
     */
    protected static function request(string $url, array $params, int $on_error = DOPA::ON_ERROR_RESPONSE): ?array
    {
        $response = API::execute_api_request($url, $params);

        if(DOPA::response_has_error($response)){
            if($on_error === DOPA::ON_ERROR_ARRAY){
                return [];
            } else if($on_error === DOPA::ON_ERROR_NULL){
                return null;
            } else if($on_error === DOPA::ON_ERROR_RESPONSE){
                return (array) $response;
            } else if($on_error === DOPA::ON_ERROR_MESSAGE){
                return (array) $response->metadata->error;
            }
        } else {
            return isset($response->records) ? (array) $response->records : [];
        }
        return (array) $response;
    }

    /**
     * Check if the API return contains error
     *
     * @param object $response
     * @return bool
     */
    private static function response_has_error(object $response): bool
    {
        return property_exists($response, 'metadata')
            and property_exists($response->metadata, 'error')
            and $response->metadata->error != null;

    }

    /**
     * Check if API is available
     *
     * @return bool
     */
    public static function apiAvailable(): bool
    {
        try{
            $response = API::execute_request(static::URL_PREFIX);
            return $response->successful();
        } catch (Exception $e){
            return false;
        }
    }

}
