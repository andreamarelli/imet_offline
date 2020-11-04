<?php

namespace App\Models\Imet\v1\Modules\Evaluation;

use App\Models\Imet\v1\Modules;

class VisitorsImpact extends Modules\Component\ImetModule_Eval
{ 
    protected $table = 'imet.eval_visitors_impact';
    
    public function __construct(array $attributes = []) {
    
        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'PR15';
        $this->module_title = trans('form/imet/v1/evaluation.VisitorsImpact.title');
        $this->module_fields = [
            ['name' => 'Impact',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.VisitorsImpact.fields.Impact')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3',   'label' => trans('form/imet/v1/evaluation.VisitorsImpact.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.VisitorsImpact.fields.Comments')],
        ];

        $this->module_groups = [
            'group0' => trans('form/imet/v1/evaluation.VisitorsImpact.groups.group0'),
            'group1' => trans('form/imet/v1/evaluation.VisitorsImpact.groups.group1'),
        ];

        $this->predefined_values = [
            'field' => 'Impact',
            'values' => [
                'group0' => trans('form/imet/v1/evaluation.VisitorsImpact.predefined_values.group0'),
                'group1' => trans('form/imet/v1/evaluation.VisitorsImpact.predefined_values.group1')
            ]
        ];

        $this->module_info_EvaluationQuestion = trans('form/imet/v1/evaluation.VisitorsImpact.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('form/imet/v1/evaluation.VisitorsImpact.module_info_Rating');
        $this->ratingLegend = trans('form/imet/v1/evaluation.VisitorsImpact.ratingLegend');
        
        parent::__construct($attributes);
     
    }
}