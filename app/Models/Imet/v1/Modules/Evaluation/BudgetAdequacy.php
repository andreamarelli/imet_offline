<?php

namespace App\Models\Imet\v1\Modules\Evaluation;

use App\Models\Imet\v1\Modules;

class BudgetAdequacy extends Modules\Component\ImetModule_Eval
{ 
    protected $table = 'imet.eval_budget_adequacy';
    
    public function __construct(array $attributes = []) {
    
        $this->module_type = 'SIMPLE';
        $this->module_code = 'I3';
        $this->module_title = trans('form/imet/v1/evaluation.BudgetAdequacy.title');
        $this->module_fields = [
            ['name' => 'EvaluationScore',  'type' => 'rating-0to4',   'label' => trans('form/imet/v1/evaluation.BudgetAdequacy.fields.EvaluationScore')],
            ['name' => 'Percentage',  'type' => 'integer',   'label' => trans('form/imet/v1/evaluation.BudgetAdequacy.fields.Percentage')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.BudgetAdequacy.fields.Comments')],
        ];

        $this->module_info_EvaluationQuestion = trans('form/imet/v1/evaluation.BudgetAdequacy.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('form/imet/v1/evaluation.BudgetAdequacy.module_info_Rating');
        $this->ratingLegend = trans('form/imet/v1/evaluation.BudgetAdequacy.ratingLegend');
        
        parent::__construct($attributes);
     
    }
}