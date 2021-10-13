<?php

namespace AndreaMarelli\ModularForms\Models;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache as BaseCache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class Cache{

    /**
     * Build a cache key from request params
     *
     * @param $prefix
     * @param null $params
     * @return string
     */
    public static function buildKey($prefix, $params = null): string
    {
        unset($params['_token']);

        // Build cache key
        $prefix = Str::startsWith($prefix, '_') ? $prefix : '_'.$prefix;
        return $params!==null && !empty($params)
            ? $prefix.'?' . http_build_query($params)
            : $prefix;
    }


    /**
     * Retrieve API result from cache
     *
     * @param $cache_key
     * @return mixed|null
     */
    public static function get($cache_key)
    {
        $cache_value = BaseCache::get($cache_key);
        return $cache_value !== null
            ? $cache_value
            : null;
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
        BaseCache::put($cache_key, $data, $ttl);
    }

    /**
     * Perform cache flush on given key
     *
     * @param $key
     * @return string
     */
    private static function _flushByKey($key): string
    {
        $key = str_replace('laravel_cache', '', $key);
        if(BaseCache::has($key)){
            BaseCache::forget($key);
        }
        return $key . ': Cache flushed.';
    }

    /**
     * Flush cache (key in request)
     *
     * @param $request
     * @return string
     */
    public static function flush(Request $request): string
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
    public static function flushRelated($key): string
    {
        $keys = DB::table('cache')
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
    public static function flushExpired(): string
    {
        $keys = DB::table('cache')
            ->select(['key'])
            ->where('expiration', '<', Carbon::now()->unix())
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
    public static function flushAll(): string
    {
        BaseCache::flush();
        return 'All cache flushed.';
    }

}
