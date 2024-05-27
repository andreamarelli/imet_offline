<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context;

use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;

class FinancialResources extends Modules\Component\ImetModule
{
    protected $table = 'context_financial_resources';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = [])
    {
        $this->module_type   = 'SIMPLE';
        $this->module_code   = 'CTX 3.2';
        $this->module_title  = trans('imet-core::oecm_context.FinancialResources.title');
        $this->module_fields = [
            [
                'name' => 'Currency',
                'type' => 'currency-unit-minimal',
                'label' => trans('imet-core::oecm_context.FinancialResources.fields.Currency')
            ],
            [
                'name' => 'TotalAnnualBudgetAvailable',
                'type' => 'currency',
                'label' => trans('imet-core::oecm_context.FinancialResources.fields.TotalAnnualBudgetAvailable')
            ]
        ];

        $this->module_info = trans('imet-core::oecm_context.FinancialResources.module_info');


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
