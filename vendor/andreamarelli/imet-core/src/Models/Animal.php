<?php

namespace AndreaMarelli\ImetCore\Models;

use AndreaMarelli\ModularForms\Models\Utils\Animal as BaseAnimal;

class Animal extends BaseAnimal
{
    protected $table = 'species';
    protected $primaryKey = 'id';

    public static function getScientificName($taxonomy): ?string {
        $sciName = null;
        if ($taxonomy !== null) {
            $taxonomy_array = explode('|', $taxonomy);
            $sciName = $taxonomy_array[4] . ' ' . $taxonomy_array[5];
        }
        return $sciName;
    }

    public static function getPlainNameByTaxonomy($taxonomy): ?string {
        return $taxonomy != null && static::isTaxonomy($taxonomy)
            ? static::getScientificName($taxonomy)
            : $taxonomy;
    }
}
