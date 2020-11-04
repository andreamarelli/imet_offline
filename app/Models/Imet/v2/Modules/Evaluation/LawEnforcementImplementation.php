<?php

namespace App\Models\Imet\v2\Modules\Evaluation;

use App\Models\Imet\v2\Modules;

class LawEnforcementImplementation extends Modules\Component\ImetModule_Eval
{ 
    protected $table = 'imet.eval_law_enforcement_implementation';
    
    public function __construct(array $attributes = []) {
    
        $this->module_type = 'TABLE';
        $this->module_code = 'PR8';
        $this->module_title = trans('form/imet/v2/evaluation.LawEnforcementImplementation.title');
        $this->module_fields = [
            ['name' => 'Element',   'type' => 'text-area',          'label' => trans('form/imet/v2/evaluation.LawEnforcementImplementation.fields.Element'), 'other'=>'rows="3"'],
            ['name' => 'Adequacy',  'type' => 'blade-admin.imet.components.rating-0to3WithNA',  'label' => trans('form/imet/v2/evaluation.LawEnforcementImplementation.fields.Adequacy')],
            ['name' => 'Comments',  'type' => 'text-area',               'label' => trans('form/imet/v2/evaluation.LawEnforcementImplementation.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Element',
            'values' => trans('form/imet/v2/evaluation.LawEnforcementImplementation.predefined_values')
        ];

        $this->module_info_EvaluationQuestion = trans('form/imet/v2/evaluation.LawEnforcementImplementation.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('form/imet/v2/evaluation.LawEnforcementImplementation.module_info_Rating');
        $this->ratingLegend = trans('form/imet/v2/evaluation.LawEnforcementImplementation.ratingLegend');

        parent::__construct($attributes);
     
    }
}