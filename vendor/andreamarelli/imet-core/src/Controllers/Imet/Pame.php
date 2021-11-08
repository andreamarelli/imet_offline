<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet;


use AndreaMarelli\ImetCore\Controllers\Imet\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

trait Pame{

    /**
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public static function pame(Request $request): JsonResponse
    {
        $conditions = [];
        if ($request->filled('iso')) {
            $conditions[] = ['Country', '=', $request->input('iso')];
        }

        $imets = (static::$form_class)
            ::select(['Year as year', 'Country as iso', 'wdpa_id', 'name'])
            ->where($conditions)
            ->get()
            ->sortBy('wdpa_id')
            ->sortBy('iso')
            ->sortBy('year')
            ->toArray();

        return self::sendAPIResponse($imets, $request);
    }

}
