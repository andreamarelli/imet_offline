<?php

namespace App\Models\Imet\v1\Modules\Evaluation;

use App\Models\Imet\v1\Modules;

class DesignAdequacy extends Modules\Component\ImetModule_Eval
{ 
    protected $table = 'imet.eval_design_adequacy';
    
    public function __construct(array $attributes = []) {
    
        $this->module_type = 'TABLE';
        $this->module_code = 'P2';
        $this->module_title = trans('form/imet/v1/evaluation.DesignAdequacy.title');
        $this->module_fields = [
            ['name' => 'Values',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.DesignAdequacy.fields.Values')],
            ['name' => 'EvaluationScore',  'type' => 'rating-Minus3to3WithNA',   'label' => trans('form/imet/v1/evaluation.DesignAdequacy.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.DesignAdequacy.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Values',
            'values' => trans('form/imet/v1/evaluation.DesignAdequacy.predefined_values')
        ];

        $this->module_info_EvaluationQuestion = trans('form/imet/v1/evaluation.DesignAdequacy.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('form/imet/v1/evaluation.DesignAdequacy.module_info_Rating');
        $this->ratingLegend = trans('form/imet/v1/evaluation.DesignAdequacy.ratingLegend');

        parent::__construct($attributes);
     
    }
}