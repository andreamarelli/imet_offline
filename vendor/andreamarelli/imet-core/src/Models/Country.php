<?php

namespace AndreaMarelli\ImetCore\Models;

use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ModularForms\Helpers\Locale;
use AndreaMarelli\ModularForms\Models\Utils\Country as BaseCountry;
use Illuminate\Database\Eloquent\Collection;


/**
 * Class Country
 *
 * @property integer $iso2
 * @property integer $iso3
 * @property string $name
 * @property string $Name
 *
 * @package AndreaMarelli\ImetCore\Models
 */
class Country extends BaseCountry
{
    protected $table = 'imet.imet_countries';
    public $primaryKey = 'iso3';

    /**
     * Override: get only allowed countries
     * @param string $type
     * @param Collection|null $collection
     * @param array $fields
     * @return array
     */
    public static function selectionList($type = 'PAIRS', Collection $collection = null, $fields = []): array
    {
        $allowed_countries = Role::allowedCountries();
        $collection = static::select(['iso3', 'name_'.Locale::lower()])
            ->where(function ($query) use ($allowed_countries){
                if($allowed_countries!==null){
                    $query->whereIn('iso3', array_values($allowed_countries));
                }
            })
            ->get();

        return parent::selectionList('FIELDS', $collection);
    }


}
