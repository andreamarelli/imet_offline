<?php

namespace App\Models\Imet\v2\Modules\Evaluation;

use App\Models\Imet\v2\Modules;

class IntelligenceImplementation extends Modules\Component\ImetModule_Eval
{ 
    protected $table = 'imet.eval_intelligence_implementation';
    
    public function __construct(array $attributes = []) {
    
        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'PR9';
        $this->module_title = trans('form/imet/v2/evaluation.IntelligenceImplementation.title');
        $this->module_fields = [
            ['name' => 'Element',   'type' => 'text-area',          'label' => trans('form/imet/v2/evaluation.IntelligenceImplementation.fields.Element'), 'other'=>'rows="3"'],
            ['name' => 'Adequacy',  'type' => 'blade-admin.imet.components.rating-0to3WithNA',  'label' => trans('form/imet/v2/evaluation.IntelligenceImplementation.fields.Adequacy')],
            ['name' => 'Comments',  'type' => 'text-area',               'label' => trans('form/imet/v2/evaluation.IntelligenceImplementation.fields.Comments')],
        ];

        $this->module_groups = [
            'group0' => trans('form/imet/v2/evaluation.IntelligenceImplementation.groups.group0'),
            'group1' => trans('form/imet/v2/evaluation.IntelligenceImplementation.groups.group1'),
        ];

        $this->predefined_values = [
            'field' => 'Element',
            'values' => [
                'group0' => trans('form/imet/v2/evaluation.IntelligenceImplementation.predefined_values.group0'),
                'group1' => trans('form/imet/v2/evaluation.IntelligenceImplementation.predefined_values.group1')
            ]
        ];

        $this->module_info_EvaluationQuestion = trans('form/imet/v2/evaluation.IntelligenceImplementation.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('form/imet/v2/evaluation.IntelligenceImplementation.module_info_Rating');
        $this->ratingLegend = trans('form/imet/v2/evaluation.IntelligenceImplementation.ratingLegend');

        parent::__construct($attributes);
     
    }
}