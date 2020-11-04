<?php

namespace App\Models\Imet\v1\Modules\Evaluation;

use App\Models\Imet\v1\Modules;

class AchievedObjectives extends Modules\Component\ImetModule_Eval
{ 
    protected $table = 'imet.eval_achived_objectives';
    
    public function __construct(array $attributes = []) {
    
        $this->module_type = 'TABLE';
        $this->module_code = 'E/I1';
        $this->module_title = trans('form/imet/v1/evaluation.AchievedObjectives.title');
        $this->module_fields = [
            ['name' => 'Objective',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.AchievedObjectives.fields.Objective')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3',   'label' => trans('form/imet/v1/evaluation.AchievedObjectives.fields.EvaluationScore')],
            ['name' => 'Percentage',  'type' => 'integer',   'label' => trans('form/imet/v1/evaluation.AchievedObjectives.fields.Percentage')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.AchievedObjectives.fields.Comments')],
        ];

        $this->module_info_EvaluationQuestion = trans('form/imet/v1/evaluation.AchievedObjectives.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('form/imet/v1/evaluation.AchievedObjectives.module_info_Rating');
        $this->ratingLegend = trans('form/imet/v1/evaluation.AchievedObjectives.ratingLegend');
        
        parent::__construct($attributes);
     
    }
}