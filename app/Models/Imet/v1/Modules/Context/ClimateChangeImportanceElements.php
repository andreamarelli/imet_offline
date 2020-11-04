<?php

namespace App\Models\Imet\v1\Modules\Context;

use App\Models\Imet\v1\Modules;

class ClimateChangeImportanceElements extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_climate_change_importance_elements';
    protected $fixed_rows = true;

    public function __construct(array $attributes = []) {

        $this->module_type = 'ACCORDION';
        $this->module_code = 'CTX 6.1';
        $this->module_title = trans('form/imet/v1/context.ClimateChangeImportanceElements.title');
        $this->module_fields = [
            ['name' => 'GroupElement',  'type' => 'text-area',        'label' => trans('form/imet/v1/context.ClimateChangeImportanceElements.fields.GroupElement')],
            ['name' => 'Element',       'type' => 'text-area',   'label' => trans('form/imet/v1/context.ClimateChangeImportanceElements.fields.Element')],
            ['name' => 'Application',   'type' => 'rating-0to3', 'label' => trans('form/imet/v1/context.ClimateChangeImportanceElements.fields.Application')],
            ['name' => 'Observations',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.ClimateChangeImportanceElements.fields.Observations')],
        ];

        $this->predefined_values = [
            'field' => 'GroupElement',
            'values' => trans('form/imet/v1/context.ClimateChangeImportanceElements.predefined_values')
        ];

        $this->module_info = trans('form/imet/v1/context.ClimateChangeImportanceElements.module_info');
        $this->ratingLegend = trans('form/imet/v1/context.ClimateChangeImportanceElements.ratingLegend');

        parent::__construct($attributes);
    }
}