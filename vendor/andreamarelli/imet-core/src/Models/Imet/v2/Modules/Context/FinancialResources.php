<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class FinancialResources extends Modules\Component\ImetModule
{
    protected $table = 'context_financial_resources';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = [])
    {
        $this->module_type   = 'SIMPLE';
        $this->module_code   = 'CTX 3.2.1';
        $this->module_title  = trans('imet-core::v2_context.FinancialResources.title');
        $this->module_fields = [
            [
                'name' => 'Currency',
                'type' => 'currency-unit-minimal',
                'label' => trans('imet-core::v2_context.FinancialResources.fields.Currency')
            ],
            [
                'name' => 'ReferenceYear',
                'type' => 'integer',
                'label' => trans('imet-core::v2_context.FinancialResources.fields.ReferenceYear')
            ],
            [
                'name' => 'ManagementFinancialPlanCosts',
                'type' => 'currency',
                'label' => trans('imet-core::v2_context.FinancialResources.fields.ManagementFinancialPlanCosts')
            ],
            [
                'name' => 'OperationalWorkPlanCosts',
                'type' => 'currency',
                'label' => trans('imet-core::v2_context.FinancialResources.fields.OperationalWorkPlanCosts')
            ],
            [
                'name' => 'TotalBudget',
                'type' => 'currency',
                'label' => trans('imet-core::v2_context.FinancialResources.fields.TotalBudget')
            ],
        ];

        $this->module_info = trans('imet-core::v2_context.FinancialResources.module_info');


        parent::__construct($attributes);
    }

    public static function getCurrency($form_id)
    {
        return static::getModule($form_id)->first()
                ->Currency ?? null;
    }

    public static function getTotalBudget($form_id)
    {
        $records = static::getModuleRecords($form_id)['records'];
        return $records[0]['TotalBudget'];
    }

}
