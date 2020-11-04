<?php

namespace App\Models\Imet\v1\Modules\Evaluation;

use App\Models\Imet\v1\Modules;

class BoundaryLevel extends Modules\Component\ImetModule_Eval
{ 
    protected $table = 'imet.eval_boundary_level';
    
    public function __construct(array $attributes = []) {
    
        $this->module_type = 'SIMPLE';
        $this->module_code = 'P3';
        $this->module_title = trans('form/imet/v1/evaluation.BoundaryLevel.title');
        $this->module_fields = [
            ['name' => 'EvaluationScore',  'type' => 'rating-0to4',   'label' => trans('form/imet/v1/evaluation.BoundaryLevel.fields.EvaluationScore')],
            ['name' => 'PercentageLevel',  'type' => 'integer',   'label' => trans('form/imet/v1/evaluation.BoundaryLevel.fields.PercentageLevel')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.BoundaryLevel.fields.Comments')],
        ];

        $this->module_info_EvaluationQuestion = trans('form/imet/v1/evaluation.BoundaryLevel.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('form/imet/v1/evaluation.BoundaryLevel.module_info_Rating');
        $this->ratingLegend = trans('form/imet/v1/evaluation.BoundaryLevel.ratingLegend');
        
        parent::__construct($attributes);
     
    }
}