<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class Objectives extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet_oecm.eval_objectives';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'P6';
        $this->module_title = trans('imet-core::oecm_evaluation.Objectives.title');
        $this->module_fields = [
            ['name' => 'Objective',  'type' => 'text-area',   'label' => trans('imet-core::oecm_evaluation.Objectives.fields.Objective')],
            ['name' => 'EvaluationScore',  'type' => 'imet-core::rating-0to3WithNA',   'label' => trans('imet-core::oecm_evaluation.Objectives.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::oecm_evaluation.Objectives.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Objective',
            'values' => trans('imet-core::oecm_evaluation.Objectives.predefined_values')
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.Objectives.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::oecm_evaluation.Objectives.module_info_Rating');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.Objectives.ratingLegend');

        parent::__construct($attributes);
    }

    protected static function getPredefined($form_id = null)
    {
        $predefined = (new static())->predefined_values;

        $c12_values = collect(KeyElements::getModuleRecords($form_id)['records'])
            ->filter(function($item){
                return $item['IncludeInStatistics'];
            })
            ->pluck('Aspect')
            ->toArray();

        $predefined['values'] = array_merge($c12_values,$predefined['values']);

        return $predefined;
    }

}
