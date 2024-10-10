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

    public const CREATED_AT = null;
    public const UPDATED_AT = null;
    public const UPDATED_BY = null;
    public const CREATED_BY = null;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        [$this->table, $this->connection] = Database::getTableAndConnection($this->table,$this->schema);
    }

    /**
     * @deprecated
     * Get by global_id
     */
    public static function getByGlobalId($global_id) : ?ProtectedArea
    {
        return static::where('global_id', '=', $global_id)
            ->first();
    }

    /**
     * Parse for over-national WDPAs
     */
    public static function parseISOs(array $countries): array
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
     */
    public static function getCountriesISO(\Closure $custom_where = null): array
    {
        $iso3s = [];

        ProtectedArea::select('country')
            ->distinct()
            ->where(function ($query)  use ($custom_where){
                if($custom_where !== null){
                    $custom_where($query);
                }
            })
            ->get()
            ->pluck('country')
            ->sort()
            ->each(function($iso) use (&$iso3s){
                $iso3s = array_merge($iso3s, explode(';', $iso));
            });

        return $iso3s;
    }

    /**
     * Get protected areas' countries
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
