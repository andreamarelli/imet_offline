<?php

namespace AndreaMarelli\ModularForms\Helpers\Geo;

use Illuminate\Support\Facades\DB;

class PostGis {

    private $query;

    public function __construct($arg) {
        $this->query = $arg;
    }

    /**
     * Constructor for extraction query (work on geometry field)
     *
     * @param $geometry_field
     * @return PostGis
     */
    public static function fromDB($geometry_field): PostGis
    {
        return new self($geometry_field);
    }

    /**
     * Constructor for insertion query (work on wkt)
     *
     * @param $wkt
     * @param $projection
     * @return PostGis
     */
    public static function toDB($wkt, $projection = 4326): PostGis
    {
        return new self('ST_GeomFromText(\''.$wkt.'\', '.$projection.')');
    }

    /**
     * Return query
     *
     * @return mixed
     */
    public function query()
    {
        return $this->query;
    }


    /**
     * Chainable Interface for ST_Transform
     *
     * @param int $target_projection
     * @return $this
     */
    public function projectTo($target_projection = 4326): PostGis
    {
        $this->query = 'ST_Transform('.$this->query.' , '.$target_projection.')';
        return $this;
    }

    /**
     * Chainable Interface for ST_Within
     *
     * @param $geometry_field
     * @return $this
     */
    public function within($geometry_field): PostGis
    {
        $this->query = 'ST_Within('.$this->query.' , '.$geometry_field.')';
        return $this;
    }

    /**
     * Chainable Interface for ST_AsText
     *
     * @param string $as
     * @return $this
     */
    public function toWkt($as = 'wkt'): PostGis
    {
        $this->query = 'ST_AsText('.$this->query.') as '.$as;
        return $this;
    }

    /**
     * Chainable Interface for ST_AsGeoJSON
     *
     * @param string $as
     * @param int $maxDecimalDigits
     * @return $this
     */
    public function toGeoJSON($as = 'geojson', $maxDecimalDigits = 6): PostGis
    {
        $this->query = 'ST_AsGeoJSON('.$this->query.', '.$maxDecimalDigits.') :: json as '.$as;
        return $this;
    }

    /**
     * Chainable Interface for generic PostGis function
     *
     * @param $function
     * @param null $arg
     * @return $this
     */
    public function apply($function, $arg = null): PostGis
    {
        if($arg!==null){
            $this->query = $function.'('.$this->query.', '.$arg.')';
        } else {
            $this->query = $function.'('.$this->query.')';
        }
        return $this;
    }

    public static function getSRID($table_name, $geometry_column = 'geom')
    {
        [$schema, $table] = explode('.', $table_name);
        $result = DB::select(DB::raw("SELECT Find_SRID('" . $schema . "', '" . $table . "', '" . $geometry_column . "') as srid"));
        if($result){
            return $result[0]->srid;
        }
        return null;
    }

}
