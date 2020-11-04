<?php

namespace App\Models\Imet\v1\Modules\Evaluation;

use App\Models\Imet\v1\Modules;

class HRmanagementPolitics extends Modules\Component\ImetModule_Eval
{ 
    protected $table = 'imet.eval_hr_management_politics';
    
    public function __construct(array $attributes = []) {
    
        $this->module_type = 'TABLE';
        $this->module_code = 'PR2';
        $this->module_title = trans('form/imet/v1/evaluation.HRmanagementPolitics.title');
        $this->module_fields = [
            ['name' => 'Conditions',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.HRmanagementPolitics.fields.Conditions'), 'other'=>'rows="2"'],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3WithNA',   'label' => trans('form/imet/v1/evaluation.HRmanagementPolitics.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.HRmanagementPolitics.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Conditions',
            'values' => trans('form/imet/v1/evaluation.HRmanagementPolitics.predefined_values')
        ];


        $this->module_info_EvaluationQuestion = trans('form/imet/v1/evaluation.HRmanagementPolitics.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('form/imet/v1/evaluation.HRmanagementPolitics.module_info_Rating');
        $this->ratingLegend = trans('form/imet/v1/evaluation.HRmanagementPolitics.ratingLegend');
        
        parent::__construct($attributes);
     
    }
}