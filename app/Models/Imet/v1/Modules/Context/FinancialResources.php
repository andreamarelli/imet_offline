<?php

namespace App\Models\Imet\v1\Modules\Context;

use App\Models\Imet\v1\Modules;

class FinancialResources extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_financial_resources';

    public function __construct(array $attributes = []) {

        $this->module_type = 'SIMPLE';
        $this->module_code = 'CTX 3.2.1';
        $this->module_title = trans('form/imet/v1/context.FinancialResources.title');
        $this->module_fields = [
            ['name' => 'Currency',                      'type' => 'dropdown-ImetV1_Currency',   'label' => trans('form/imet/v1/context.FinancialResources.fields.Currency')],
            ['name' => 'ReferenceYear',                 'type' => 'integer',   'label' => trans('form/imet/v1/context.FinancialResources.fields.ReferenceYear')],
            ['name' => 'ManagementFinancialPlanCosts',  'type' => 'currency',   'label' => trans('form/imet/v1/context.FinancialResources.fields.ManagementFinancialPlanCosts')],
            ['name' => 'OperationalWorkPlanCosts',      'type' => 'currency',   'label' => trans('form/imet/v1/context.FinancialResources.fields.OperationalWorkPlanCosts')],
            ['name' => 'TotalBudget',                   'type' => 'currency',   'label' => trans('form/imet/v1/context.FinancialResources.fields.TotalBudget')],
        ];

        $this->module_info = trans('form/imet/v1/context.FinancialResources.module_info');



        parent::__construct($attributes);

    }
}
