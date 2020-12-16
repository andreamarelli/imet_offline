<?php

namespace App\Models;

use App;
use App\Library\Utils\Geo\PostGis;
use App\Models\Components\EntityModel;
use App\Models\Components\Geom;
use Config;
use Illuminate\Database\Eloquent\Collection;


class Country extends EntityModel {

    use Geom;

    public const ofac_table = 'KnowledgeBase.countries';
    public const imet_table = 'imet.imet_countries';

    protected $primaryKey = 'iso3';
    public $incrementing = false;

    public const CREATED_AT = null;
    public const UPDATED_AT = null;
    public const UPDATED_BY = null;

    public const LABEL = 'name_' . LOWER_LOCALE;

    protected $appends = [
        'name'
    ];

    public const OFAC = ['AWY', 'BDI', 'CAF', 'CMR', 'COD', 'COG', 'GAB', 'GNQ', 'RWA', 'STP', 'TCD'];

    public const ByGlobalRegion = [
        'CR' => ['ATG', 'BHS', 'BLZ', 'BRB', 'CUB', 'DMA', 'DOM', 'GRD', 'GUY', 'HTI', 'JAM', 'KNA', 'LCA', 'SUR', 'TTO', 'VCT'],
        'EA' => ['DJI', 'ERI', 'ETH', 'KEN', 'RWA', 'SDN', 'SOM', 'TZA', 'UGA'],
        'OFAC' => ['BDI', 'CAF', 'CMR', 'COD', 'COG', 'GAB', 'GNQ', 'STP', 'TCD'],
        'PA' => ['COK', 'FJI', 'FSM', 'KIR', 'MHL', 'NIU', 'NRU', 'PLW', 'PNG', 'SLB', 'TLS', 'TON', 'TUV', 'VUT', 'WSM'],
        'SA' => ['AGO', 'BWA', 'COM', 'LSO', 'MDG', 'MOZ', 'MUS', 'MWI', 'NAM', 'SWZ', 'SYC', 'ZAF', 'ZMB', 'ZWE'],
        'WA' => ['BEN', 'BFA', 'CIV', 'CPV', 'GHA', 'GIN', 'GMB', 'GNB', 'LBR', 'MLI', 'MRT', 'NER', 'NGA', 'SEN', 'SLE', 'TGO'],
    ];


    // TODO: move area to DB
    public const AREA = [
        'CMR' => 475442,
        'GAB' => 267668,
        'COD' => 2345409,
        'GNQ' => 28051,
        'COG' => 342000,
        'RWA' => 26338,
        'BDI' => 27834,
        'STP' => 964,
        'TCD' => 1284000,
        'CAF' => 622984
    ];
    public const MARINE_AREA = [
        'CMR' => 15210,
        'GAB' => 202654,
        'COG' => 33954,
        'GNQ' => 12150,
        'COD' => 13431,
        'RWA' => 0,
        'BDI' => 0,
        'STP' => 131430,
        'TCD' => 0,
        'CAF' => 0
    ];

    public function __construct(array $attributes = []) {

        $this->table = is_imet_environment()
            ? static::imet_table
            :  static::ofac_table;

        parent::__construct($attributes);
    }

    public function forceImetTable()
    {
        $this->table = static::imet_table;
    }


    /**
     * Append "name" (in the local language) to attributes list for better access
     *
     * @return mixed
     */
    public function getNameAttribute()
    {
        return $this->attributes[static::LABEL];
    }

    /**
     * Filters OFAC country
     * @param $query
     * @return mixed
     */
    public function scopeOfac($query)
    {
        $query->whereIn('iso3', self::OFAC);
        if(substr_count(url()->current(), 'admin')==0){
            $query->noAwy();
        }
        return $query;
    }

    public function scopeNotOfac($query)
    {
        $query->whereNotIn('iso3', self::OFAC);
        return $query;
    }

    /**
     * Exlude dummy AWY country
     * @param $query
     * @return mixed
     */
    public function scopeNoAwy($query)
    {
        return $query->where('iso3', '<>', 'AWY') ;
    }

    /**
     * Get country by iso
     *
     * @param $iso
     * @return mixed
     */
    public static function getByISO($iso)
    {
        $iso = strtoupper($iso);
        if(strlen($iso)==2){
            return static::where('iso2', $iso)->first();
        } elseif(strlen($iso)==3){
            return static::where('iso3', $iso)->first();
        }
    }

    /**
     * Get the list of OFAC countries
     *
     * @return mixed
     */
    public static function getOFAC()
    {
        return static::ofac()
            ->get()
            ->sortBy(static::LABEL);
    }

    /**
     * Get an array with iso2, iso3 and name
     * @param $iso
     * @return array
     */
    public static function getIsoNamePair($iso)
    {
        if($iso!==null){
            $country = static::getByISO($iso);
            return ['iso3'=>$country->iso3, 'iso2'=>$country->iso2, 'name'=>$country->name];
        }
        return ['iso3'=>'', 'iso2'=>'', 'name'=>''];
    }

    /**
     * Override: get locale of IMET form
     * @param string $type
     * @param Collection|null $collection
     * @param array $fields
     * @return array
     */
    public static function selectionList($type = 'PAIRS', Collection $collection = null, $fields = [])
    {
        $lang = App::getLocale() ?? Config::get('app.locale');
        return parent::selectionList('FIELDS', $collection, ['name_'.$lang, 'iso3']);
    }

    public static function getMapCenter($id){
        return static::getCentroidLatLon($id, 'country', 'KnowledgeBase.country_centroids');
    }

    public static function getExtent($id, $id_field = 'id', $db_table = null)
    {
        $extent = \DB::table((new AdministrationLevel())->getTable())
            ->select([\DB::raw(
                PostGis::fromDB('geom')
                    ->projectTo(4326)
                    ->apply('ST_Envelope')
                    ->toWkt('bbox')
                    ->query()
            )])
            ->where('niv_1', $id)
            ->where('niveau', '1')
            ->first();

        return \geoPHP::load($extent->bbox, 'wkt')->getBBox();
    }

}
