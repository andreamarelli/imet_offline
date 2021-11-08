<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;

class EcosystemServices extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_ecosystem_services';

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'CTX 7.1';
        $this->module_title = trans('imet-core::v1_context.EcosystemServices.title');
        $this->module_fields = [
            ['name' => 'Element',               'type' => 'text-area',          'label' => trans('imet-core::v1_context.EcosystemServices.fields.Element')],
            ['name' => 'Importance',            'type' => 'rating-0to3',   'label' => trans('imet-core::v1_context.EcosystemServices.fields.Importance')],
            ['name' => 'ImportanceRegional',    'type' => 'rating-0to3',   'label' => trans('imet-core::v1_context.EcosystemServices.fields.ImportanceRegional')],
            ['name' => 'ImportanceGlobal',      'type' => 'rating-0to3',   'label' => trans('imet-core::v1_context.EcosystemServices.fields.ImportanceGlobal')],
            ['name' => 'Observations',          'type' => 'text-area',          'label' => trans('imet-core::v1_context.EcosystemServices.fields.Observations')],
        ];

        $this->predefined_values = [
            'field' => 'Element',
            'values' => [
                'group0' => trans('imet-core::v1_context.EcosystemServices.predefined_values.group0'),
                'group1' => trans('imet-core::v1_context.EcosystemServices.predefined_values.group1'),
                'group2' => trans('imet-core::v1_context.EcosystemServices.predefined_values.group2'),
                'group3' => trans('imet-core::v1_context.EcosystemServices.predefined_values.group3'),
                'group4' => trans('imet-core::v1_context.EcosystemServices.predefined_values.group4'),
                'group5' => trans('imet-core::v1_context.EcosystemServices.predefined_values.group5'),
                'group6' => trans('imet-core::v1_context.EcosystemServices.predefined_values.group6'),
                'group7' => trans('imet-core::v1_context.EcosystemServices.predefined_values.group7'),
                'group8' => trans('imet-core::v1_context.EcosystemServices.predefined_values.group8'),
                'group9' => trans('imet-core::v1_context.EcosystemServices.predefined_values.group9')
            ]
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::v1_context.EcosystemServices.groups.group0'),
            'group1' => trans('imet-core::v1_context.EcosystemServices.groups.group1'),
            'group2' => trans('imet-core::v1_context.EcosystemServices.groups.group2'),
            'group3' => trans('imet-core::v1_context.EcosystemServices.groups.group3'),
            'group4' => trans('imet-core::v1_context.EcosystemServices.groups.group4'),
            'group5' => trans('imet-core::v1_context.EcosystemServices.groups.group5'),
            'group6' => trans('imet-core::v1_context.EcosystemServices.groups.group6'),
            'group7' => trans('imet-core::v1_context.EcosystemServices.groups.group7'),
            'group8' => trans('imet-core::v1_context.EcosystemServices.groups.group8'),
            'group9' => trans('imet-core::v1_context.EcosystemServices.groups.group9'),
        ];


        $this->module_info = trans('imet-core::v1_context.EcosystemServices.module_info');
        $this->ratingLegend = trans('imet-core::v1_context.EcosystemServices.ratingLegend');
        parent::__construct($attributes);

    }
}
