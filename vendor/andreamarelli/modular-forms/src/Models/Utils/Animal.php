<?php

namespace AndreaMarelli\ModularForms\Models\Utils;

use AndreaMarelli\ModularForms\Models\BaseModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;


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
     * Scope a query to search by string
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $search_key
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearchName(Builder $query, string $search_key): Builder
    {
        return $query
            ->whereRaw('unaccent(species) ILIKE unaccent(?)', ['%'.$search_key.'%'])
            ->orWhereRaw('unaccent(genus) ILIKE unaccent(?)', ['%'.$search_key.'%'])
            ->orWhereRaw('unaccent(family) ILIKE unaccent(?)', ['%'.$search_key.'%'])
            ->orWhereRaw('unaccent(\'order\') ILIKE unaccent(?)', ['%'.$search_key.'%'])
            ->orWhereRaw('unaccent(class) ILIKE unaccent(?)', ['%'.$search_key.'%'])
            ->orWhereRaw('unaccent(phylum) ILIKE unaccent(?)', ['%'.$search_key.'%'])
            ->orWhereRaw('unaccent(common_name_en) ILIKE unaccent(?)', ['%'.$search_key.'%'])
            ->orWhereRaw('unaccent(common_name_fr) ILIKE unaccent(?)', ['%'.$search_key.'%'])
            ->orWhereRaw('unaccent(common_name_sp) ILIKE unaccent(?)', ['%'.$search_key.'%']);
    }

    /**
     * Search Species by given string
     *
     * @param string $search_key
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function searchSpecies(string $search_key): Collection
    {
        return static::searchName($search_key)
            ->orderBy('phylum')
            ->orderBy('class')
            ->orderBy('order')
            ->orderBy('family')
            ->orderBy('genus')
            ->orderBy('species')
            ->get();
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
