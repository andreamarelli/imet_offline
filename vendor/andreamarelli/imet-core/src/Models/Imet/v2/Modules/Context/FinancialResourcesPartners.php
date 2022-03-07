<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;

class FinancialResourcesPartners extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_financial_resources_partners';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 3.2.4';
        $this->module_title = trans('imet-core::v2_context.FinancialResourcesPartners.title');
        $this->module_fields = [
            ['name' => 'Partner',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.FinancialResourcesPartners.fields.Partner')],
            ['name' => 'Funding',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.FinancialResourcesPartners.fields.Funding')],
            ['name' => 'Contribution',  'type' => 'integer',   'label' => trans('imet-core::v2_context.FinancialResourcesPartners.fields.Contribution')],
            ['name' => 'StartDate',  'type' => 'date',   'label' => trans('imet-core::v2_context.FinancialResourcesPartners.fields.StartDate')],
            ['name' => 'EndDate',  'type' => 'date',   'label' => trans('imet-core::v2_context.FinancialResourcesPartners.fields.EndDate')],
            ['name' => 'Observations',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.FinancialResourcesPartners.fields.Observations')],
        ];

        $this->module_info = trans('imet-core::v2_context.FinancialResourcesPartners.module_info');

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
