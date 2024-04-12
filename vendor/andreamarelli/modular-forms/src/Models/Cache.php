<?php

namespace AndreaMarelli\ModularForms\Models;

use Carbon\Carbon;
use DateInterval;
use DateTimeInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache as BaseCache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class Cache{

    private const TTL = 60 * 60 * 24 * 7;

    /**
     * Build a cache key from request params
     */
    public static function buildKey(string $prefix, array $params = null): string
    {
        unset($params['_token']);

        // Prefix
        $prefix = Str::startsWith($prefix, '_') ? $prefix : '_'.$prefix;

        // Params
        $params = http_build_query($params);
        $params = !empty($params)
            ? '?'. $params
            : '';

        return $prefix . $params;
    }

    /**
     * Encode the key (suitable also for using in URLs)
     * Convert normal base64 to base64url as specified in RFC 4648: https://www.rfc-editor.org/rfc/rfc4648#page-7
    */
    public static function encodeKey(string $key): string
    {
        $key = base64_encode($key);
        return str_replace(
            array('+', '/'),
            array('-', '_'),
            $key);
    }

    /**
     * Decode the key encoded with Cache::encodeKey($key)
     */
    public static function decodeKey(string $key): string
    {
        $key = str_replace(
            array('-', '_'),
            array('+', '/'),
            $key);
        return base64_decode($key);
    }

    /**
     * Retrieve API result from cache
     */
    public static function get($cache_key): mixed
    {
        $cache_value = BaseCache::get($cache_key);
        return $cache_value !== null
            ? $cache_value
            : null;
    }

    /**
     * Store API result in cache
     */
    public static function put($cache_key, $data, DateTimeInterface|DateInterval|int|null $ttl = self::TTL): void
    {
        Cache::flushByKey($cache_key);
        BaseCache::put($cache_key, $data, $ttl);
    }

    /**
     * Perform cache flush on given key
     */
    public static function flushByKey($key): string
    {
        $key = str_replace(Config::get('cache.prefix'), '', $key);
        if(BaseCache::has($key)){
            BaseCache::forget($key);
        }
        return $key . ': Cache flushed.';
    }

    /**
     * Flush cache (key in request)
     */
    public static function flush(Request $request): string
    {
        $key = $request->get('key');
        return Cache::flushByKey($key);
    }

    /**
     * Flush cache: all related to $key
     */
    public static function flushRelated($key): string
    {
        $keys = DB::table('cache')
            ->select(['key'])
            ->where('key', 'like', '%' || $key || '%')
            ->get();
        foreach ($keys as $k) {
            Cache::flushByKey($k->key);
        }
        return $key . ': Cache flushed.';
    }

    /**
     * Flush ALL cache
     */
    public static function flushExpired(): string
    {
        $keys = DB::table('cache')
            ->select(['key'])
            ->where('expiration', '<', Carbon::now()->unix())
            ->get();

        foreach ($keys as $k) {
            Cache::flushByKey($k->key);
        }
        return 'All expired cache flushed.';
    }

    /**
     * Flush ALL cache
     */
    public static function flushAll(): string
    {
        BaseCache::flush();
        return 'All cache flushed.';
    }

}
