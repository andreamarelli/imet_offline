<?php

namespace App\Models;

use AndreaMarelli\ImetCore\Models\Country as BaseCountry;
use AndreaMarelli\ModularForms\Helpers\Locale;
use Illuminate\Database\Eloquent\Collection;

class Country extends BaseCountry
{

    /**
     * Override: get only allowed countries
     */
    public static function selectionList($type = 'PAIRS', Collection $collection = null, $fields = []): array
    {
        $label_attribute = 'name_'.Locale::lower();
        return static
            ::select(['iso3', $label_attribute])
            ->get()
            ->sortBy($label_attribute, SORT_NATURAL|SORT_FLAG_CASE)
            ->pluck($label_attribute, ('iso3'))
            ->toArray();
    }

    /**
     * Get all countries
     */
    public static function getAll(): Collection
    {
        return static::select(['name_'.Locale::lower(), 'iso3', 'iso2'])
            ->orderBy('name_'.Locale::lower())
            ->get();
    }

}
