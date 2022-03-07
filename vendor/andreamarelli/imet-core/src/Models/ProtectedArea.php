<?php

namespace AndreaMarelli\ImetCore\Models;

use AndreaMarelli\ModularForms\Helpers\Locale;
use AndreaMarelli\ModularForms\Models\Utils\ProtectedArea as BaseProtectedArea;

use Illuminate\Support\Collection;

/**
 * Class ProtectedArea
 *
 * @property string $global_id
 * @property string $country
 * @property integer $wdpa_id
 * @property string $name
 * @property string $iucn_category
 * @property string $creation_date
 * @property numeric $area
 *
 * @package AndreaMarelli\ImetCore\Models
 */
class ProtectedArea extends BaseProtectedArea
{

    protected $table = 'imet.imet_pas';
    public $primaryKey = 'global_id';

    /**
     * @deprecated
     * Get by global_id
     *
     * @param $global_id
     * @return \AndreaMarelli\ImetCore\Models\ProtectedArea|\Illuminate\Database\Eloquent\Model|object|null
     */
    public static function getByGlobalId($global_id)
    {
        return static::where('global_id', '=', $global_id)
            ->first();
    }

    /**
     * Get protected areas' countries
     *
     * @return \AndreaMarelli\ImetCore\Models\Country[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getCountries()
    {
        $countries = (new ProtectedArea)->selectRaw('regexp_split_to_table(country, \'\;\') as iso3')
            ->distinct()
            ->get()
            ->pluck('iso3')
            ->sort()
            ->toArray();

        return Country::select(['iso3', 'iso2', 'name_'.Locale::lower()])
            ->whereIn('iso3', array_values($countries))
            ->get();
    }

    /**
     * Search by key or country
     *
     * @param string|null $search_key
     * @param string|null $country
     * @return \Illuminate\Support\Collection
     */
    public static function searchByKeyOrCountry(?string $search_key = null, string $country = null): Collection
    {
        $pas = static::like($search_key)
            ->where(function ($query) use($country) {
                if($country!==null && $country!=='' && $country!=='null') {
                    $query->where('country', $country);
                }
            })
            ->orderBy('name')
            ->get();

        $countries = Country::select(['iso3', 'name_'.Locale::lower()])
            ->whereIn('iso3', array_values($pas->pluck('country')->unique()->toArray()))
            ->pluck('name_'.Locale::lower(), 'iso3')
            ->sort()
            ->toArray();

        return $pas->map(function($item) use($countries){
            $item['country_name'] = $countries[$item->country];
            return $item;
        });
    }

}
