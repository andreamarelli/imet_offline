<?php

namespace AndreaMarelli\ModularForms\Helpers\API;

use AndreaMarelli\ModularForms\Models\Cache;
use Exception;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class API
{
    protected const CACHE_TTL = 60 * 60 * 24 * 15;    // 15 days

    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';


    /**
     * Execute a request to the given API endpoint
     */
    public static function request($url, $params, $method = self::METHOD_GET, bool $no_cache = false): object
    {
        // Retrieve from cache
        $cache_key = Cache::buildKey($url, $params);
        if(!$no_cache && ($cache_value = Cache::get($cache_key)) !== null){
            return static::ensureIsJson($cache_value);
        }

        // Execute request to API
        $response = self::execute($url, $params, $method);
        if(self::isSuccessful($response)){
            // store in cache
            $response_data = static::ensureIsJson($response->json());
            Cache::put($cache_key, $response_data, static::CACHE_TTL);
            return $response_data;
        } else {
            return (object) ['error' => 'Request to '.$url.' failed'];
        }

    }

    /**
     * Execute the HTTP request
     */
    private static function execute($url, $params = null, $method = self::METHOD_GET): Response
    {
        // Initialize HTTP client
        $http_client = Str::contains(App::environment(), 'offline')
            ? Http::withOptions(['verify' => false])
            : Http::createPendingRequest();

        // Execute request
        return $method===self::METHOD_GET
            ? $http_client->get($url, $params)
            : $http_client->post($url, $params);
    }

    /**
     * Verify if the response is successful
     */
    protected static function isSuccessful($response): bool
    {
        return $response->successful();
    }

    /**
     * Ensure that the data structure is in JSON format
     */
    private static function ensureIsJson($data): object
    {
        return json_decode(json_encode($data));
    }

    public static function apiAvailable()
    {
        try{
            $response = static::execute(static::API_URL);
            return $response->successful();
        } catch (Exception $e){
            return false;
        }
    }


}
