<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet\Traits;

use AndreaMarelli\ImetCore\Models\ProtectedAreaNonWdpa;
use AndreaMarelli\ModularForms\Models\Traits\Payload;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Throwable;

use function view;

trait CreateAndStoreNonWdpa
{
    /**
     * Manage "create" route
     *
     * @throws AuthorizationException
     */
    public function create_non_wdpa()
    {
        $this->authorize('create', static::$form_class);

        return view(static::$form_view_prefix . '.create', ['is_wdpa' => false]);
    }

    /**
     *  Override:
     * - create prefilled IMET
     * - create IMET on non-WDPA site
     *
     * @param Request $request
     * @return array|View|mixed
     * @throws AuthorizationException|Throwable
     */
    public function store(Request $request)
    {
        $this->authorize('create', static::$form_class);

        $records = Payload::decode($request->input('records_json'));

        // #### Create a prefilled IMET (data from a previous year) ####
        if(array_key_exists('prev_year_selection', $records[0])){
            $prev_year_selection = $records[0]['prev_year_selection'] ?? null;
            unset($records[0]['prev_year_selection']);
            $request->merge(['records_json' => Payload::encode($records)]);
            if($prev_year_selection!==null && $prev_year_selection!=='no_import'){
                return $this->store_prefilled($request, $prev_year_selection);
            }
        }
        // #### Create an IMET on a non-WDPA site ####
        if(array_key_exists('name', $records[0])){
            return $this->store_non_wdpa($request);
        }

        return static::redirect_to_edit($request);
    }

    /**
     * Manage "store" route
     *
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    private function store_non_wdpa(Request $request): array
    {
        $records = Payload::decode($request->input('records_json'));

        try {

            // Create new non-WDPA pa
            $nonWdpa_record = collect($records[0])
                ->except(['version', 'Year', 'language', 'FormID', 'UpdateDate', 'UpdateBy'])
                ->toArray();
            $nonWdpa_record['id'] = ProtectedAreaNonWdpa::generate_fake_wdpa();
            $new_pa = new ProtectedAreaNonWdpa();
            $new_pa->fill($nonWdpa_record);
            $new_pa->save();

            // Create Form
            $form_record = collect($records[0])
                ->only(['name', 'version', 'Year', 'language', 'FormID', 'UpdateDate', 'UpdateBy'])
                ->toArray();
            $form_record['wdpa_id'] = $new_pa->getKey();
            $form_record['Country'] = $records[0]['country'];
            $form_record['version'] = (static::$form_class)::version;
            $request->merge(['records_json' => Payload::encode([$form_record])]);
            return static::redirect_to_edit($request);

        } catch (\Exception $e) {
            Session::flash('message', trans('modular-forms::common.saved_error'));
            throw $e;
        }
    }

    private static function redirect_to_edit($request)
    {
        $form = new static::$form_class();
        $result = $form->store($request);

        if($result['status'] === 'success'){
            $result['entity_label'] = $form::find($result['entity_id'])->{$form::LABEL};
            $result['edit_url'] = route(static::ROUTE_PREFIX. 'context_edit', ['item' => $result['entity_id']]);
        }
        return $result;
    }

}