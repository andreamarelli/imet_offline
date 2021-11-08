<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;

class EcosystemServices extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_ecosystem_services';
    protected $fixed_rows = true;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'PR18';
        $this->module_title = trans('imet-core::v2_evaluation.EcosystemServices.title');
        $this->module_fields = [
            ['name' => 'Intervention',      'type' => 'blade-imet-core::v2.evaluation.fields.show',  'label' => trans('imet-core::v2_evaluation.EcosystemServices.fields.Intervention')],
            ['name' => 'EvaluationScore',   'type' => 'imet-core::rating-0to3WithNA',      'label' => trans('imet-core::v2_evaluation.EcosystemServices.fields.EvaluationScore')],
            ['name' => 'Comments',          'type' => 'text-area',                   'label' => trans('imet-core::v2_evaluation.EcosystemServices.fields.Comments')],
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.EcosystemServices.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.EcosystemServices.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.EcosystemServices.ratingLegend');

        parent::__construct($attributes);
    }

    public static function getModuleRecords($form_id, $collection = null): array
    {

        $module_records = parent::getModuleRecords($form_id, $collection);
        $empty_record = static::getEmptyRecord($form_id);

        $records = $module_records['records'];
        $preLoaded = [
            'field' => 'Intervention',
            'values' => Modules\Evaluation\ImportanceEcosystemServices::getModule($form_id)->filter(function ($item){
                            return $item['IncludeInStatistics'];
                        })->pluck('Aspect')->toArray(),
        ];
        $module_records['records'] =  static::arrange_records($preLoaded, $records, $empty_record);

        return $module_records;
    }



}
