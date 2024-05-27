<?php

namespace AndreaMarelli\ImetCore\Models;

use AndreaMarelli\ImetCore\Helpers\Database;
use AndreaMarelli\ModularForms\Models\Utils\Animal as BaseAnimal;

class Animal extends BaseAnimal
{
    protected string $schema = Database::COMMON_IMET_SCHEMA;
    protected $connection = Database::COMMON_CONNECTION;
    protected $table = 'species';
    protected $primaryKey = 'id';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        [$this->schema, $this->connection] = Database::getSchemaAndConnection($this->schema);
    }

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
