<?php

namespace AndreaMarelli\ModularForms\Helpers\API;

use AndreaMarelli\ModularForms\Models\Cache;
use Exception;

class API
{
    private const CACHE_TTL = 60 * 60 * 24 * 15;    // 15 days

    /**
     * Execute a request to the given API endpoint
     *
     * @param $url
     * @param $params
     * @return object
     */
    public static function execute_api_request($url, $params): object
    {
        // Retrieve from cache
        $cache_key = Cache::buildKey($url, $params);
        if(($cache_value = Cache::get($cache_key)) !== null){
            return (object) $cache_value;
        }

        // Execute request to API
        $url = rtrim($url, '?') . '?';
        $url = $url . http_build_query($params);
        try {
            $response = json_decode(file_get_contents($url));
            // store in cache
            Cache::put($cache_key, $response, static::CACHE_TTL);
        } catch (Exception $e) {
            return (object) ['error' => $e->getMessage()];
        }
        return (object) $response;
    }
}
