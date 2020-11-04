<?php

namespace App\Models\Imet\v1\Modules\Evaluation;

use App\Models\Imet\v1\Modules;

class ClimateChangeMonitoring extends Modules\Component\ImetModule_Eval
{ 
    protected $table = 'imet.eval_climate_change_monitoring';
    
    public function __construct(array $attributes = []) {
    
        $this->module_type = 'TABLE';
        $this->module_code = 'PR18';
        $this->module_title = trans('form/imet/v1/evaluation.ClimateChangeMonitoring.title');
        $this->module_fields = [
            ['name' => 'Program',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.ClimateChangeMonitoring.fields.Program')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3WithNA',   'label' => trans('form/imet/v1/evaluation.ClimateChangeMonitoring.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.ClimateChangeMonitoring.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Program',
            'values' => trans('form/imet/v1/evaluation.ClimateChangeMonitoring.predefined_values')
        ];

        $this->module_info_EvaluationQuestion = trans('form/imet/v1/evaluation.ClimateChangeMonitoring.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('form/imet/v1/evaluation.ClimateChangeMonitoring.module_info_Rating');
        $this->ratingLegend = trans('form/imet/v1/evaluation.ClimateChangeMonitoring.ratingLegend');
        
        parent::__construct($attributes);
     
    }
}