<?php

namespace App\Http\Controllers\Imet;

use App\Library\API\DOPA\DOPA;
use App\Models\Imet\v1\Imet;
use App\Models\Imet\v1\Modules;
use App\Models\Species\Animal;
use Illuminate\Http\Request;

trait ReportV1{

    /**
     * Manage "report" edit route
     *
     * @param \App\Models\Imet\v1\Imet $item
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException|\ReflectionException
     */
    public function report(Imet $item)
    {
        /** @var $this \App\Http\Controllers\Imet\ImetControllerV1 */
        $this->authorize('update', $item);

        return view('admin.imet.v1.report.edit', $this->__retrieve_report_data($item));
    }

    /**
     * Manage "report" edit route
     *
     * @param \App\Models\Imet\v1\Imet $item
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \ReflectionException
     */
    public function report_show(Imet $item)
    {
        /** @var $this \App\Http\Controllers\Imet\ImetControllerV1 */
        $this->authorize('view', $item);

        return view('admin.imet.v1.report.show', $this->__retrieve_report_data($item));
    }

    /**
     * Manage "report" update route
     *
     * @param $item
     * @param \Illuminate\Http\Request $request
     * @return string[]
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function report_update($item, Request $request)
    {
        /** @var $this \App\Http\Controllers\Imet\ImetControllerV1 */
        $this->authorize('update', (static::$form_class)::find($item));

        \App\Models\Imet\v1\Report::updateByForm($item, $request->input('report'));
        return [ 'status' => 'success' ];
    }

    /**
     * Retrieve data to populate report view
     *
     * @param $item
     * @return array
     * @throws \ReflectionException
     */
    private function __retrieve_report_data($item)
    {
        $form_id = $item->getKey();

        $api_available = DOPA::apiAvailable();
        $wdpa_extent = $dopa_radar = $dopa_indicators = null;
        if($api_available){
            $wdpa_extent = [];
            $dopa_radar =  DOPA::get_wdpa_radarplot($item->wdpa_id);
            $dopa_indicators =  DOPA::get_wdpa_all_inds($item->wdpa_id);
        }
        $general_info = Modules\Context\GeneralInfo::getVueData($form_id);
        $vision = Modules\Context\Missions::getModuleRecords($form_id);

        $global_assessement = (array) ImetEvalControllerV1::assessment($form_id, 'global', true)->getData();

        return [
            'item' => $item,
            'key_elements' => [
                'species' => Modules\Evaluation\ImportanceSpecies::getModule($form_id)
                    ->pluck('Aspect')->map(function($item){
                        return Animal::getPlainNameByTaxonomy($item);
                    })->toArray(),
                'habitats' => Modules\Evaluation\ImportanceHabitats::getModule($form_id)
                    ->pluck('Aspect')->toArray(),
                'climate_change' => Modules\Evaluation\ImportanceClimateChange::getModule($form_id)
                    ->pluck('Aspect')->toArray(),
                'ecosystem_services' => array_values(Modules\Evaluation\ImportanceEcosystemServices::getPredefined()['values']),
                'threats' => array_values(Modules\Evaluation\Menaces::getPredefined()['values'])
            ],
            'assessment' =>  [
                'global' => $global_assessement,
                'context' => (array) ImetEvalControllerV1::assessment($form_id, 'context')->getData(),
                'planning' => (array) ImetEvalControllerV1::assessment($form_id, 'planning')->getData(),
                'inputs' => (array) ImetEvalControllerV1::assessment($form_id, 'inputs')->getData(),
                'process' => (array) ImetEvalControllerV1::assessment($form_id, 'process')->getData(),
                'outputs' => (array) ImetEvalControllerV1::assessment($form_id, 'outputs')->getData(),
                'outcomes' => (array) ImetEvalControllerV1::assessment($form_id, 'outcomes')->getData(),
                'labels' => $global_assessement['labels']
            ],
            'report' => \App\Models\Imet\v1\Report::getByForm($form_id),
            'connection' => $api_available,
            'wdpa_extent' => $wdpa_extent[0]->extent ?? null,
            'dopa_radar' =>  $dopa_radar,
            'dopa_indicators' => $dopa_indicators[0] ?? null,
            'general_info' => $general_info['records'][0] ?? null,
            'vision' => $vision['records'][0] ?? null,
            'area' => Modules\Context\Areas::getArea($form_id)
        ];
    }


}
