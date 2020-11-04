<?php

namespace App\Models\Imet\v2\Modules\Evaluation;

use App\Models\Imet\v2\Modules;

class LifeQualityImpact extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_life_quality_impact';

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'O/C3';
        $this->module_title = trans('form/imet/v2/evaluation.LifeQualityImpact.title');
        $this->module_fields = [
            ['name' => 'Element',           'type' => 'text-area',   'label' => trans('form/imet/v2/evaluation.LifeQualityImpact.fields.Element')],
            ['name' => 'EvaluationScore',   'type' => 'blade-admin.imet.components.rating-Minus3to3WithNA',   'label' => trans('form/imet/v2/evaluation.LifeQualityImpact.fields.EvaluationScore')],
            ['name' => 'Comments',          'type' => 'text-area',   'label' => trans('form/imet/v2/evaluation.LifeQualityImpact.fields.Comments')],
        ];

        $this->module_groups = [
            'group0' => trans('form/imet/v2/evaluation.LifeQualityImpact.groups.group0'),
            'group1' => trans('form/imet/v2/evaluation.LifeQualityImpact.groups.group1')
        ];

        $this->predefined_values = [
            'field' => 'Element',
            'values' => [
                'group0' => trans('form/imet/v2/evaluation.LifeQualityImpact.predefined_values.group0'),
                'group1' => trans('form/imet/v2/evaluation.LifeQualityImpact.predefined_values.group1')
            ]
        ];

        $this->module_info_EvaluationQuestion = trans('form/imet/v2/evaluation.LifeQualityImpact.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('form/imet/v2/evaluation.LifeQualityImpact.module_info_Rating');
        $this->ratingLegend = trans('form/imet/v2/evaluation.LifeQualityImpact.ratingLegend');

        parent::__construct($attributes);

    }
}