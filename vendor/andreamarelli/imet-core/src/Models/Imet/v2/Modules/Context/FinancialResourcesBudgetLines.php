<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;

class FinancialResourcesBudgetLines extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_financial_resources_budget_lines';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 3.2.3';
        $this->module_title = trans('imet-core::v2_context.FinancialResourcesBudgetLines.title');
        $this->module_fields = [
            ['name' => 'Line',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.FinancialResourcesBudgetLines.fields.Line')],
            ['name' => 'Amount',  'type' => 'integer',   'label' => trans('imet-core::v2_context.FinancialResourcesBudgetLines.fields.Amount')],
            ['name' => 'BudgetSource',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.FinancialResourcesBudgetLines.fields.BudgetSource')],
        ];

        $this->module_info = trans('imet-core::v2_context.FinancialResourcesBudgetLines.module_info');

        $this->module_common_fields = [
            ['name' => 'Currency', 'type' => 'disabled', 'label' => trans('imet-core::v2_context.FinancialResources.fields.Currency')],
        ];

        parent::__construct($attributes);
    }

    /**
     * Override: force Currency from CTX 3.2.1
     *
     * @param null $form_id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public static function getModule($form_id = null)
    {
        return parent::getModule($form_id)
            ->map(
                function ($item) use ($form_id) {
                    $item->Currency = $item->Currency ?? FinancialResources::getCurrency($form_id);
                    return $item;
                }
            );
    }

//    public static function convert_v1_to_v2($record)
//    {
//        $record = static::forceCurrency($record, 'Currency', ['Amount']);
//        return $record;
//    }

    public static function copyCurrencyFromCTX213($data)
    {
        if(!empty($data['FinancialResources'])){
            $currency = $data['FinancialResources'][0]['Currency'];
            if($currency!==null){
                foreach ($data[static::getShortClassName()] as $i=>$record){
                    $data[static::getShortClassName()][$i]['Currency'] = $currency;
                }
            }
        }
        return $data;
    }
}
