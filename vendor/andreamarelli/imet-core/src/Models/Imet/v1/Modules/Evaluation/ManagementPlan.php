<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;

class ManagementPlan extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_management_plan';

    public function __construct(array $attributes = []) {

        $this->module_type = 'SIMPLE';
        $this->module_code = 'P4';
        $this->module_title = trans('imet-core::v1_evaluation.ManagementPlan.title');
        $this->module_fields = [
            ['name' => 'PlanExistenceScore',  'type' => 'rating-0to3',   'label' => trans('imet-core::v1_evaluation.ManagementPlan.fields.PlanExistenceScore')],
            ['name' => 'PlanApplicationScore',  'type' => 'rating-0to3',   'label' => trans('imet-core::v1_evaluation.ManagementPlan.fields.PlanApplicationScore')],
            ['name' => 'PercentageLevel',  'type' => 'integer',   'label' => trans('imet-core::v1_evaluation.ManagementPlan.fields.PercentageLevel')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.ManagementPlan.fields.Comments')],
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v1_evaluation.ManagementPlan.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v1_evaluation.ManagementPlan.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v1_evaluation.ManagementPlan.ratingLegend');

        parent::__construct($attributes);

    }
}