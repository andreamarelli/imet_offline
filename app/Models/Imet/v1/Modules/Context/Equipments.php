<?php

namespace App\Models\Imet\v1\Modules\Context;

use App\Models\Imet\v1\Modules;

class Equipments extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_equipments';
    protected $fixed_rows = true;

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'CTX 3.3';
        $this->module_title = trans('form/imet/v1/context.Equipments.title');
        $this->module_fields = [
            ['name' => 'Resource',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.Equipments.fields.Resource')],
            ['name' => 'AdequacyLevel',  'type' => 'rating-0to3',   'label' => trans('form/imet/v1/context.Equipments.fields.AdequacyLevel')],
        ];

        $this->predefined_values = [
            'field' => 'Resource',
            'values' => [
                'group0' => trans('form/imet/v1/context.Equipments.predefined_values.group0'),
                'group1' => trans('form/imet/v1/context.Equipments.predefined_values.group1'),
                'group2' => trans('form/imet/v1/context.Equipments.predefined_values.group2'),
                'group3' => trans('form/imet/v1/context.Equipments.predefined_values.group3'),
                'group4' => trans('form/imet/v1/context.Equipments.predefined_values.group4'),
                'group5' => trans('form/imet/v1/context.Equipments.predefined_values.group5'),
                'group6' => trans('form/imet/v1/context.Equipments.predefined_values.group6'),
                'group7' => trans('form/imet/v1/context.Equipments.predefined_values.group7'),
                'group8' => trans('form/imet/v1/context.Equipments.predefined_values.group8'),
                'group9' => trans('form/imet/v1/context.Equipments.predefined_values.group9'),
                'group10' =>trans('form/imet/v1/context.Equipments.predefined_values.group10'),
                'group11' =>trans('form/imet/v1/context.Equipments.predefined_values.group11'),
                'group12' =>trans('form/imet/v1/context.Equipments.predefined_values.group12')
            ]
        ];

        $this->module_groups = [
            'group0' => trans('form/imet/v1/context.Equipments.groups.group0'),
            'group1' => trans('form/imet/v1/context.Equipments.groups.group1'),
            'group2' => trans('form/imet/v1/context.Equipments.groups.group2'),
            'group3' => trans('form/imet/v1/context.Equipments.groups.group3'),
            'group4' => trans('form/imet/v1/context.Equipments.groups.group4'),
            'group5' => trans('form/imet/v1/context.Equipments.groups.group5'),
            'group6' => trans('form/imet/v1/context.Equipments.groups.group6'),
            'group7' => trans('form/imet/v1/context.Equipments.groups.group7'),
            'group8' => trans('form/imet/v1/context.Equipments.groups.group8'),
            'group9' => trans('form/imet/v1/context.Equipments.groups.group9'),
            'group10' => trans('form/imet/v1/context.Equipments.groups.group10'),
            'group11' => trans('form/imet/v1/context.Equipments.groups.group11'),
            'group12' => trans('form/imet/v1/context.Equipments.groups.group12'),
        ];

        $this->ratingLegend = trans('form/imet/v1/context.Equipments.ratingLegend');

        parent::__construct($attributes);

    }
}