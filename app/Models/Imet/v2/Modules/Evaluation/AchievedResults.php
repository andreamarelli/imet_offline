<?php

namespace App\Models\Imet\v2\Modules\Evaluation;

use App\Models\Imet\v2\Modules;

class AchievedResults extends Modules\Component\ImetModule_Eval
{ 
    protected $table = 'imet.eval_achieved_results';
    
    public function __construct(array $attributes = []) {
    
        $this->module_type = 'TABLE';
        $this->module_code = 'O/P2';
        $this->module_title = trans('form/imet/v2/evaluation.AchievedResults.title');
        $this->module_fields = [
            ['name' => 'Category',          'type' => 'text-area',   'label' => trans('form/imet/v2/evaluation.AchievedResults.fields.Category')],
            ['name' => 'Activity',          'type' => 'text-area',   'label' => trans('form/imet/v2/evaluation.AchievedResults.fields.Activity')],
            ['name' => 'TargetedOutput',    'type' => 'text-area',   'label' => trans('form/imet/v2/evaluation.AchievedResults.fields.TargetedOutput')],
            ['name' => 'EvaluationScore',   'type' => 'blade-admin.imet.components.rating-0to3',   'label' => trans('form/imet/v2/evaluation.AchievedResults.fields.EvaluationScore')],
            ['name' => 'Comments',          'type' => 'text-area',   'label' => trans('form/imet/v2/evaluation.AchievedResults.fields.Comments')],
        ];

        $this->module_info_EvaluationQuestion = trans('form/imet/v2/evaluation.AchievedResults.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('form/imet/v2/evaluation.AchievedResults.module_info_Rating');
        $this->ratingLegend = trans('form/imet/v2/evaluation.AchievedResults.ratingLegend');

        parent::__construct($attributes);
     
    }
}