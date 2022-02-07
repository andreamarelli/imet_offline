<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet;

use AndreaMarelli\ImetCore\Models\Encoder;
use AndreaMarelli\ImetCore\Models\Imet\v2\Imet;
use AndreaMarelli\ImetCore\Models\Imet\v2\Imet_Eval;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use AndreaMarelli\ImetCore\Models\ProtectedArea;
use AndreaMarelli\ImetCore\Models\ProtectedAreaNonWdpa;
use AndreaMarelli\ModularForms\Helpers\File\File;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use function view;


class ControllerV2 extends Controller
{

    protected static $form_class = Imet::class;
    protected static $form_view_prefix = 'imet-core::v2.context';
    protected static $form_default_step = 'general_info';

    public const AUTHORIZE_BY_POLICY = true;

    /**
     * Manage "create" route
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create_non_wdpa()
    {
        if(static::AUTHORIZE_BY_POLICY){
            $this->authorize('create', static::$form_class);
        }
        return view(static::$form_view_prefix.'.create', ['is_wdpa' => false]);
    }

    /**
     *  Override:
     * - create prefilled IMET
     * - create IMET on non-WDPA site
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\View\View|mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request)
    {
        if(static::AUTHORIZE_BY_POLICY){
            $this->authorize('create', Imet::class);
        }

        $records = json_decode($request->input('records_json'), true);

        // #### Create an prefilled IMET (data from a previous year) ####
        if(array_key_exists('prev_year_selection', $records[0])){
            $prev_year_selection = $records[0]['prev_year_selection'] ?? null;
            unset($records[0]['prev_year_selection']);
            $request->merge(['records_json' => json_encode($records)]);
            if($prev_year_selection!==null && $prev_year_selection!=='no_import'){
                return $this->store_prefilled($request, $prev_year_selection);
            }
        }

        // #### Create an IMET on a non-WDPA site ####
        if(array_key_exists('name', $records[0])){
            return $this->store_non_wdpa($request);
        }

        return parent::store($request);
    }

    /**
     * Manage "store" route
     *
     * @param Request $request
     * @return array
     * @throws \Exception
     * @throws \Throwable
     */
    private function store_non_wdpa(Request $request): array
    {
        $records = json_decode($request->input('records_json'), true);

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
                ->only(['version', 'Year', 'language', 'FormID', 'UpdateDate', 'UpdateBy'])
                ->toArray();
            $form_record['wdpa_id'] = $new_pa->getKey();
            $form_record['Country'] = $records[0]['country'];
            $form_record['version'] = Imet::version;
            $request->merge(['records_json' => json_encode([$form_record])]);
            return parent::store($request);

        } catch (\Exception $e) {
            Session::flash('message', trans('modular-forms::common.saved_error'));
            throw $e;
        }
    }

    /**
     * Retrieve existing previous forms
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Support\Collection
     */
    public function retrieve_prev_years(Request $request): \Illuminate\Support\Collection
    {
        $year = $request->input('year');

        if($year === null){
            return collect([]);
        }
        $wdpa_id = ProtectedArea::getByWdpa($request->input('wdpa_id'))->wdpa_id;
        return Imet::select(['FormID','Year','wdpa_id'])
            ->where('wdpa_id', $wdpa_id)
            ->where('version', 'v2')
            ->where('Year', '<', $year)
            ->orderByDesc('Year')
            ->get()
            ->pluck('Year', 'FormID');
    }

    public function store_prefilled(Request $request, $prev_year_selection)
    {
        $records = json_decode($request->input('records_json'), true);

        $records[0]['language'] = null;
        $json = static::export(Imet::find($prev_year_selection), false);
        $json['Imet']['Year'] = $records[0]['Year'];
        $json['Imet']['UpdateDate'] = Carbon::now()->format('Y-m-d H:i:s');

        DB::beginTransaction();

        try {
            // Create new form and return ID
            $formID = Imet::importForm($json['Imet']);
            // Populate Imet & Imet_Eval modules
            Imet::importModules($json['Context'], $formID);
            Imet_Eval::importModules($json['Evaluation'], $formID);
            Encoder::importModule($formID, $json['Encoders'] ?? null);

            DB::commit();
            Session::flash('message', trans('modular-forms::common.saved_successfully'));
            return [
                'status' => 'success',
                'entity_label' => Imet::find($formID)->{Imet::LABEL},
                'edit_url' => action([static::class, 'edit'], ['item' => $formID])

            ];
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('message', trans('modular-forms::common.saved_error'));
            throw $e;
        }
    }

    /**
     * Manage "pdf" route
     *
     * @param $item
     * @return \Illuminate\View\View|\Symfony\Component\HttpFoundation\BinaryFileResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Spatie\Browsershot\Exceptions\CouldNotTakeBrowsershot
     */
    public function pdf($item): BinaryFileResponse
    {
        $this->authorize('view', (static::$form_class)::find($item));

        $form = new static::$form_class();
        $form = $form->find($item);
        $view = view(static::$form_view_prefix . 'print', [
            'item' => $form
        ]);
        return File::exportToPDF($form->filename('pdf'), $view);
    }

}
