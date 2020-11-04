<?php

namespace App\Models\Imet\v1\Modules\Evaluation;

use App\Models\Imet\v1\Modules;

class Objectives extends Modules\Component\ImetModule_Eval
{ 
    protected $table = 'imet.eval_objectives';
    
    public function __construct(array $attributes = []) {
    
        $this->module_type = 'TABLE';
        $this->module_code = 'P6';
        $this->module_title = trans('form/imet/v1/evaluation.Objectives.title');
        $this->module_fields = [
            ['name' => 'Objective',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.Objectives.fields.Objective')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3WithNA',   'label' => trans('form/imet/v1/evaluation.Objectives.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.Objectives.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Objective',
            'values' => trans('form/imet/v1/evaluation.Objectives.predefined_values')
        ];

        $this->module_info_EvaluationQuestion = trans('form/imet/v1/evaluation.Objectives.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('form/imet/v1/evaluation.Objectives.module_info_Rating');
        $this->ratingLegend = trans('form/imet/v1/evaluation.Objectives.ratingLegend');

        parent::__construct($attributes);
     
    }
}