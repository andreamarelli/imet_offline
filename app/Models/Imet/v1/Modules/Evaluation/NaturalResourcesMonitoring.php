<?php

namespace App\Models\Imet\v1\Modules\Evaluation;

use App\Models\Imet\v1\Modules;

class NaturalResourcesMonitoring extends Modules\Component\ImetModule_Eval
{ 
    protected $table = 'imet.eval_natural_resources_monitoring';
    
    public function __construct(array $attributes = []) {
    
        $this->module_type = 'TABLE';
        $this->module_code = 'PR16';
        $this->module_title = trans('form/imet/v1/evaluation.NaturalResourcesMonitoring.title');
        $this->module_fields = [
            ['name' => 'Aspect',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.NaturalResourcesMonitoring.fields.Aspect')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3WithNA',   'label' => trans('form/imet/v1/evaluation.NaturalResourcesMonitoring.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.NaturalResourcesMonitoring.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Aspect',
            'values' => trans('form/imet/v1/evaluation.NaturalResourcesMonitoring.predefined_values')
        ];

        $this->module_info_EvaluationQuestion = trans('form/imet/v1/evaluation.NaturalResourcesMonitoring.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('form/imet/v1/evaluation.NaturalResourcesMonitoring.module_info_Rating');
        $this->ratingLegend = trans('form/imet/v1/evaluation.NaturalResourcesMonitoring.ratingLegend');

        parent::__construct($attributes);
     
    }
}