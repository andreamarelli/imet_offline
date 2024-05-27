<?php

namespace AndreaMarelli\ImetCore\Models;

use AndreaMarelli\ImetCore\Helpers\Database;
use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ModularForms\Helpers\Locale;
use AndreaMarelli\ModularForms\Models\Utils\ProtectedArea as BaseProtectedArea;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;


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
    protected string $schema = Database::COMMON_IMET_SCHEMA;
    protected $table = 'imet_pas';
    public $primaryKey = 'global_id';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        [$this->schema, $this->connection] = Database::getSchemaAndConnection($this->schema);
    }

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
     * Parse for over-national WDPAs
     *
     * @param array $countries
     * @return array
     */
    public static function parseISOs(array $countries)
    {
        $parsed_isos = [];
        foreach ($countries as $iso) {
            if (Str::contains($iso, ';')) {
                foreach (explode(';', $iso) as $i) {
                    $parsed_isos[] = $i;
                }
            } else {
                $parsed_isos[] = $iso;
            }
        }
        $parsed_isos = array_unique($parsed_isos);
        $parsed_isos = array_values($parsed_isos);

        return $parsed_isos;
    }

    /**
     * Get protected areas' countries ISO
     *
     * @param \Closure|null $custom_where
     * @return array
     */
    public static function getCountriesISO(\Closure $custom_where = null): array
    {
        return (new ProtectedArea)->selectRaw('regexp_split_to_table(country, \'\;\') as iso3')
            ->distinct()
            ->where(function ($query)  use ($custom_where){
                if($custom_where !== null){
                    $custom_where($query);
                }
            })
            ->get()
            ->pluck('iso3')
            ->sort()
            ->toArray();
    }

    /**
     * Get protected areas' countries
     *
     * @param bool $only_allowed
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getCountries(bool $only_allowed = true): Collection
    {
        $countries = $only_allowed
            ? Role::allowedCountries()
            : static::getCountriesISO();

        return Country::select(['iso3', 'iso2', 'name_'.Locale::lower()])
            ->where(function ($query) use ($countries){
                if($countries!==null){
                    $query->whereIn('iso3', array_values($countries));
                }
            })
            ->get();
    }

    /**
     * Search by key or country
     *
     * @param string|null $search_key
     * @param string|null $country
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function searchByKeyOrCountry(?string $search_key = null, string $country = null): Collection
    {
        // Retrieve allowed WDPAs
        $allowed_wdpas = Role::allowedWdpas();

        // Retrieve Protected Areas (according to filters AND allowed)
        $protected_areas = static::
        where(function($query) use($search_key, $country){
            $query = $query->like($search_key);
            if($country != null){
                $query->orWhere('country', 'LIKE', '%' . $country . '%');  // use LIKE for over-national WDPAs
            }
        })
            ->where(function($query) use($allowed_wdpas){
                if($allowed_wdpas !== null){
                    $query->whereIn('wdpa_id', $allowed_wdpas);
                }
            })
            ->orderBy('name')
            ->get();

        // Retrieve ISOs from the Protected Areas collection
        $protected_areas_countries = static::parseISOs(
            $protected_areas->pluck('country')->unique()->toArray()
        );

        // Retrieve country names
        $countries = Country::select(['iso3', 'name_'.Locale::lower()])
            ->whereIn('iso3', $protected_areas_countries)
            ->pluck('name_'.Locale::lower(), 'iso3')
            ->sort()
            ->toArray();

        return $protected_areas->map(function($item) use($countries){
            foreach (static::parseISOs([$item->country]) as $iso){
                $item['country_name'] .= $countries[$iso] . ', ';
            }
            $item['country_name'] = rtrim($item['country_name'], ', ');
            return $item;
        });
    }


}
