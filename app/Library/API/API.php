<?php

namespace App\Library\API;

use App\Models\Cache;

class API
{
    private const CACHE_TTL = 60 * 60 * 24 * 15;    // 15 days

    public static function execute_api_request($url, $params)
    {
        // Retrieve from cache
        $cache_key = Cache::buildKey($url, $params);
        if(($cache_value = Cache::get($cache_key)) !== false){
           // return $cache_value;
        }

        // Execute request to API
        $url = rtrim($url, '?') . '?';
        $url = $url . http_build_query($params);
        try {
            $response = json_decode(file_get_contents($url));
            // store in cache
           // dd($url, $params);
            Cache::put($cache_key, $response, static::CACHE_TTL);
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
        return $response;
    }
}
