<?php

namespace App\Models\Imet\v2\Modules\Context;

use App\Models\Currency;
use App\Models\Imet\v2\Modules;

class FinancialResources extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_financial_resources';

    public function __construct(array $attributes = [])
    {
        $this->module_type   = 'SIMPLE';
        $this->module_code   = 'CTX 3.2.1';
        $this->module_title  = trans('form/imet/v2/context.FinancialResources.title');
        $this->module_fields = [
            [
                'name' => 'Currency',
                'type' => 'currency-unit-minimal',
                'label' => trans('form/imet/v2/context.FinancialResources.fields.Currency')
            ],
            [
                'name' => 'ReferenceYear',
                'type' => 'integer',
                'label' => trans('form/imet/v2/context.FinancialResources.fields.ReferenceYear')
            ],
            [
                'name' => 'ManagementFinancialPlanCosts',
                'type' => 'currency',
                'label' => trans('form/imet/v2/context.FinancialResources.fields.ManagementFinancialPlanCosts')
            ],
            [
                'name' => 'OperationalWorkPlanCosts',
                'type' => 'currency',
                'label' => trans('form/imet/v2/context.FinancialResources.fields.OperationalWorkPlanCosts')
            ],
            [
                'name' => 'TotalBudget',
                'type' => 'currency',
                'label' => trans('form/imet/v2/context.FinancialResources.fields.TotalBudget')
            ],
        ];

        $this->module_info = trans('form/imet/v2/context.FinancialResources.module_info');


        parent::__construct($attributes);
    }

    public static function getCurrency($form_id)
    {
        return static::getModule($form_id)->first()
                ->Currency ?? null;
    }

    public static function upgradeModule($record, $v1_to_v2 = false, $imet_version = null, $db_version = null)
    {
        // ####  v1 -> v2  ####
        if($v1_to_v2) {
            $record = static::forceCurrency($record, 'Currency', ['ManagementFinancialPlanCosts', 'OperationalWorkPlanCosts', 'TotalBudget']);
        }

        return $record;
    }

    public static function getTotalBudget($form_id)
    {
        $records = static::getModuleRecords($form_id)['records'];
        return $records[0]['TotalBudget'];
    }

}
