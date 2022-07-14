<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;

class BudgetAdequacy extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_budget_adequacy';

    public function __construct(array $attributes = []) {

        $this->module_type = 'SIMPLE';
        $this->module_code = 'I3';
        $this->module_title = trans('imet-core::v2_evaluation.BudgetAdequacy.title');
        $this->module_fields = [
            ['name' => 'EvaluationScore',  'type' => 'imet-core::rating-0to5',   'label' => trans('imet-core::v2_evaluation.BudgetAdequacy.fields.EvaluationScore')],
            ['name' => 'Percentage',  'type' => 'integer',   'label' => trans('imet-core::v2_evaluation.BudgetAdequacy.fields.Percentage')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.BudgetAdequacy.fields.Comments')],
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.BudgetAdequacy.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.BudgetAdequacy.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.BudgetAdequacy.ratingLegend');

        parent::__construct($attributes);

    }

}
