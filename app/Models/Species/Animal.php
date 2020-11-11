<?php

namespace App\Models\Species;

use App\Models\Components\EntityModel;
use Illuminate\Support\Facades\DB;


class Animal extends EntityModel
{

    protected $primaryKey = 'id';
//    protected $table = 'species';
    protected $appends = [
        'name',
    ];
    protected $classes = ['amphibians', 'birds', 'butterflies', 'fishes', 'mammals', 'reptiles'];

    public function __construct(array $attributes = []) {

        $this->table = \App::environment('imetoffline')
            ? 'species'
            : 'KnowledgeBase.species';

        parent::__construct($attributes);
    }

    /**
     * Append "scientific_name" to attributes list for better access
     *
     * @return mixed
     */
    public function getNameAttribute()
    {
        return $this->attributes['genus'] . ' ' . $this->attributes['species'];
    }

    /**
     * Scope a query to filter by class
     *
     * @param \Illuminate\Database\Query\Builder $query
     * @param $class
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeFilterClass($query, $class = null)
    {
        if ($class !== null) {
            if ($class == 'fishes') {
                return $query
                    ->where('class', 'Sarcopterygii')
                    ->orWhere('class', 'Actinopterygii')
                    ->orWhere('class', 'Chondrichthyes');
            }
            $class = ($class == 'mammals') ? 'Mammalia' : $class;
            $class = ($class == 'birds') ? 'Aves' : $class;
            $class = ($class == 'reptiles') ? 'Reptilia' : $class;
            $class = ($class == 'amphibians') ? 'Amphibia' : $class;
            $class = ($class == 'butterflies') ? 'Insecta' : $class;
            $query = $query->where('class', $class);
        }
        return $query;
    }

    /**
     * Scope a query to filter by taxonomy
     *
     * @param \Illuminate\Database\Query\Builder $query
     * @param $class
     * @param $order
     * @param $family
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeFilterTaxonomy($query, $class, $order, $family)
    {
        return $query
            ->filterClass($class)
            ->where('order', $order)
            ->where('family', $family);
    }

    /**
     * Scope a query to search by string
     *
     * @param \Illuminate\Database\Query\Builder $query
     * @param $search_key
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeSearchName($query, $search_key)
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
     * Get the number of species for the given class
     *
     * @param $class
     * @return mixed
     */
    public static function getNumByClass($class)
    {
        return static::filterClass($class)->count();
    }

    /**
     * Get a 2-dimension array with order/family structure
     *
     * @param $class
     * @return array
     */
    public static function getTaxonomyStructure($class)
    {

        $species = static::select(DB::raw('DISTINCT("family"), "order"'))
                ->filterClass($class)
                ->orderBy('order')
                ->orderBy('family')
                ->get();

        $taxonomy = [];
        foreach ($species as $item) {
            if (!isset($taxonomy[$item['order']])) {
                $taxonomy[$item['order']] = array();
            }
            $taxonomy[$item['order']][] = $item['family'];
        }
        return $taxonomy;
    }

    public static function searchSpecies($search_key) {

        return static::searchName($search_key)
                        ->orderBy('phylum')
                        ->orderBy('class')
                        ->orderBy('order')
                        ->orderBy('family')
                        ->orderBy('genus')
                        ->orderBy('species')
                        ->get();
    }

    public static function getByTaxonomy($binomial, $family, $order) {
        list($genus, $species) = explode(' ', $binomial);
        return static::where('species', '=', $species)
                        ->where('genus', '=', $genus)
                        ->where('family', '=', $family)
                        ->where('order', '=', $order)
                        ->get();
    }

    private static function isTaxonomy($taxonomy)
    {
        return substr_count($taxonomy, '|') === 5;
    }

    private static function getScientificName ($taxonomy){
        $sciName = null;
        if($taxonomy!==null){
            $taxonomy_array = explode('|', $taxonomy);
            $sciName =  $taxonomy_array[4] . ' ' . $taxonomy_array[5];
        }
        return $sciName;
    }

    public static function getPlainNameByTaxonomy($taxonomy)
    {
        return $taxonomy!=null && static::isTaxonomy($taxonomy)
            ? static::getScientificName($taxonomy)
            : $taxonomy;
    }

    public static function getCommonName($taxonomy)
    {
            $common_name=null;


                    $taxonomy_array = explode('|', $taxonomy);
                    $record= static::where('species', '=', $taxonomy_array[5])
                                        ->where('genus', '=', $taxonomy_array[4])
                                        ->where('family', '=', $taxonomy_array[3])
                                        ->where('order', '=', $taxonomy_array[2])
                                        ->where('class', '=', $taxonomy_array[1])
                                        ->where('phylum', '=', $taxonomy_array[0])
                                        ->first()
                                        ->toArray();

                    $common_name=(!empty($record)) ? $record['common_name_fr'] .
                        ' ' . $record['common_name_en'] .
                        ' ' . $record['common_name_sp'] : '';

            return $common_name;
    }


        public static function getIUCNCategory($taxonomy){
            $record=null;
             if(static::isTaxonomy($taxonomy)){
                 $taxonomy_array = explode('|', $taxonomy);
                 $record= static::where('species', '=', $taxonomy_array[5])
                                        ->where('genus', '=', $taxonomy_array[4])
                                        ->where('family', '=', $taxonomy_array[3])
                                        ->where('order', '=', $taxonomy_array[2])
                                        ->where('class', '=', $taxonomy_array[1])
                                        ->where('phylum', '=', $taxonomy_array[0])
                                        ->first()
                                        ->toArray();
             }

            return !empty($record)? $record['iucn_redlist_category']: null;
        }

}
