<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Settings extends Model
{
    protected $table = 'settings';
    protected $fillable = [
        'proxy_host',
        'proxy_port',
        'proxy_user',
        'proxy_password',
        'protected_planet_api_key'
    ];

    public static function get(): array
    {
        return static::find(0)->toArray();
    }

    public static function updateSettings(array $data): array
    {
        $data = collect($data)->filter(function($value, $key){
            return $value!==null && $value!=='';
        })->toArray();

        $settings = static::find(0);
        $settings->update($data);
        return $settings->toArray();
    }

    public static function getSetting($key): ?string
    {
        return static::first()?->$key;
    }

}
