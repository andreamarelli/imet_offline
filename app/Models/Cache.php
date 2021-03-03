<?php

namespace App\Models;

use Illuminate\Http\Request;

class Cache{

    /**
     * Build a cache key from request params
     * @param $prefix
     * @param null $params
     * @return string
     */
    public static function buildKey($prefix, $params = null)
    {
        unset($params['_token']);

        // Build cache key
        $prefix = \Str::startsWith($prefix, '_') ? $prefix : '_'.$prefix;
        return $params!==null && !empty($params)
            ? $prefix.'?' . http_build_query($params)
            : $prefix;
    }


    /**
     * Retrieve API result from cache
     *
     * @param $cache_key
     * @return bool|mixed
     */
    public static function get($cache_key)
    {
        $cache_value = \Cache::get($cache_key);
        return $cache_value !== null
            ? $cache_value
            : false;
    }

    /**
     * Store API result in cache
     *
     * @param $cache_key
     * @param $data
     * @param float|int $ttl (Time To Live - in seconds)
     */
    public static function put($cache_key, $data, $ttl = 60 * 60 * 24 * 7)
    {
        \Cache::put($cache_key, $data, $ttl);
    }

    /**
     * Perform cache flush on given key
     *
     * @param $key
     * @return string
     */
    private static function _flushByKey($key)
    {
        $key = str_replace('laravel_cache', '', $key);
        if(\Cache::has($key)){
            \Cache::forget($key);
        }
        return $key . ': Cache flushed.';
    }

    /**
     * Flush cache (key in request)
     *
     * @param $request
     * @return string
     */
    public static function flush(Request $request)
    {
        $key = $request->get('key');
        return Cache::_flushByKey($key);
    }

    /**
     * Flush cache: all related to $key
     *
     * @param $key
     * @return string
     */
    public static function flushRelated($key)
    {
        $keys = \DB::table('cache')
            ->select(['key'])
            ->where('key', 'like', '%' || $key || '%')
            ->get();
        foreach ($keys as $k) {
            Cache::_flushByKey($k->key);
        }
        return $key . ': Cache flushed.';
    }

    /**
     * Flush ALL cache
     *
     * @return string
     */
    public static function flushExpired()
    {
        $keys = \DB::table('cache')
            ->select(['key'])
            ->where('expiration', '<', \Carbon\Carbon::now()->unix())
            ->get();

        foreach ($keys as $k) {
            Cache::_flushByKey($k->key);
        }
        return 'All expired cache flushed.';
    }

    /**
     * Flush ALL cache
     *
     * @return string
     */
    public static function flushAll()
    {
        \Cache::flush();
        return 'All cache flushed.';
    }

}
