<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;

class FinancialResourcesBudgetLines extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_financial_resources_budget_lines';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 3.2.3';
        $this->module_title = trans('imet-core::v1_context.FinancialResourcesBudgetLines.title');
        $this->module_fields = [
            ['name' => 'Line',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.FinancialResourcesBudgetLines.fields.Line')],
            ['name' => 'Amount',  'type' => 'integer',   'label' => trans('imet-core::v1_context.FinancialResourcesBudgetLines.fields.Amount')],
            ['name' => 'BudgetSource',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.FinancialResourcesBudgetLines.fields.BudgetSource')],
        ];

        $this->module_common_fields = [
            ['name' => 'Currency',  'type' => 'dropdown-ImetV1_Currency',   'label' => trans('imet-core::v1_context.FinancialResourcesBudgetLines.fields.Currency')],
        ];

        parent::__construct($attributes);
    }

    /**
     * Set parameter required to convert OLD SQLite IMETs
     *
     * @return array
     */
    protected static function conversionParameters(): array
    {
        return [
            'table' => 'FinancialResourcesBudgetLines',
            'fields' => [
                'Line', 'Amount', 'BudgetSource', 'Currency'
            ]
        ];
    }
}
