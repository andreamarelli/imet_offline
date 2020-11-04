<?php

namespace App\Models\Imet\v1\Modules\Evaluation;

use App\Models\Imet\v1\Modules;

class ProtectionActivities extends Modules\Component\ImetModule_Eval
{ 
    protected $table = 'imet.eval_protection_activities';
    
    public function __construct(array $attributes = []) {
    
        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'PR8';
        $this->module_title = trans('form/imet/v1/evaluation.ProtectionActivities.title');
        $this->module_fields = [
            ['name' => 'Activity',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.ProtectionActivities.fields.Activity')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3WithNA',   'label' => trans('form/imet/v1/evaluation.ProtectionActivities.fields.EvaluationScore')],
            ['name' => 'Percentage',  'type' => 'integer',   'label' => trans('form/imet/v1/evaluation.ProtectionActivities.fields.Percentage')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.ProtectionActivities.fields.Comments')],
        ];

        $this->module_groups = [
            'group0' => trans('form/imet/v1/evaluation.ProtectionActivities.groups.group0'),
            'group1' => trans('form/imet/v1/evaluation.ProtectionActivities.groups.group1'),
            'group2' => trans('form/imet/v1/evaluation.ProtectionActivities.groups.group2'),
            'group3' => trans('form/imet/v1/evaluation.ProtectionActivities.groups.group3'),
            'group4' => trans('form/imet/v1/evaluation.ProtectionActivities.groups.group4'),
            'group5' => trans('form/imet/v1/evaluation.ProtectionActivities.groups.group5'),
            'group6' => trans('form/imet/v1/evaluation.ProtectionActivities.groups.group6'),
        ];

        $this->module_info_EvaluationQuestion = trans('form/imet/v1/evaluation.ProtectionActivities.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('form/imet/v1/evaluation.ProtectionActivities.module_info_Rating');
        $this->ratingLegend = trans('form/imet/v1/evaluation.ProtectionActivities.ratingLegend');
        
        parent::__construct($attributes);
     
    }
}