<?php

namespace App\Models\Imet\v1\Modules\Evaluation;

use App\Models\Imet\v1\Modules;

class AssistanceActivities extends Modules\Component\ImetModule_Eval
{ 
    protected $table = 'imet.eval_assistance_activities';
    
    public function __construct(array $attributes = []) {
    
        $this->module_type = 'TABLE';
        $this->module_code = 'PR12';
        $this->module_title = trans('form/imet/v1/evaluation.AssistanceActivities.title');
        $this->module_fields = [
            ['name' => 'Activity',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.AssistanceActivities.fields.Activity')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3WithNA',   'label' => trans('form/imet/v1/evaluation.AssistanceActivities.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.AssistanceActivities.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Activity',
            'values' => trans('form/imet/v1/evaluation.AssistanceActivities.predefined_values')
        ];

        $this->module_info_EvaluationQuestion = trans('form/imet/v1/evaluation.AssistanceActivities.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('form/imet/v1/evaluation.AssistanceActivities.module_info_Rating');
        $this->ratingLegend = trans('form/imet/v1/evaluation.AssistanceActivities.ratingLegend');

        parent::__construct($attributes);
     
    }
}