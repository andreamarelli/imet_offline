<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ModularForms\Models\Traits\Payload;
use Illuminate\Http\Request;

class ImportanceEcosystemServices extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_importance_c16';
    protected $fixed_rows = true;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'C1.5';
        $this->module_title = trans('imet-core::v2_evaluation.ImportanceEcosystemServices.title');
        $this->module_fields = [
            ['name' => 'Aspect', 'type' => 'blade-imet-core::v2.evaluation.fields.importance_ecosystem_services_aspect',   'label' => trans('imet-core::v2_evaluation.ImportanceEcosystemServices.fields.Aspect')],
            ['name' => 'EvaluationScore',  'type' => 'imet-core::rating-0to3WithNA',   'label' => trans('imet-core::v2_evaluation.ImportanceEcosystemServices.fields.EvaluationScore')],
            ['name' => 'IncludeInStatistics',  'type' => 'checkbox-boolean',   'label' => trans('imet-core::v2_evaluation.ImportanceEcosystemServices.fields.IncludeInStatistics')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.ImportanceEcosystemServices.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Aspect',
            'values' => null
        ];

        $this->module_subTitle = trans('imet-core::v2_evaluation.ImportanceEcosystemServices.module_subTitle');
        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.ImportanceEcosystemServices.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.ImportanceEcosystemServices.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.ImportanceEcosystemServices.ratingLegend');

        parent::__construct($attributes);
    }

    public static function getModuleRecords($form_id, $collection = null): array
    {
        $module_records = parent::getModuleRecords($form_id, $collection);
        $empty_record = static::getEmptyRecord($form_id);

        $records_from_context = Modules\Context\EcosystemServices::getModule($form_id)
            ->filter(function ($item){
                return $item['Importance']!==null;
            })
            ->map(function ($item){
                $item['_rank'] = ($item['Importance'] + ($item['ImportanceRegional']/3) + ((2-$item['ImportanceGlobal'])/4)) /3 * 100;
                return $item;
            })
            ->sortByDesc('_rank');

        $records = $module_records['records'];
        $preLoaded = [
            'field' => 'Aspect',
            'values' => $records_from_context
                ->map(function ($item){
                    return $item['Element'];
                })
        ];
        $module_records['records'] =  static::arrange_records($preLoaded, $records, $empty_record);

        // Inject also rankings
        foreach (array_values($records_from_context->toArray()) as $index=>$record){
            $module_records['records'][$index]['_rank'] = $record['_rank'];
            $module_records['records'][$index]['_Importance'] = $record['Importance'];
            $module_records['records'][$index]['_ImportanceRegional'] = $record['ImportanceRegional'];
            $module_records['records'][$index]['_ImportanceGlobal'] = $record['ImportanceGlobal'];
        }

        return $module_records;
    }

    public static function getVueData($form_id, $collection = null): array
    {
        $vue_data = parent::getVueData($form_id, $collection);
        $vue_data['warning_on_save'] =  trans('imet-core::v2_evaluation.ImportanceEcosystemServices.warning_on_save');
        return $vue_data;
    }


    public static function updateModule(Request $request): array
    {
        static::forceLanguage($request->input('form_id'));

        $records = Payload::decode($request->input('records_json'));
        $form_id = $request->input('form_id');

        static::dropFromDependencies($form_id, $records, [
            Modules\Evaluation\InformationAvailability::class,
            Modules\Evaluation\KeyConservationTrend::class,
            Modules\Evaluation\ManagementActivities::class,
            Modules\Evaluation\EcosystemServices::class,

        ]);

        return parent::updateModule($request);
    }

}
