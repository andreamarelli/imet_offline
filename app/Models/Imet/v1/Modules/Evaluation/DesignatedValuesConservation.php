<?php

namespace App\Models\Imet\v1\Modules\Evaluation;

use App\Models\Imet\v1\Modules;

class DesignatedValuesConservation extends Modules\Component\ImetModule_Eval
{ 
    protected $table = 'imet.eval_designated_values_conservation';
    
    public function __construct(array $attributes = []) {
    
        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'E/I2';
        $this->module_title = trans('form/imet/v1/evaluation.DesignatedValuesConservation.title');
        $this->module_fields = [
            ['name' => 'Value',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.DesignatedValuesConservation.fields.Value')],
            ['name' => 'EvaluationScore',  'type' => 'rating-Minus3to3WithNA',   'label' => trans('form/imet/v1/evaluation.DesignatedValuesConservation.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.DesignatedValuesConservation.fields.Comments')],
        ];

        $this->module_groups = [
            'group0' => trans('form/imet/v1/evaluation.DesignatedValuesConservation.groups.group0'),
            'group1' => trans('form/imet/v1/evaluation.DesignatedValuesConservation.groups.group1'),
            'group2' => trans('form/imet/v1/evaluation.DesignatedValuesConservation.groups.group2'),
            'group3' => trans('form/imet/v1/evaluation.DesignatedValuesConservation.groups.group3'),
            'group4' => trans('form/imet/v1/evaluation.DesignatedValuesConservation.groups.group4'),
        ];

        $this->module_info_EvaluationQuestion = trans('form/imet/v1/evaluation.DesignatedValuesConservation.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('form/imet/v1/evaluation.DesignatedValuesConservation.module_info_Rating');
        $this->ratingLegend = trans('form/imet/v1/evaluation.DesignatedValuesConservation.ratingLegend');
        
        parent::__construct($attributes);
     
    }
}