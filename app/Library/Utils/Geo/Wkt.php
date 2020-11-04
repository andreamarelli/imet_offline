<?php

namespace App\Library\Utils\Geo;

class Wkt
{

    public static function getPointLatLon($wkt)
    {
        list($lon, $lat) = explode(' ', str_replace(['POINT(', ')'], '', $wkt));
        return [$lat, $lon];
    }

    public static function getPointWkt($lat, $lon)
    {
        return 'POINT(' . $lon . ' ' . $lat . ')';
    }
}
