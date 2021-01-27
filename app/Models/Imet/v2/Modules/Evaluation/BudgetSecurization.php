<?php

namespace App\Models\Imet\v2\Modules\Evaluation;

use App\Models\Imet\v2\Modules;

class BudgetSecurization extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_budget_securization';

    public function __construct(array $attributes = []) {

        $this->module_type = 'SIMPLE';
        $this->module_code = 'I4';
        $this->module_title = trans('form/imet/v2/evaluation.BudgetSecurization.title');
        $this->module_fields = [
            ['name' => 'Percentage',        'type' => 'blade-admin.imet.components.rating-0to5',   'label' => trans('form/imet/v2/evaluation.BudgetSecurization.fields.Percentage')],
            ['name' => 'EvaluationScore',   'type' => 'blade-admin.imet.components.rating-0to3',   'label' => trans('form/imet/v2/evaluation.BudgetSecurization.fields.EvaluationScore')],
            ['name' => 'Comments',          'type' => 'text-area',   'label' => trans('form/imet/v2/evaluation.BudgetSecurization.fields.Comments')],
        ];

        $this->module_info_EvaluationQuestion = trans('form/imet/v2/evaluation.BudgetSecurization.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('form/imet/v2/evaluation.BudgetSecurization.module_info_Rating');
        $this->ratingLegend = trans('form/imet/v2/evaluation.BudgetSecurization.ratingLegend');

        parent::__construct($attributes);
    }

    public static function upgradeModule($record, $v1_to_v2 = false, $imet_version = null)
    {
        // ####  v1 -> v2  ####
        if($v1_to_v2) {
            $record['EvaluationScore'] = null;
            $record['Percentage'] = null;
        }

        return $record;
    }
}
