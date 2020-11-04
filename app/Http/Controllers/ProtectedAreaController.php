<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Components\FormController;
use App\Library\Utils\HTTP;
use App\Models\ProtectedArea\ProtectedArea;
use Illuminate\Http\Request;

class ProtectedAreaController extends FormController
{

    protected static $form_class = ProtectedArea::class;
    protected static $form_view = 'protected_area';

    public const sanitization_rules = [
        'country' => 'min:3|max:3|alpha|nullable',
        'iucncat' => 'max:3|alpha|nullable'
    ];
     use \App\Models\Components\Upload;

    /**
     * Publish filtered list
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function website_list(Request $request)
    {
        HTTP::sanitize($request, self::sanitization_rules);

        $protected_areas = (!$request->filled('country') && !$request->filled('iucncat'))
            ? []
            : ProtectedArea::filterList($request)->get();

        return view('pages.africa.ap.list', compact(['protected_areas']));
    }

    /**
     * Search by key
     * @param Request $request
     * @return array
     */
    public static function search(Request $request) {
        $list = collect();
        if ($request->filled('search_key') || $request->filled('country')) {
            $list = \App\Models\Imet\Utils\ProtectedArea::searchByKeyOrCountry($request->input('search_key'), $request->input('country'));
        }
        return response()->json([
                    'records' => $list->toArray(),
                    'countries' => $list->pluck('country_name', 'country')
                            ->sort()
                            ->toArray()
        ]);
    }

    public static function getLabels(Request $request) {
        $result = [];
        if($request->filled('ids')){
            $pas = explode(',', $request->input(['ids']));
            foreach ($pas as $pa){
                $result[] = [
                    'id' => $pa,
                    'label' => \App\Models\Imet\Utils\ProtectedArea::find($pa)->name
                ];
            }
        }
        return response()->json($result);
    }

}