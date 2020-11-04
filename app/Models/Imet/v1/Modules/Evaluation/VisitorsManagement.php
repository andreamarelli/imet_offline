<?php

namespace App\Models\Imet\v1\Modules\Evaluation;

use App\Models\Imet\v1\Modules;

class VisitorsManagement extends Modules\Component\ImetModule_Eval
{ 
    protected $table = 'imet.eval_visitors_management';
    
    public function __construct(array $attributes = []) {
    
        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'PR14';
        $this->module_title = trans('form/imet/v1/evaluation.VisitorsManagement.title');
        $this->module_fields = [
            ['name' => 'Aspect',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.VisitorsManagement.fields.Aspect')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3WithNA',   'label' => trans('form/imet/v1/evaluation.VisitorsManagement.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.VisitorsManagement.fields.Comments')],
        ];

        $this->module_groups = [
            'group0' => trans('form/imet/v1/evaluation.VisitorsManagement.groups.group0'),
            'group1' => trans('form/imet/v1/evaluation.VisitorsManagement.groups.group1'),
        ];

        $this->predefined_values = [
            'field' => 'Aspect',
            'values' => [
                'group0' => trans('form/imet/v1/evaluation.VisitorsManagement.predefined_values.group0'),
                'group1' => trans('form/imet/v1/evaluation.VisitorsManagement.predefined_values.group1')
            ]
        ];

        $this->module_info_EvaluationQuestion = trans('form/imet/v1/evaluation.VisitorsManagement.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('form/imet/v1/evaluation.VisitorsManagement.module_info_Rating');
        $this->ratingLegend = trans('form/imet/v1/evaluation.VisitorsManagement.ratingLegend');
        
        parent::__construct($attributes);
     
    }
}