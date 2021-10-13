<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;

class FinancialResources extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_financial_resources';

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

//    public static function convert_v1_to_v2($record)
//    {
//        $record = static::forceCurrency($record, 'Currency', ['ManagementFinancialPlanCosts', 'OperationalWorkPlanCosts', 'TotalBudget']);
//        return $record;
//    }

    public static function getTotalBudget($form_id)
    {
        $records = static::getModuleRecords($form_id)['records'];
        return $records[0]['TotalBudget'];
    }

}
