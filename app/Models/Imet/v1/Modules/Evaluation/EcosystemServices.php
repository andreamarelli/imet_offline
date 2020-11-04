<?php

namespace App\Models\Imet\v1\Modules\Evaluation;

use App\Models\Imet\v1\Modules;

class EcosystemServices extends Modules\Component\ImetModule_Eval
{ 
    protected $table = 'imet.eval_ecosystem_services';
    
    public function __construct(array $attributes = []) {
    
        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'PR19';
        $this->module_title = trans('form/imet/v1/evaluation.EcosystemServices.title');
        $this->module_fields = [
            ['name' => 'Intervention',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.EcosystemServices.fields.Intervention')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3WithNA',   'label' => trans('form/imet/v1/evaluation.EcosystemServices.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.EcosystemServices.fields.Comments')],
        ];

        $this->module_groups = [
            'group0' => trans('form/imet/v1/evaluation.EcosystemServices.groups.group0'),
            'group1' => trans('form/imet/v1/evaluation.EcosystemServices.groups.group1'),
            'group2' => trans('form/imet/v1/evaluation.EcosystemServices.groups.group2'),
            'group3' => trans('form/imet/v1/evaluation.EcosystemServices.groups.group3'),
            'group4' => trans('form/imet/v1/evaluation.EcosystemServices.groups.group4'),
            'group5' => trans('form/imet/v1/evaluation.EcosystemServices.groups.group5'),
            'group6' => trans('form/imet/v1/evaluation.EcosystemServices.groups.group6'),
            'group7' => trans('form/imet/v1/evaluation.EcosystemServices.groups.group7'),
            'group8' => trans('form/imet/v1/evaluation.EcosystemServices.groups.group8'),
            'group9' => trans('form/imet/v1/evaluation.EcosystemServices.groups.group9'),
        ];

        $this->module_info_EvaluationQuestion = trans('form/imet/v1/evaluation.EcosystemServices.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('form/imet/v1/evaluation.EcosystemServices.module_info_Rating');
        $this->ratingLegend = trans('form/imet/v1/evaluation.EcosystemServices.ratingLegend');

        parent::__construct($attributes);
     
    }
}