<?php

namespace App\Models\Imet\v1\Modules\Context;

use App\Models\Imet\v1\Modules;

class FinancialResourcesPartners extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_financial_resources_partners';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 3.2.4';
        $this->module_title = trans('form/imet/v1/context.FinancialResourcesPartners.title');
        $this->module_fields = [
            ['name' => 'Partner',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.FinancialResourcesPartners.fields.Partner')],
            ['name' => 'Funding',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.FinancialResourcesPartners.fields.Funding')],
            ['name' => 'Contribution',  'type' => 'integer',   'label' => trans('form/imet/v1/context.FinancialResourcesPartners.fields.Contribution')],
            ['name' => 'StartDate',  'type' => 'date',   'label' => trans('form/imet/v1/context.FinancialResourcesPartners.fields.StartDate')],
            ['name' => 'EndDate',  'type' => 'date',   'label' => trans('form/imet/v1/context.FinancialResourcesPartners.fields.EndDate')],
            ['name' => 'Observations',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.FinancialResourcesPartners.fields.Observations')],
        ];

        $this->module_common_fields = [
            ['name' => 'Currency',  'type' => 'dropdown-ImetV1_Currency',   'label' => trans('form/imet/v1/context.FinancialResourcesPartners.fields.Currency')],
        ];

        parent::__construct($attributes);

    }
}