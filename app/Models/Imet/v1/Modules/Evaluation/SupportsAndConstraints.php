<?php

namespace App\Models\Imet\v1\Modules\Evaluation;

use App\Models\Imet\v1\Modules;

class SupportsAndConstraints extends Modules\Component\ImetModule_Eval
{ 
    protected $table = 'imet.eval_supports_and_constaints';
    
    public function __construct(array $attributes = []) {
    
        $this->module_type = 'TABLE';
        $this->module_code = 'C2';
        $this->module_title = trans('form/imet/v1/evaluation.SupportsAndConstraints.title');
        $this->module_fields = [
            ['name' => 'Aspect',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.SupportsAndConstraints.fields.Aspect')],
            ['name' => 'EvaluationScore',  'type' => 'rating-Minus3to3WithNA',   'label' => trans('form/imet/v1/evaluation.SupportsAndConstraints.fields.EvaluationScore')],
            ['name' => 'EvaluationScore2',  'type' => 'rating-1to3',   'label' => trans('form/imet/v1/evaluation.SupportsAndConstraints.fields.EvaluationScore2')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.SupportsAndConstraints.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Aspect',
            'values' => trans('form/imet/v1/evaluation.SupportsAndConstraints.predefined_values')
        ];

        $this->module_info_EvaluationQuestion = trans('form/imet/v1/evaluation.SupportsAndConstraints.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('form/imet/v1/evaluation.SupportsAndConstraints.module_info_Rating');
        $this->ratingLegend = trans('form/imet/v1/evaluation.SupportsAndConstraints.ratingLegend');
        
        parent::__construct($attributes);
     
    }
}