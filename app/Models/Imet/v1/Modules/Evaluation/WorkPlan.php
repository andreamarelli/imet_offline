<?php

namespace App\Models\Imet\v1\Modules\Evaluation;

use App\Models\Imet\v1\Modules;

class WorkPlan extends Modules\Component\ImetModule_Eval
{ 
    protected $table = 'imet.eval_work_plan';
    
    public function __construct(array $attributes = []) {
    
        $this->module_type = 'SIMPLE';
        $this->module_code = 'P5';
        $this->module_title = trans('form/imet/v1/evaluation.WorkPlan.title');
        $this->module_fields = [
            ['name' => 'PlanExistenceScore',  'type' => 'rating-0to3',   'label' => trans('form/imet/v1/evaluation.WorkPlan.fields.PlanExistenceScore')],
            ['name' => 'PlanApplicationScore',  'type' => 'rating-0to3',   'label' => trans('form/imet/v1/evaluation.WorkPlan.fields.PlanApplicationScore')],
            ['name' => 'PercentageLevel',  'type' => 'integer',   'label' => trans('form/imet/v1/evaluation.WorkPlan.fields.PercentageLevel')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.WorkPlan.fields.Comments')],
        ];

        $this->module_info_EvaluationQuestion = trans('form/imet/v1/evaluation.WorkPlan.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('form/imet/v1/evaluation.WorkPlan.module_info_Rating');
        $this->ratingLegend = trans('form/imet/v1/evaluation.WorkPlan.ratingLegend');

        parent::__construct($attributes);
     
    }
}