<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;

class Objectives extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_objectives';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'P6';
        $this->module_title = trans('imet-core::v1_evaluation.Objectives.title');
        $this->module_fields = [
            ['name' => 'Objective',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.Objectives.fields.Objective')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3WithNA',   'label' => trans('imet-core::v1_evaluation.Objectives.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.Objectives.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Objective',
            'values' => trans('imet-core::v1_evaluation.Objectives.predefined_values')
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v1_evaluation.Objectives.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v1_evaluation.Objectives.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v1_evaluation.Objectives.ratingLegend');

        parent::__construct($attributes);

    }
}
