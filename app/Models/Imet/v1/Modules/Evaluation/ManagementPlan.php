<?php

namespace App\Models\Imet\v1\Modules\Evaluation;

use App\Models\Imet\v1\Modules;

class ManagementPlan extends Modules\Component\ImetModule_Eval
{ 
    protected $table = 'imet.eval_management_plan';
    
    public function __construct(array $attributes = []) {
    
        $this->module_type = 'SIMPLE';
        $this->module_code = 'P4';
        $this->module_title = trans('form/imet/v1/evaluation.ManagementPlan.title');
        $this->module_fields = [
            ['name' => 'PlanExistenceScore',  'type' => 'rating-0to3',   'label' => trans('form/imet/v1/evaluation.ManagementPlan.fields.PlanExistenceScore')],
            ['name' => 'PlanApplicationScore',  'type' => 'rating-0to3',   'label' => trans('form/imet/v1/evaluation.ManagementPlan.fields.PlanApplicationScore')],
            ['name' => 'PercentageLevel',  'type' => 'integer',   'label' => trans('form/imet/v1/evaluation.ManagementPlan.fields.PercentageLevel')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.ManagementPlan.fields.Comments')],
        ];

        $this->module_info_EvaluationQuestion = trans('form/imet/v1/evaluation.ManagementPlan.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('form/imet/v1/evaluation.ManagementPlan.module_info_Rating');
        $this->ratingLegend = trans('form/imet/v1/evaluation.ManagementPlan.ratingLegend');
        
        parent::__construct($attributes);
     
    }
}