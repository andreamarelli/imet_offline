<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Components\FormController;
use App\Http\Controllers\Imet\ImetController;
use App\Library\Ofac\Select2FeedCapacity;
use App\Models\Country;
use App\Models\Person\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class StaffController extends FormController
{
    use Select2FeedCapacity;

    protected static $form_class = Person::class;
    protected static $form_view = 'person';
    protected static $form_default_step = 'general_info';

    public const AUTHORIZE_BY_POLICY = true;

    /**
     * Override index(): allow filter by initial letter
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Person::class);

        $countries = Country::all()->map->only(['iso2', 'iso3', 'name'])->keyBy('iso3')->toArray();
        $list = Person::
            select(['id', 'first_name', 'last_name', 'organisation', 'function', 'country', 'role_ofac'])
            ->with('user')
            ->get()
            ->makeHidden(['first_name', 'last_name', 'user'])
            ->map(function ($item) use($countries) {
                $item->has_user = $item->user->password !== null;
                $item->country = array_key_exists($item->country, $countries) ? $countries[$item->country] : null;
                return $item;
            })
            ->toArray();

        return view('admin.person.list', [
            'controller' => static::class,
            'list' => $list
        ]);
    }

    public function create() {
        return view('errors.404');
    }

    public function getSelectedValueForDropdown()
    {
        $keysToRetrieve = ['id' => 'id', 'text' => 'last_name'];
        return $this->getSelect2Selected(Person::class, $keysToRetrieve);
    }

    public function getListForAjaxDropdown()
    {
        $keysToSearchIn = ['last_name', 'first_name'];
        $keysToRetrieve = ['id' => 'id', 'text' => 'last_name'];
        return $this->getSelect2Data(Person::class, $keysToSearchIn, $keysToRetrieve);
    }

    /**
     * Search
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public static function search(Request $request) {
        $list = $request->filled('search_key')
            ? Person::searchByKey($request->input('search_key'))
            : collect();

        return response()->json([
            'records' => $list->toArray()
        ]);
    }
    
    public static function getEmails(Request $request) {
        $result = [];
        if($request->filled('ids')){
            $ids = explode(',', $request->input(['ids']));
            foreach ($ids as $id){
                $result[] = [
                    'id' => $id,
                    'email' => Person::find($id)->email
                ];
            }
        }
        return response()->json($result);
    }

    /**
     * Manage "update" OFFLINE user
     *
     * @param \App\Models\Person\Person $item
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update_offline(Person $item, Request $request)
    {
        $item->fill($request->all());
        if ($item->isDirty()) {
            $item->save();
        }
        return redirect()->action([ImetController::class, 'index']);
    }


}