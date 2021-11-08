<?php

namespace AndreaMarelli\ModularForms\Controllers;

use AndreaMarelli\ModularForms\Models\User\Person;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


/**
 * Class StaffController
 *
 * @package AndreaMarelli\ModularForms\Controllers
 */
class StaffController extends FormController
{
    public const AUTHORIZE_BY_POLICY = true;

    /**
     * Search
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public static function search(Request $request): JsonResponse
    {
        $list = $request->filled('search_key')
            ? Person::searchByKey($request->input('search_key'))
            : collect();

        return response()->json([
            'records' => $list->toArray()
        ]);
    }

}
