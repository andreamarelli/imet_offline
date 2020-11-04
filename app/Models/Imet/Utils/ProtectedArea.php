<?php

namespace App\Models\Imet\Utils;

use App\Models\Components\EntityModel;


class ProtectedArea extends EntityModel {

    protected $table = 'imet.imet_pas';
    protected $primaryKey = 'global_id';
    public $incrementing = false; // required for textual primary_key

    public const LABEL = 'long_name';

    /**
     * Relation to country
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function country_rel()
    {
        return $this->hasOne(\App\Models\Country::class, 'iso3', 'country');
    }

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
        return static::
            like($search_key)
            ->where(function ($query) use($country) {
                if($country!==null && $country!=='' && $country!=='null') {
                    $query->where('country', $country);
                }
            })
            ->orderBy('name')
            ->with('country_rel')
            ->get()
            ->map(function($item){
                $item['country_name'] = $item['country_rel']['name_'.LOWER_LOCALE];
                unset($item['country_rel']);
                return $item;
            });
    }

    /**
     * Get protected areas' countries
     * @return array
     */
    public static function getCountries()
    {
        return static::select('country')
            ->with('country_rel')
            ->distinct()
            ->get()
            ->map(function($item){
                $item['country_name'] = $item['country_rel']['name_'.LOWER_LOCALE];
                unset($item['country_rel']);
                return $item;
            })
            ->pluck('country_name', 'country')
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