<?php

namespace App\Models\Imet\v1\Modules\Evaluation;

use App\Models\Imet\v1\Modules;

class ImportanceClimateChange extends Modules\Component\ImetModule_Eval
{ 
    protected $table = 'imet.eval_importance_c15';
    
    public function __construct(array $attributes = []) {
    
        $this->module_type = 'TABLE';
        $this->module_code = 'C1.5';
        $this->module_title = trans('form/imet/v1/evaluation.ImportanceClimateChange.title');
        $this->module_fields = [
            ['name' => 'Aspect',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.ImportanceClimateChange.fields.Aspect')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3WithNA',   'label' => trans('form/imet/v1/evaluation.ImportanceClimateChange.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.ImportanceClimateChange.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Aspect',
            'values' => trans('form/imet/v1/evaluation.ImportanceClimateChange.predefined_values')
        ];

        $this->module_subTitle = trans('form/imet/v1/evaluation.ImportanceClimateChange.module_subTitle');
        $this->module_info_EvaluationQuestion = trans('form/imet/v1/evaluation.ImportanceClimateChange.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('form/imet/v1/evaluation.ImportanceClimateChange.module_info_Rating');
        $this->ratingLegend = trans('form/imet/v1/evaluation.ImportanceClimateChange.ratingLegend');


        parent::__construct($attributes);
     
    }
}