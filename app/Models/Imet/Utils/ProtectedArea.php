<?php

namespace App\Models\Imet\Utils;

use App\Models\Components\EntityModel;
use App\Models\Country;


class ProtectedArea extends EntityModel {

    protected $table = 'imet.imet_pas';
    protected $primaryKey = 'global_id';
    public $incrementing = false; // required for textual primary_key

    public const LABEL = 'long_name';

    /**
     * Scope a query by search key
     * @param $query
     * @param $searchKey
     * @return mixed
     */
    public function scopeLike($query, $searchKey)
    {
        if($searchKey!==null && $searchKey!==''){
            $query = $query->where('name', '~~*', '%' . $searchKey . '%');
            if(is_numeric($searchKey)){
                $query =  $query->orWhere('wdpa_id', $searchKey);
            }
        }
        return $query;
    }

    /**
     * Get by global_id (to be deprecated)
     * @param $global_id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public static function getByGlobalId($global_id)
    {
        return static::where('global_id', '=', $global_id)
            ->first();
    }

    /**
     * Get by WDPA id
     * @param $wdpa
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public static function getByWdpa($wdpa)
    {
        return static::where('wdpa_id', $wdpa)
            ->first();
    }

    /**
     * Search by key or country
     * @param $search_key
     * @param null $country
     * @return mixed
     */
    public static function searchByKeyOrCountry($search_key, $country = null)
    {
        $pas = static::like($search_key)
            ->where(function ($query) use($country) {
                if($country!==null && $country!=='' && $country!=='null') {
                    $query->where('country', $country);
                }
            })
            ->orderBy('name')
            ->get();

        $countries = Country::select(['iso3', 'name_'.LOWER_LOCALE])
            ->whereIn('iso3', array_values($pas->pluck('country')->unique()->toArray()))
            ->pluck('name_'.LOWER_LOCALE, 'iso3')
            ->sort()
            ->toArray();

        return $pas->map(function($item) use($countries){
            $item['country_name'] = $countries[$item->country];
            return $item;
        });
    }

    /**
     * Get protected areas' countries
     * @return array
     */
    public static function getCountries()
    {
        $countries = static::selectRaw('regexp_split_to_table(country, \'\;\') as iso3')
            ->distinct()
            ->get()
            ->pluck('iso3')
            ->sort()
            ->toArray();

        return Country::select(['iso3', 'name_'.LOWER_LOCALE])
            ->whereIn('iso3', array_values($countries))
            ->pluck('name_'.LOWER_LOCALE, 'iso3')
            ->sort()
            ->toArray();
    }

    public function rawQueryToImet()
    {
        $values = "'".$this->global_id."', ";
        $values .= "'".$this->country."', ";
        $values .= "'".$this->wdpa_id."', ";
        $values .= "'".str_replace("'", "''", $this->name)."', ";
        $values .= "'".$this->iucn_category."', ";
        $values .= $this->creation_date!==null ? "'".$this->creation_date."'" : "NULL";
        return 'INSERT into imet.imet_pas (global_id, country, wdpa_id, name, iucn_category, creation_date) VALUES ('.$values.');';
    }

}
