<?php

namespace App\Models\Imet\v1\Modules\Evaluation;

use App\Models\Imet\v1\Modules;

class AdministrativeManagement extends Modules\Component\ImetModule_Eval
{ 
    protected $table = 'imet.eval_administrative_management';
    
    public function __construct(array $attributes = []) {
    
        $this->module_type = 'SIMPLE';
        $this->module_code = 'PR5';
        $this->module_title = trans('form/imet/v1/evaluation.AdministrativeManagement.title');
        $this->module_fields = [
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3',   'label' => trans('form/imet/v1/evaluation.AdministrativeManagement.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.AdministrativeManagement.fields.Comments')],
        ];

        $this->module_info_EvaluationQuestion = trans('form/imet/v1/evaluation.AdministrativeManagement.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('form/imet/v1/evaluation.AdministrativeManagement.module_info_Rating');
        $this->ratingLegend = trans('form/imet/v1/evaluation.AdministrativeManagement.ratingLegend');
        
        parent::__construct($attributes);
     
    }
}