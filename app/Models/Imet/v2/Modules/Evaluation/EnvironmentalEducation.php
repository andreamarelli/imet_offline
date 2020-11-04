<?php

namespace App\Models\Imet\v2\Modules\Evaluation;

use App\Models\Imet\v2\Modules;

class EnvironmentalEducation extends Modules\Component\ImetModule_Eval
{ 
    protected $table = 'imet.eval_actors_relations';

    public function __construct(array $attributes = []) {
    
        $this->module_type = 'TABLE';
        $this->module_code = 'PR12';
        $this->module_title = trans('form/imet/v2/evaluation.EnvironmentalEducation.title');
        $this->module_fields = [
            ['name' => 'Activity',  'type' => 'text-area',   'label' => trans('form/imet/v2/evaluation.EnvironmentalEducation.fields.Activity')],
            ['name' => 'EvaluationScore',  'type' => 'blade-admin.imet.components.rating-0to3WithNA',   'label' => trans('form/imet/v2/evaluation.EnvironmentalEducation.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('form/imet/v2/evaluation.EnvironmentalEducation.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Activity',
            'values' => trans('form/imet/v2/evaluation.EnvironmentalEducation.predefined_values')
        ];

        $this->module_info_EvaluationQuestion = trans('form/imet/v2/evaluation.EnvironmentalEducation.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('form/imet/v2/evaluation.EnvironmentalEducation.module_info_Rating');
        $this->ratingLegend = trans('form/imet/v2/evaluation.EnvironmentalEducation.ratingLegend');

        parent::__construct($attributes);
     
    }
}