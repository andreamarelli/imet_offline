<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Settings extends Model
{
    protected $table = 'settings';
    protected $fillable = ['proxy_host', 'proxy_port', 'proxy_user', 'proxy_password'];

    public static function get(): array
    {
        return static::find(0)->toArray();
    }

    public static function updateSettings(array $data): array
    {
        $settings = static::find(0);
        $settings->update($data);
        return $settings->toArray();
    }

}
