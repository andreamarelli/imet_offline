<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;

class FinancialAvailableResources extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_financial_available_resources';
    protected $fixed_rows = true;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 3.2.2';
        $this->module_title = trans('imet-core::v1_context.FinancialAvailableResources.title');
        $this->module_fields = [
            ['name' => 'BudgetType',        'type' => 'text-area',   'label' => trans('imet-core::v1_context.FinancialAvailableResources.fields.BudgetType')],
            ['name' => 'NationalBudget',    'type' => 'integer',   'label' => trans('imet-core::v1_context.FinancialAvailableResources.fields.NationalBudget')],
            ['name' => 'OwnRevenues',       'type' => 'integer',   'label' => trans('imet-core::v1_context.FinancialAvailableResources.fields.OwnRevenues')],
            ['name' => 'Disputes',          'type' => 'integer',   'label' => trans('imet-core::v1_context.FinancialAvailableResources.fields.Disputes')],
            ['name' => 'Partners',          'type' => 'integer',   'label' => trans('imet-core::v1_context.FinancialAvailableResources.fields.Partners')],
        ];

        $this->module_common_fields = [
            ['name' => 'Currency',          'type' => 'dropdown-ImetV1_Currency',   'label' => trans('imet-core::v1_context.FinancialAvailableResources.fields.Currency')],
        ];

        $this->predefined_values = [
            'field' => 'BudgetType',
            'values' => trans('imet-core::v1_context.FinancialAvailableResources.predefined_values')
        ];

        parent::__construct($attributes);

    }
}