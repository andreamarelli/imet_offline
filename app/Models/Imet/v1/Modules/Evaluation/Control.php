<?php

namespace App\Models\Imet\v1\Modules\Evaluation;

use App\Models\Imet\v1\Modules;

class Control extends Modules\Component\ImetModule_Eval
{ 
    protected $table = 'imet.eval_control';
    
    public function __construct(array $attributes = []) {
    
        $this->module_type = 'SIMPLE';
        $this->module_code = 'PR9';
        $this->module_title = trans('form/imet/v1/evaluation.Control.title');
        $this->module_fields = [
            ['name' => 'EvaluationScore',  'type' => 'rating-0to4WithNA',   'label' => trans('form/imet/v1/evaluation.Control.fields.EvaluationScore')],
            ['name' => 'Percentage',  'type' => 'integer',   'label' => trans('form/imet/v1/evaluation.Control.fields.Percentage')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.Control.fields.Comments')],
        ];

        $this->module_info_EvaluationQuestion = trans('form/imet/v1/evaluation.Control.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('form/imet/v1/evaluation.Control.module_info_Rating');
        $this->ratingLegend = trans('form/imet/v1/evaluation.Control.ratingLegend');
        
        parent::__construct($attributes);
     
    }
}