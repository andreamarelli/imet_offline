<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;

class Implications extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_implications';

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'PR11';
        $this->module_title = trans('imet-core::v1_evaluation.Implications.title');
        $this->module_fields = [
            ['name' => 'Actor',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.Implications.fields.Actor')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3WithNA',   'label' => trans('imet-core::v1_evaluation.Implications.fields.EvaluationScore')],
            ['name' => 'Percentage',  'type' => 'integer',   'label' => trans('imet-core::v1_evaluation.Implications.fields.Percentage')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.Implications.fields.Comments')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::v1_evaluation.Implications.groups.group0'),
            'group1' => trans('imet-core::v1_evaluation.Implications.groups.group1'),
            'group2' => trans('imet-core::v1_evaluation.Implications.groups.group2'),
            'group3' => trans('imet-core::v1_evaluation.Implications.groups.group3')
        ];

        $this->predefined_values = [
            'field' => 'Actor',
            'values' => [
                'group0' => trans('imet-core::v1_evaluation.Implications.predefined_values.group0'),
                'group1' => trans('imet-core::v1_evaluation.Implications.predefined_values.group1')
            ]
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v1_evaluation.Implications.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v1_evaluation.Implications.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v1_evaluation.Implications.ratingLegend');

        parent::__construct($attributes);

    }
}
