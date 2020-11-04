<?php

namespace App\Models\Imet\v1\Modules\Evaluation;

use App\Models\Imet\v1\Modules;

class Implications extends Modules\Component\ImetModule_Eval
{ 
    protected $table = 'imet.eval_implications';
    
    public function __construct(array $attributes = []) {
    
        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'PR11';
        $this->module_title = trans('form/imet/v1/evaluation.Implications.title');
        $this->module_fields = [
            ['name' => 'Actor',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.Implications.fields.Actor')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3WithNA',   'label' => trans('form/imet/v1/evaluation.Implications.fields.EvaluationScore')],
            ['name' => 'Percentage',  'type' => 'integer',   'label' => trans('form/imet/v1/evaluation.Implications.fields.Percentage')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.Implications.fields.Comments')],
        ];

        $this->module_groups = [
            'group0' => trans('form/imet/v1/evaluation.Implications.groups.group0'),
            'group1' => trans('form/imet/v1/evaluation.Implications.groups.group1'),
            'group2' => trans('form/imet/v1/evaluation.Implications.groups.group2'),
            'group3' => trans('form/imet/v1/evaluation.Implications.groups.group3')
        ];

        $this->predefined_values = [
            'field' => 'Actor',
            'values' => [
                'group0' => trans('form/imet/v1/evaluation.Implications.predefined_values.group0'),
                'group1' => trans('form/imet/v1/evaluation.Implications.predefined_values.group1')
            ]
        ];

        $this->module_info_EvaluationQuestion = trans('form/imet/v1/evaluation.Implications.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('form/imet/v1/evaluation.Implications.module_info_Rating');
        $this->ratingLegend = trans('form/imet/v1/evaluation.Implications.ratingLegend');
        
        parent::__construct($attributes);
     
    }
}