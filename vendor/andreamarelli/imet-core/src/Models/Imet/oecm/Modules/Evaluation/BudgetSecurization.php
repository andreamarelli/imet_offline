<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class BudgetSecurization extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_budget_securization';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = []) {

        $this->module_type = 'SIMPLE';
        $this->module_code = 'I4';
        $this->module_title = trans('imet-core::oecm_evaluation.BudgetSecurization.title');
        $this->module_fields = [
            ['name' => 'Percentage',        'type' => 'rating-0to5',   'label' => trans('imet-core::oecm_evaluation.BudgetSecurization.fields.Percentage')],
            ['name' => 'EvaluationScore',   'type' => 'rating-0to3',   'label' => trans('imet-core::oecm_evaluation.BudgetSecurization.fields.EvaluationScore')],
            ['name' => 'Comments',          'type' => 'text-area',   'label' => trans('imet-core::oecm_evaluation.BudgetSecurization.fields.Comments')],
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.BudgetSecurization.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::oecm_evaluation.BudgetSecurization.module_info_Rating');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.BudgetSecurization.ratingLegend');

        parent::__construct($attributes);
    }

}
