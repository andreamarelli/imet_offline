<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet;

use AndreaMarelli\ImetCore\Models\ProtectedAreaNonWdpa;
use AndreaMarelli\ModularForms\Helpers\API\DOPA\DOPA;
use AndreaMarelli\ImetCore\Models\Imet\v1\Imet;
use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;
use AndreaMarelli\ImetCore\Models\Animal;
use Illuminate\Http\Request;

use function view;


class ReportControllerV1 extends Controller {

    protected static $form_class = Imet::class;
    protected static $form_view_prefix = 'imet-core::v1.report';

    public const AUTHORIZE_BY_POLICY = true;

    /**
     * Manage "report" edit route
     *
     * @param $item
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException|\ReflectionException
     */
    public function report($item)
    {
        $imet = Imet::find($item);

        /** @var $this \AndreaMarelli\ImetCore\Controllers\Imet\ControllerV1 */
        $this->authorize('update', $imet);

        return view(static::$form_view_prefix . '.edit', $this->__retrieve_report_data($imet));
    }

    /**
     * Manage "report" edit route
     *
     * @param $item
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \ReflectionException
     */
    public function report_show($item)
    {
        $imet = Imet::find($item);

        /** @var $this \AndreaMarelli\ImetCore\Controllers\Imet\ControllerV1 */
        $this->authorize('view', $imet);

        return view(static::$form_view_prefix . '.show', $this->__retrieve_report_data($imet));
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
        /** @var $this \AndreaMarelli\ImetCore\Controllers\Imet\ControllerV1 */
        $this->authorize('update', (static::$form_class)::find($item));

        \AndreaMarelli\ImetCore\Models\Imet\v1\Report::updateByForm($item, $request->input('report'));
        return [ 'status' => 'success' ];
    }

    /**
     * Retrieve data to populate report view
     *
     * @param $item
     * @return array
     * @throws \ReflectionException
     */
    private function __retrieve_report_data($item): array
    {
        $form_id = $item->getKey();

        $api_available = $show_api = false;
        $wdpa_extent = $dopa_radar = $dopa_indicators = null;

        if(!ProtectedAreaNonWdpa::isNonWdpa($item->wdpa_id)) {
            $show_api = true;
            $api_available = DOPA::apiAvailable();
            if ($api_available) {
                $wdpa_extent     = [];
                $dopa_radar      = DOPA::get_wdpa_radarplot($item->wdpa_id);
                $dopa_indicators = DOPA::get_wdpa_all_inds($item->wdpa_id);
            }
        } else {
            $show_non_wdpa = true;
            $non_wdpa = ProtectedAreaNonWdpa::find($item->wdpa_id)->toArray();
        }

        $general_info = Modules\Context\GeneralInfo::getVueData($form_id);
        $vision = Modules\Context\Missions::getModuleRecords($form_id);

        $global_assessement = (array) EvalController::assessment($form_id, 'global', true)->getData();

        return [
            'item' => $item,
            'key_elements' => [
                'species' => Modules\Evaluation\ImportanceSpecies::getModule($form_id)
                    ->pluck('Aspect')->map(function($item){
                        return Animal::getByTaxonomy($item)->binomial;
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
                'context' => (array) EvalController::assessment($form_id, 'context')->getData(),
                'planning' => (array) EvalController::assessment($form_id, 'planning')->getData(),
                'inputs' => (array) EvalController::assessment($form_id, 'inputs')->getData(),
                'process' => (array) EvalController::assessment($form_id, 'process')->getData(),
                'outputs' => (array) EvalController::assessment($form_id, 'outputs')->getData(),
                'outcomes' => (array) EvalController::assessment($form_id, 'outcomes')->getData(),
                'labels' => $global_assessement['labels']
            ],
            'report' => \AndreaMarelli\ImetCore\Models\Imet\v1\Report::getByForm($form_id),
            'connection' => $api_available,
            'show_api' => $show_api,
            'wdpa_extent' => $wdpa_extent[0]->extent ?? null,
            'dopa_radar' =>  $dopa_radar,
            'dopa_indicators' => $dopa_indicators[0] ?? null,
            'show_non_wdpa' => $show_non_wdpa ?? false,
            'non_wdpa' => $non_wdpa ?? null,
            'general_info' => $general_info['records'][0] ?? null,
            'vision' => $vision['records'][0] ?? null,
            'area' => Modules\Context\Areas::getArea($form_id)
        ];
    }


}
