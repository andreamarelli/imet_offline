<?php

namespace App\Models\Imet\v1\Modules\Evaluation;

use App\Models\Imet\v1\Modules;

class Menaces extends Modules\Component\ImetModule_Eval
{ 
    protected $table = 'imet.eval_menaces';
    protected $fixed_rows = true;
    
    public function __construct(array $attributes = []) {
    
        $this->module_type = 'TABLE';
        $this->module_code = 'C3';
        $this->module_title = trans('form/imet/v1/evaluation.Menaces.title');
        $this->module_fields = [
            ['name' => 'Aspect',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.Menaces.fields.Aspect')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.Menaces.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Aspect',
            'values' => trans('form/imet/v1/context.MenacesPressions.categories')   // Comes from context->MenacesPressions
        ];

        $this->module_info = trans('form/imet/v1/evaluation.Menaces.module_info');
        $this->module_info_EvaluationQuestion = trans('form/imet/v1/evaluation.Menaces.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('form/imet/v1/evaluation.Menaces.module_info_Rating');
        $this->ratingLegend = trans('form/imet/v1/evaluation.Menaces.ratingLegend');
        
        parent::__construct($attributes);
     
    }
}