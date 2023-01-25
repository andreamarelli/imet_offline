<?php

namespace App\Models;

use AndreaMarelli\ImetCore\Models\Country as BaseCountry;
use AndreaMarelli\ModularForms\Helpers\Locale;
use Illuminate\Database\Eloquent\Collection;

class Country extends BaseCountry
{

    /**
     * Override: get only allowed countries
     * @param string $type
     * @param Collection|null $collection
     * @param array $fields
     * @return array
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

}
