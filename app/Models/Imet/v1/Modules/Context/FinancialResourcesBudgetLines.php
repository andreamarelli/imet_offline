<?php

namespace App\Models\Imet\v1\Modules\Context;

use App\Models\Imet\v1\Modules;

class FinancialResourcesBudgetLines extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_financial_resources_budget_lines';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 3.2.3';
        $this->module_title = trans('form/imet/v1/context.FinancialResourcesBudgetLines.title');
        $this->module_fields = [
            ['name' => 'Line',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.FinancialResourcesBudgetLines.fields.Line')],
            ['name' => 'Amount',  'type' => 'integer',   'label' => trans('form/imet/v1/context.FinancialResourcesBudgetLines.fields.Amount')],
            ['name' => 'BudgetSource',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.FinancialResourcesBudgetLines.fields.BudgetSource')],
        ];

        $this->module_common_fields = [
            ['name' => 'Currency',  'type' => 'dropdown-ImetV1_Currency',   'label' => trans('form/imet/v1/context.FinancialResourcesBudgetLines.fields.Currency')],
        ];

        parent::__construct($attributes);

    }
}