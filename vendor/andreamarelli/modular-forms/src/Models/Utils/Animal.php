<?php

namespace AndreaMarelli\ModularForms\Models\Utils;

use AndreaMarelli\ModularForms\Helpers\Type\Chars;
use AndreaMarelli\ModularForms\Models\BaseModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;


/**
 * Class Animal
 *
 * @property string $kingdom
 * @property string $phylum
 * @property string $class
 * @property string $order
 * @property string $family
 * @property string $genus
 * @property string $specie
 * @property string $common_name_fr
 * @property string $common_name_en
 * @property string $common_name_sp
 * @property integer $iucn_redlist_id
 * @property string $iucn_redlist_category
 * @property string $country_distribution (in JSON)
 *
 * @property-read string $name
 * @property-read string $binomial
 *
 * @package AndreaMarelli\ImetCore\Models\Animals
 */
abstract class Animal extends BaseModel
{
    protected $table = null;            // to be defined
    protected $primaryKey = null;       // to be defined

    protected $appends = ['name'];

    /**
     * Accessor: "scientific_name" (binomial)
     *
     * @return string|null
     */
    public function getNameAttribute(): ?string
    {
        return array_key_exists('genus', $this->getAttributes()) && array_key_exists('species', $this->getAttributes())
            ? $this->attributes['genus'] . ' ' . $this->attributes['species']
            : null;
    }

    /**
     * Accessor: binomial (alias to "scientific_name")
     *
     * @return string|null
     */
    public function getBinomialAttribute(): ?string
    {
        return array_key_exists('genus', $this->getAttributes()) && array_key_exists('species', $this->getAttributes())
            ? $this->attributes['genus'] . ' ' . $this->attributes['species']
            : null;
    }

    /**
     * Filter a collection to search by string: Replacement for PostgreSQL unaccent() function
     *
     * @param Collection $collection
     * @param string $search_key
     * @return Collection
     */
    public static function filterBySearchString(Collection $collection, string $search_key): Collection
    {
        $collection = $collection
            ->filter(function($item) use ($search_key){
                return Chars::case_and_accent_insensitive_contains($item['phylum'], $search_key)
                    || Chars::case_and_accent_insensitive_contains($item['class'], $search_key)
                    || Chars::case_and_accent_insensitive_contains($item['order'], $search_key)
                    || Chars::case_and_accent_insensitive_contains($item['family'], $search_key)
                    || Chars::case_and_accent_insensitive_contains($item['genus'], $search_key)
                    || Chars::case_and_accent_insensitive_contains($item['species'], $search_key)
                    || Chars::case_and_accent_insensitive_contains($item['common_name_en'], $search_key)
                    || Chars::case_and_accent_insensitive_contains($item['common_name_fr'], $search_key)
                    || Chars::case_and_accent_insensitive_contains($item['common_name_sp'], $search_key);
            });
        return $collection;
    }

    /**
     * Search Species by given string
     *
     * @param string $search_key
     * @return Collection
     */
    public static function searchSpecies(string $search_key): Collection
    {
        $result = static::orderBy('phylum')
            ->orderBy('class')
            ->orderBy('order')
            ->orderBy('family')
            ->orderBy('genus')
            ->orderBy('species')
            ->get();
        return static::filterBySearchString($result, $search_key);
    }

    /**
     * Retrieve species by taxonomy
     *
     * @param string|null $taxonomy
     * @param string $separator
     * @return \AndreaMarelli\ModularForms\Models\Utils\Animal|\Illuminate\Database\Eloquent\Model
     */
    public static function getByTaxonomy(string $taxonomy = null, string $separator = '|')
    {
        return static::isTaxonomy($taxonomy)
            ? (static::where(static::parseTaxonomy($taxonomy, $separator))
                    ->first() ?? new static())
            : new static();
    }

    /**
     * Check if the given string contains taxonomy (parts divided by |)
     *
     * @param string|null $taxonomy
     * @return bool
     */
    public static function isTaxonomy(string $taxonomy = null): bool
    {
        return $taxonomy!== null && substr_count($taxonomy, '|') === 5;
    }

    /**
     * Parse a taxonomy string (all ranking from phylum to species in a single string)
     *
     * @param string $taxonomy
     * @param string $separator
     * @return array
     */
    public static function parseTaxonomy(string $taxonomy, string $separator = '|'): array
    {
        if(static::isTaxonomy($taxonomy)) {
            $taxonomy_array = explode($separator, $taxonomy);
            return [
                'phylum' => $taxonomy_array[0],
                'class' => $taxonomy_array[1],
                'order' => $taxonomy_array[2],
                'family' => $taxonomy_array[3],
                'genus' => $taxonomy_array[4],
                'species' => $taxonomy_array[5]
            ];
        }
        return [];
    }

}
