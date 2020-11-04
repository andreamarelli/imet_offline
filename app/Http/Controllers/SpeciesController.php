<?php

namespace App\Http\Controllers;

use App\Library\Utils\HTTP;
use App\Models\Species\Animal;
use Illuminate\Http\Request;


class SpeciesController extends Controller
{

    public const sanitization_rules = [
        'class' => 'required_without:search|max:25|alpha|in:amphibians,birds,butterflies,fishes,mammals,reptiles',
        'order' => 'max:25|alpha|nullable',
        'family' => 'max:25|alpha|nullable',
        'tab' => 'max:25|alpha_dash',
        'search' => 'alpha|nullable',
    ];

    /**
     * Publish filtered list
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function website_list(Request $request)
    {
        HTTP::sanitize($request, self::sanitization_rules);

        $class = $request->input('class', null);
        $order = $request->input('order', null);
        $family = $request->input('family', null);
        $tab = $request->input('tab');
        $search_key = $request->input('search', null);

        if($order!==null || $family!==null || $search_key!==null){

            $query = Animal::filterClass($class);

            $query = $order!==null && $family!==null
                ? $query->filterTaxonomy($class, $order, $family)
                : $query;

            $query = $search_key!==null
                ? $query->searchName($search_key)
                : $query;


            $species = $query
                ->orderBy('order')
                ->orderBy('family')
                ->orderBy('genus')
                ->orderBy('species')
                ->get();

        } else {
            $species = [];
        }

        return view('pages.africa.biodiversity.details', [
            'tab' => $tab,
            'species' => $species,
            'class' => $class,
            'order' => $order,
            'family' => $family,
        ]);
    }

    /**
     * Search Species by key
     * @param Request $request
     * @return array
     */
    public static function search(Request $request) {
        $list = collect();
        $classes = $ordersByClass = [];

        if($request->filled('search_key')){

            $list = Animal::searchSpecies($request->input('search_key'))
                ->map(function ($item){
                    if($item['iucn_redlist_category']==="LR/nt"){
                        $item['iucn_redlist_category'] = 'NT';
                    }
                    if($item['iucn_redlist_category']==="LR/lc"){
                        $item['iucn_redlist_category'] = 'LC';
                    }
                    return $item;
                });

            $taxonomy = $list
                ->map(function ($item) {
                    return [
                        'class' => $item['class'],
                        'order' => $item['order']
                    ];
                })
                ->toArray();

            $ordersByClass = [];
            foreach ($taxonomy as $t){
                if(!array_key_exists($t['class'], $ordersByClass)){
                    $ordersByClass[$t['class']] = [];
                }
                if(!in_array($t['order'], $ordersByClass[$t['class']])){
                    $ordersByClass[$t['class']][] = $t['order'];
                }
                sort($ordersByClass[$t['class']]);
            }

            $classes = array_keys($ordersByClass);
            sort($classes);
        }

        return response()->json([
            'records' => $list->toArray(),
            'classes' => $classes,
            'orders' => $ordersByClass
        ]);
    }


}