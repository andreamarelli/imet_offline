<?php

namespace App\Library\Utils\Geo;

trait PostGisToGeoJSON{

    public static function exportGeoJSON($primary_query)
    {
        $export_query =
            'SELECT jsonb_build_object(
                   \'type\',     \'FeatureCollection\',
                   \'features\', jsonb_agg(features.feature)
               ) as geojson
            FROM (
                SELECT json_build_object(
                    \'type\',     \'Feature\',
                    \'id\',       "id",
                    \'properties\', to_jsonb(inputs) - \'id\' - \''.static::$geometry_field.'\',
                    \'geometry\', ST_AsGeoJSON(ST_Transform('.static::$geometry_field.', 4326))::json
                ) AS feature
                FROM (
                 '.\DB::raw($primary_query->toSql()).'
                ) as inputs
            )  as features;';

        return \DB::select(
            \DB::raw($export_query),
            $primary_query->getBindings()
        )[0]->geojson;
    }

}