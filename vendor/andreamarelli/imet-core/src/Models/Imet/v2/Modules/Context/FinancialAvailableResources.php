<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;

class FinancialAvailableResources extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_financial_available_resources';
    protected $fixed_rows = true;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 3.2.2';
        $this->module_title = trans('imet-core::v2_context.FinancialAvailableResources.title');
        $this->module_fields = [
            ['name' => 'BudgetType',        'type' => 'disabled',   'label' => trans('imet-core::v2_context.FinancialAvailableResources.fields.BudgetType')],
            ['name' => 'NationalBudget',    'type' => 'integer',   'label' => trans('imet-core::v2_context.FinancialAvailableResources.fields.NationalBudget')],
            ['name' => 'OwnRevenues',       'type' => 'integer',   'label' => trans('imet-core::v2_context.FinancialAvailableResources.fields.OwnRevenues')],
            ['name' => 'Disputes',          'type' => 'integer',   'label' => trans('imet-core::v2_context.FinancialAvailableResources.fields.Disputes')],
            ['name' => 'Partners',          'type' => 'integer',   'label' => trans('imet-core::v2_context.FinancialAvailableResources.fields.Partners')],
        ];

        $this->module_info = trans('imet-core::v2_context.FinancialAvailableResources.module_info');

        $this->predefined_values = [
            'field' => 'BudgetType',
            'values' => trans('imet-core::v2_context.FinancialAvailableResources.predefined_values')
        ];

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
//        $record = static::replacePredefinedValue($record, 'BudgetType', 'Budget total annuel disponible de fonctionnement', 'Budget total annuel disponible pour le fonctionnement');
//        $record = static::replacePredefinedValue($record, 'BudgetType', 'Budget total annuel disponible d\'investissement', 'Budget total annuel disponible pour les investissements');
//        $record = static::forceCurrency($record, 'Currency', ['NationalBudget', 'OwnRevenues', 'Disputes', 'Partners']);
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