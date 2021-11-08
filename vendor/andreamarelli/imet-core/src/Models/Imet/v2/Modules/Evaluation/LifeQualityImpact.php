<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;

class LifeQualityImpact extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_life_quality_impact';

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'O/C3';
        $this->module_title = trans('imet-core::v2_evaluation.LifeQualityImpact.title');
        $this->module_fields = [
            ['name' => 'Element',           'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.LifeQualityImpact.fields.Element')],
            ['name' => 'EvaluationScore',   'type' => 'imet-core::rating-Minus3to3WithNA',   'label' => trans('imet-core::v2_evaluation.LifeQualityImpact.fields.EvaluationScore')],
            ['name' => 'Comments',          'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.LifeQualityImpact.fields.Comments')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::v2_evaluation.LifeQualityImpact.groups.group0'),
            'group1' => trans('imet-core::v2_evaluation.LifeQualityImpact.groups.group1')
        ];

        $this->predefined_values = [
            'field' => 'Element',
            'values' => [
                'group0' => trans('imet-core::v2_evaluation.LifeQualityImpact.predefined_values.group0'),
                'group1' => trans('imet-core::v2_evaluation.LifeQualityImpact.predefined_values.group1')
            ]
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.LifeQualityImpact.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.LifeQualityImpact.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.LifeQualityImpact.ratingLegend');

        parent::__construct($attributes);

    }
}
