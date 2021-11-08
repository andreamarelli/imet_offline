<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;

class ClimateChangeMonitoring extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_climate_change_monitoring';
    protected $fixed_rows = true;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'PR17';
        $this->module_title = trans('imet-core::v2_evaluation.ClimateChangeMonitoring.title');
        $this->module_fields = [
            ['name' => 'Program',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.ClimateChangeMonitoring.fields.Program')],
            ['name' => 'EvaluationScore',  'type' => 'imet-core::rating-0to3WithNA',   'label' => trans('imet-core::v2_evaluation.ClimateChangeMonitoring.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.ClimateChangeMonitoring.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Program',
            'values' => trans('imet-core::v2_evaluation.ClimateChangeMonitoring.predefined_values')
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.ClimateChangeMonitoring.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.ClimateChangeMonitoring.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.ClimateChangeMonitoring.ratingLegend');

        parent::__construct($attributes);
    }

    public static function getModuleRecords($form_id, $collection = null): array
    {

        $module_records = parent::getModuleRecords($form_id, $collection);
        $empty_record = static::getEmptyRecord($form_id);

        $records = $module_records['records'];
        $preLoaded = [
            'field' => 'Program',
            'values' => array_merge(
                trans('imet-core::v2_evaluation.ClimateChangeMonitoring.predefined_values'),
                Modules\Evaluation\ImportanceClimateChange::getModule($form_id)->filter(function ($item){
                    return $item['IncludeInStatistics'];
                })->pluck('Aspect')->toArray()
            )
        ];
        $module_records['records'] =  static::arrange_records($preLoaded, $records, $empty_record);

        return $module_records;
    }


}
