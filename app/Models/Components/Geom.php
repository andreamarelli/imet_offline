<?php

namespace App\Models\Components;

use App\Library\Utils\Geo\PostGis;
use App\Library\Utils\Geo\Wkt;
use Illuminate\Support\Facades\DB;

trait Geom {

    protected static $geometry_field = 'geom';


    /**
     * Retrieve entity projection (st_srid)
     * @return mixed
     */
    private function getSRID()
    {
        return DB::table(self::getTable())
            ->select(DB::raw('distinct ST_SRID('.self::$geometry_field.') as st_srid'))
            ->where(self::$geometry_field, '<>', null)
            ->get()[0]->st_srid;
    }

    /**
     * Retrieve the WKT representation of the geometry of the Model
     * @return mixed
     */
    public function getWkt()
    {
        return self::select(DB::raw(
                PostGis::fromDB(self::$geometry_field)
                    ->toWkt('geom_wkt')
                    ->query()
            ))
            ->where($this->getKeyName(), $this->getKey())
            ->get()
            ->first()
            ->geom_wkt;
    }

    /**
     * Save the given geometry in WKT into the DB (also re-projection and transformation to MULTIPOLYGON is performed)
     * @param $wkt
     * @param $source_projection
     * @param string $target_projection
     * @return int
     */
    public function setGeom($wkt, $source_projection, $target_projection = null)
    {
        if($target_projection==null){
            $target_projection = self::getSRID();
        }
        return DB::table(self::getTable())
            ->where($this->getKeyName(), $this->getKey())
            ->update([
                self::$geometry_field => DB::raw(
                    PostGis::toDB($wkt, $source_projection)
                        ->projectTo($target_projection)
                        ->toWkt('extent')
                        ->apply('ST_Multi')
                        ->query()
                )
            ]);
    }

    /**
     * Retrieve centroid of the given entity
     * @param $id
     * @param string $id_field
     * @param null $db_table
     * @return array|null
     */
    public static function getCentroidLatLon($id, $id_field = 'id', $db_table = null)
    {
        $className = get_called_class();
        $db_table = $db_table!==null ? $db_table : (new $className())->getTable();
        $centroid = \DB::table($db_table)
            ->select([\DB::raw(
                PostGis::fromDB('centroid')
                    ->projectTo(4326)
                    ->toWkt('wkt_4326')
                    ->query()
            )])
            ->where($id_field, $id)
            ->first();
        if($centroid && $centroid->wkt_4326!=null){
            return Wkt::getPointLatLon($centroid->wkt_4326);
        }
        return null;
    }

    /**
     * Retrieve extent of the given entity
     * @param $id
     * @param string $id_field
     * @param null $db_table
     * @return array|null
     */
    public static function getExtent($id, $id_field = 'id', $db_table = null)
    {
        $className = get_called_class();
        $db_table = $db_table!==null ? $db_table : (new $className())->getTable();
        return \DB::table($db_table)
            ->select([\DB::raw(
                PostGis::fromDB('geom')
                    ->projectTo(4326)
                    ->apply('ST_Envelope')
                    ->toWkt('bbox')
                    ->query()
            )])
            ->where($id_field, $id)
            ->first();
    }

    /**
     * Query by point coordinates (click on map)
     * @param $lat
     * @param $lon
     * @param int $map_projection
     * @param int $geom_projection
     * @return \Illuminate\Support\Collection
     */
    public static function getByPoint($lat, $lon, $map_projection = 4326, $geom_projection = 3857)
    {
        $wkt = Wkt::getPointWkt($lat, $lon);
        return \DB::table((new static())->getTable())
            ->selectRaw(
                '*, '.
                PostGis::fromDB(static::$geometry_field)
                    ->projectTo($map_projection)
                    ->toGeoJSON('geojson')
                    ->query()
            )
            ->whereRaw(
                PostGis::toDB($wkt, $map_projection)
                    ->projectTo($geom_projection)
                    ->within(static::$geometry_field)
                    ->query()
            )
            ->get();

    }

}
