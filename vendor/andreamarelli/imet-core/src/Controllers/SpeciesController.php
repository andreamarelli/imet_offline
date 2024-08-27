<?php

namespace AndreaMarelli\ImetCore\Controllers;

use AndreaMarelli\ModularForms\Controllers\Controller;
use AndreaMarelli\ModularForms\Helpers\HTTP;
use AndreaMarelli\ImetCore\Models\Animal;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class SpeciesController extends Controller
{
    /**
     * Search Species by key
     */
    public static function search(Request $request): JsonResponse
    {
        $species = collect();
        $ordersByClass = [];

        // Perform search only if search_key provided
        if($request->filled('search_key')){

            HTTP::sanitize($request, [
                'search' => 'alpha|nullable'
            ]);

            // Perform search query
            $species = Animal::searchSpecies($request->input('search_key'))
                ->map(function ($item){
                    if($item['iucn_redlist_category']==="LR/nt"){
                        $item['iucn_redlist_category'] = 'NT';
                    }
                    if($item['iucn_redlist_category']==="LR/lc"){
                        $item['iucn_redlist_category'] = 'LC';
                    }
                    return $item;
                });

            // Organize order by classes
            $ordersByClass = $species
                ->map->only(['class','order'])
                ->unique()
                ->sortBy('order')
                ->sortBy('class')
                ->mapToGroups(function ($item) {
                    return [$item['class'] => $item['order']];
                })
                ->toArray();
        }

        return static::sendAPIResponse($species->toArray(), null, 200, [
            'classes' => array_keys($ordersByClass),
            'orders' => $ordersByClass
        ]);
    }
}
