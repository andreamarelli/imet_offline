<?php

namespace AndreaMarelli\ModularForms\Helpers\Geo;

class Wkt
{

    /**
     * Return point coordinates (lat/lon) from WKT
     *
     * @param $wkt
     * @return array
     */
    public static function getPointLatLon($wkt): array
    {
        list($lon, $lat) = explode(' ', str_replace(['POINT(', ')'], '', $wkt));
        return [$lat, $lon];
    }

    /**
     * Return a WTK from point coordinates (lat/lon)
     *
     * @param $lat
     * @param $lon
     * @return string
     */
    public static function getPointWkt($lat, $lon): string
    {
        return 'POINT(' . $lon . ' ' . $lat . ')';
    }
}
