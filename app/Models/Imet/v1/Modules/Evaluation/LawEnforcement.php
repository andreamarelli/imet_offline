<?php

namespace App\Models\Imet\v1\Modules\Evaluation;

use App\Models\Imet\v1\Modules;

class LawEnforcement extends Modules\Component\ImetModule_Eval
{ 
    protected $table = 'imet.eval_law_enforcement';
    
    public function __construct(array $attributes = []) {
    
        $this->module_type = 'TABLE';
        $this->module_code = 'PR10';
        $this->module_title = trans('form/imet/v1/evaluation.LawEnforcement.title');
        $this->module_fields = [
            ['name' => 'Element',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.LawEnforcement.fields.Element'), 'other'=>'rows="3"'],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3WithNA',   'label' => trans('form/imet/v1/evaluation.LawEnforcement.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.LawEnforcement.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Element',
            'values' => trans('form/imet/v1/evaluation.LawEnforcement.predefined_values')
        ];

        $this->module_info_EvaluationQuestion = trans('form/imet/v1/evaluation.LawEnforcement.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('form/imet/v1/evaluation.LawEnforcement.module_info_Rating');
        $this->ratingLegend = trans('form/imet/v1/evaluation.LawEnforcement.ratingLegend');

        parent::__construct($attributes);
     
    }
}