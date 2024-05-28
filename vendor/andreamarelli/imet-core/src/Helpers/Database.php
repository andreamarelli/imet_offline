<?php

namespace   AndreaMarelli\ImetCore\Helpers;

use Illuminate\Support\Str;

class Database
{
    // Connections: used as connection + filename for SQLite offline version
    public const COMMON_CONNECTION = 'offline_public';
    public const IMET_CONNECTION = 'offline_imet';
    public const OECM_CONNECTION = 'offline_oecm';

    // Schemas: used as schema for PostGreSQL online version
    public const COMMON_IMET_SCHEMA = 'imet_common';
    public const IMET_SCHEMA = 'imet';
    public const OECM_SCHEMA = 'oecm';

    /**
     * Get schema and connection according to the environment (offline or online)
     * Use different databases (SQLITE) for offline version and different schemas for online version (PostGreSQL)
     */
    static public function getSchemaAndConnection($requested_schema = null): array
    {
        $is_offline = Str::contains(config('app.env'),'offline');

        // Set Connection
        if($is_offline){
            if($requested_schema === static::IMET_SCHEMA){
                $connection = static::IMET_CONNECTION;
            } elseif($requested_schema === static::OECM_SCHEMA){
                $connection = static::OECM_CONNECTION;
            } else {
                $connection = static::COMMON_CONNECTION;
            }
        } else {
            $connection = config('database.default');
        }

        // Set Schema
        $schema = $is_offline
            ? ''
            :  ($requested_schema===null
                    ? static::COMMON_IMET_SCHEMA . '.'
                    : $requested_schema . '.');

        return [$schema, $connection];
    }
}