<?php

namespace App\Models\Imet\v1\Modules\Evaluation;

use App\Models\Imet\v1\Modules;

class ImportanceHabitats extends Modules\Component\ImetModule_Eval
{ 
    protected $table = 'imet.eval_importance_c14';
    
    public function __construct(array $attributes = []) {
    
        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'C1.4';
        $this->module_title = trans('form/imet/v1/evaluation.ImportanceHabitats.title');
        $this->module_fields = [
            ['name' => 'Aspect',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.ImportanceHabitats.fields.Aspect')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3',   'label' => trans('form/imet/v1/evaluation.ImportanceHabitats.fields.EvaluationScore')],
            ['name' => 'EvaluationScore2',  'type' => 'rating-1to3',   'label' => trans('form/imet/v1/evaluation.ImportanceHabitats.fields.EvaluationScore2')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.ImportanceHabitats.fields.Comments')],
        ];

        $this->module_groups = [
            'group0' => trans('form/imet/v1/evaluation.ImportanceHabitats.groups.group0'),
            'group1' => trans('form/imet/v1/evaluation.ImportanceHabitats.groups.group1'),
        ];

        $this->module_subTitle = trans('form/imet/v1/evaluation.ImportanceHabitats.module_subTitle');
        $this->module_info_EvaluationQuestion = trans('form/imet/v1/evaluation.ImportanceHabitats.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('form/imet/v1/evaluation.ImportanceHabitats.module_info_Rating');
        $this->ratingLegend = trans('form/imet/v1/evaluation.ImportanceHabitats.ratingLegend');


        parent::__construct($attributes);
     
    }
}