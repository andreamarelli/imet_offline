<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;

class AchievedResults extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_achieved_results';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'R2';
        $this->module_title = trans('imet-core::v1_evaluation.AchievedResults.title');
        $this->module_fields = [
            ['name' => 'Activity',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.AchievedResults.fields.Activity')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3',   'label' => trans('imet-core::v1_evaluation.AchievedResults.fields.EvaluationScore')],
            ['name' => 'Percentage',  'type' => 'integer',   'label' => trans('imet-core::v1_evaluation.AchievedResults.fields.Percentage')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.AchievedResults.fields.Comments')],
        ];

        $this->module_info = trans('imet-core::v1_evaluation.AchievedResults.module_info');
        $this->module_info_EvaluationQuestion = trans('imet-core::v1_evaluation.AchievedResults.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v1_evaluation.AchievedResults.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v1_evaluation.AchievedResults.ratingLegend');

        $this->max_rows = 5;

        parent::__construct($attributes);

    }
}
