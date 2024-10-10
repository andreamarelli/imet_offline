<?php

namespace AndreaMarelli\ModularForms\Helpers\API;

use AndreaMarelli\ModularForms\Models\Cache;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;

class API
{
    private const CACHE_TTL = 60 * 60 * 24 * 15;    // 15 days

    /**
     * Execute the HTTP request
     */
    public static function execute_request($url, $params = null): Response
    {
        return App::environment('imetoffline')
            ? Http::withOptions(['verify' => false])->get($url, $params)
            : Http::get($url, $params);
    }

    /**
     * Execute a request to the given API endpoint
     */
    public static function execute_api_request($url, $params): object
    {
        // Retrieve from cache
        $cache_key = Cache::buildKey($url, $params);
        if(($cache_value = Cache::get($cache_key)) !== null){
            return static::ensureIsJson($cache_value);
        }

        // Execute request to API
        $response = API::execute_request($url, $params);
        if($response->successful()){
            // store in cache
            $response_data = static::ensureIsJson($response->json());
            Cache::put($cache_key, $response_data, static::CACHE_TTL);
            return $response_data;
        } else {
            return (object) ['error' => 'Request to '.$url.' failed'];
        }

    }

    /**
     * Ensure that the data structure is in JSON format
     */
    private static function ensureIsJson($data): object
    {
        return json_decode(json_encode($data));
    }
}
