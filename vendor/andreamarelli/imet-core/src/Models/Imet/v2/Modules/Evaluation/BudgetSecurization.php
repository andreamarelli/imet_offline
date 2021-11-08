<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;

class BudgetSecurization extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_budget_securization';

    public function __construct(array $attributes = []) {

        $this->module_type = 'SIMPLE';
        $this->module_code = 'I4';
        $this->module_title = trans('imet-core::v2_evaluation.BudgetSecurization.title');
        $this->module_fields = [
            ['name' => 'Percentage',        'type' => 'imet-core::rating-0to5',   'label' => trans('imet-core::v2_evaluation.BudgetSecurization.fields.Percentage')],
            ['name' => 'EvaluationScore',   'type' => 'imet-core::rating-0to3',   'label' => trans('imet-core::v2_evaluation.BudgetSecurization.fields.EvaluationScore')],
            ['name' => 'Comments',          'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.BudgetSecurization.fields.Comments')],
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.BudgetSecurization.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.BudgetSecurization.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.BudgetSecurization.ratingLegend');

        parent::__construct($attributes);
    }

//    public static function convert_v1_to_v2($record)
//    {
//        $record['EvaluationScore'] = null;
//        $record['Percentage'] = null;
//        return $record;
//    }
}
