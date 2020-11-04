<?php

namespace App\Models\Imet\v1\Modules\Context;

use App\Models\Imet\v1\Modules;

class ClimateChange extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_climate_change_changements';

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'CTX 6.2';
        $this->module_title = trans('form/imet/v1/context.ClimateChange.title');
        $this->module_fields = [
            ['name' => 'Value',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.ClimateChange.fields.Value')],
            ['name' => 'Description',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.ClimateChange.fields.Description')],
            ['name' => 'DesiredStatus',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.ClimateChange.fields.DesiredStatus')],
            ['name' => 'Trend',  'type' => 'rating-Minus3to3',   'label' => trans('form/imet/v1/context.ClimateChange.fields.Trend')],
            ['name' => 'Notes',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.ClimateChange.fields.Notes')],
        ];

        $this->module_groups = [
            'group0' => trans('form/imet/v1/context.ClimateChange.groups.group0'),
            'group1' => trans('form/imet/v1/context.ClimateChange.groups.group1'),
            'group2' => trans('form/imet/v1/context.ClimateChange.groups.group2'),
            'group3' => trans('form/imet/v1/context.ClimateChange.groups.group3'),
            'group4' => trans('form/imet/v1/context.ClimateChange.groups.group4'),
            'group5' => trans('form/imet/v1/context.ClimateChange.groups.group5')
        ];

        $this->module_info = trans('form/imet/v1/context.ClimateChange.module_info');
        $this->ratingLegend = trans('form/imet/v1/context.ClimateChange.ratingLegend');


        parent::__construct($attributes);

    }
}