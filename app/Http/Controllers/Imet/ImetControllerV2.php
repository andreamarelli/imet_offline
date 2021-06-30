<?php

namespace App\Http\Controllers\Imet;

use App\Http\Controllers\Components\FormController;
use App\Http\Controllers\Imet\ScalingUp\ScalingUpAnalysis;
use App\Library\Utils\File\File;
use App\Models\Imet\Utils\ProtectedArea;
use App\Models\Imet\Utils\ProtectedAreaNonWdpa;
use App\Models\Imet\v2\Imet;
use App\Models\Imet\v2\Modules;
use Illuminate\Http\Request;


class ImetControllerV2 extends FormController
{
    use ReportV2;
    use ScalingUpAnalysis;

    protected static $form_class = Imet::class;
    protected static $form_view = 'imet/v2/context';
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
        return view('admin.'.static::$form_view.'.create', ['is_wdpa' => false]);
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
                return (new ImetController)->store_prefilled($request, $prev_year_selection);
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
            \Session::flash('message', trans('common.saved_error'));
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
        $wdpa_id = ProtectedArea::getByWdpa($request->input('wdpa_id'))->wdpa_id;
        return Imet::select(['FormID','Year','wdpa_id'])
            ->where('wdpa_id', $wdpa_id)
            ->where('version', 'v2')
            ->where('Year', '<', $request->input('year'))
            ->orderByDesc('Year')
            ->get()
            ->pluck('Year', 'FormID');
    }

    /**
     * Manage "pdf" route
     *
     * @param $item
     * @return \Illuminate\View\View|\Symfony\Component\HttpFoundation\BinaryFileResponse|null
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function pdf($item)
    {
        $this->authorize('view', (static::$form_class)::find($item));

        $form = new static::$form_class();
        $form = $form->find($item);
        $view = view('admin.'.static::$form_view.'.print', [
            'item' => $form
        ]);
        return File::exportTo('PDF', $form->filename('pdf'), $view);
    }

}
