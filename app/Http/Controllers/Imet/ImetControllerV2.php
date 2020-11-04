<?php

namespace App\Http\Controllers\Imet;

use App\Http\Controllers\Components\FormController;
use App\Library\API\DOPA\DOPA;
use App\Library\Utils\File\File;
use App\Library\Utils\PhpClass;
use App\Models\Components\ModuleKey;
use App\Models\Imet\Utils\ProtectedArea;
use App\Models\Imet\v2\Imet;
use App\Models\Imet\v2\Modules;
use App\Models\Imet\v2\Report;
use App\Models\Species\Animal;
use Illuminate\Http\Request;


class ImetControllerV2 extends FormController
{
    protected static $form_class = Imet::class;
    protected static $form_view = 'imet/v2/context';
    protected static $form_default_step = 'general_info';

    public const AUTHORIZE_BY_POLICY = true;

    /**
     * Retrieve existing previous forms
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Support\Collection
     */
    public function retrieve_prev_years(Request $request)
    {
        $wdpa_id = ProtectedArea::getByWdpa($request->input('wdpa_id'))->wdpa_id;
        return Imet::select(['FormID','Year','wdpa_id'])
            ->where('wdpa_id', $wdpa_id)
            ->where('Year', '<', $request->input('year'))
            ->orderByDesc('Year')
            ->get()
            ->pluck('Year', 'FormID');
    }

    public function store(Request $request)
    {
        $records = json_decode($request->input('records_json'), true);

        // Export previous existing form and save as new (if selected)
        $prev_year_selection = $records[0]['prev_year_selection'] ?? null;
        if($prev_year_selection!==null && $prev_year_selection!=='no_import'){
            return (new ImetController)->store_prefilled($request);
        }

        // Create new form
        return parent::store($request);
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

    /**
     * Manage "report" route
     *
     * @param \App\Models\Imet\v2\Imet $item
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException|\ReflectionException
     */
    public function report(Imet $item)
    {
        $this->authorize('update', $item);

        $form_id = $item->getKey();

        $api_available = DOPA::apiAvailable();
        $wdpa_extent = $dopa_radar = $dopa_indicators = $general_info = $vision = null;
        if($api_available){
            $wdpa_extent = [];
            $dopa_radar =  DOPA::get_wdpa_radarplot($item->wdpa_id);
            $dopa_indicators =  DOPA::get_wdpa_all_inds($item->wdpa_id);
        }
        $general_info = Modules\Context\GeneralInfo::getVueData($form_id);
        $vision = Modules\Context\Missions::getModuleRecords($form_id);

        $global_assessement = (array) ImetEvalControllerV2::assessment($form_id, 'global', true)->getData();

        return view('admin.imet.v2.report.report', [
            'item' => $item,
            'key_elements' => [
                'species' => Modules\Evaluation\ImportanceSpecies::getModule($form_id)->filter(function ($item){
                        return $item['IncludeInStatistics'];
                    })->pluck('Aspect')->map(function($item){
                        return Animal::getPlainNameByTaxonomy($item);
                    })->toArray(),
                'habitats' => Modules\Evaluation\ImportanceHabitats::getModule($form_id)->filter(function ($item){
                        return $item['IncludeInStatistics'];
                    })->pluck('Aspect')->toArray(),
                'climate_change' => Modules\Evaluation\ImportanceClimateChange::getModule($form_id)->filter(function ($item){
                        return $item['IncludeInStatistics'];
                    })->pluck('Aspect')->toArray(),
                'ecosystem_services' => Modules\Evaluation\ImportanceEcosystemServices::getModule($form_id)->filter(function ($item){
                        return $item['IncludeInStatistics'];
                    })->pluck('Aspect')->toArray(),
                'threats' => Modules\Evaluation\Menaces::getModule($form_id)->filter(function ($item){
                    return $item['IncludeInStatistics'];
                })->pluck('Aspect')->toArray(),
            ],
            'assessment' =>  [
                'global' => $global_assessement,
                'context' => (array) ImetEvalControllerV2::assessment($form_id, 'context')->getData(),
                'planning' => (array) ImetEvalControllerV2::assessment($form_id, 'planning')->getData(),
                'inputs' => (array) ImetEvalControllerV2::assessment($form_id, 'inputs')->getData(),
                'process' => (array) ImetEvalControllerV2::assessment($form_id, 'process')->getData(),
                'outputs' => (array) ImetEvalControllerV2::assessment($form_id, 'outputs')->getData(),
                'outcomes' => (array) ImetEvalControllerV2::assessment($form_id, 'outcomes')->getData(),
                'labels' => $global_assessement['labels']
            ],
            'report' => Report::getByForm($form_id),
            'connection' => $api_available,
            'wdpa_extent' => $wdpa_extent[0]->extent ?? null,
            'dopa_radar' =>  $dopa_radar,
            'dopa_indicators' => $dopa_indicators[0] ?? null,
            'general_info' => $general_info['records'][0] ?? null,
            'vision' => $vision['records'][0] ?? null,
            'area' => Modules\Context\Areas::getArea($form_id)
        ]);
    }

    /**
     *
     * Manage "report" update route
     *
     * @param $item
     * @param \Illuminate\Http\Request $request
     * @return string[]
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function report_update($item, Request $request)
    {
        $this->authorize('view', (static::$form_class)::find($item));

        Report::updateByForm($item, $request->input('report'));
        return [ 'status' => 'success' ];
    }

}