<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context;

use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;

class TrendsAndThreats extends Modules\Component\ImetModule
{
    protected $table = 'imet_oecm.context_trends_and_threats';
    protected $fixed_rows = true;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = [])
    {
        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'CTX 6.1';
        $this->module_title = trans('imet-core::oecm_context.TrendsAndThreats.title');
        $this->module_fields = [
            ['name' => 'Element', 'type' => 'text-area', 'label' => trans('imet-core::oecm_context.TrendsAndThreats.fields.Element'), 'other' => 'rows="3"'],
            ['name' => 'Status', 'type' => 'imet-core::rating-0to3', 'label' => trans('imet-core::oecm_context.TrendsAndThreats.fields.Status')],
            ['name' => 'Trend', 'type' => 'suggestion-ImetOECM_Access', 'label' => trans('imet-core::oecm_context.TrendsAndThreats.fields.Trend')],
            ['name' => 'MainThreats', 'type' => 'toggle-yes_no', 'label' => trans('imet-core::oecm_context.TrendsAndThreats.fields.MainThreats')],
            ['name' => 'Effects', 'type' => 'toggle-yes_no', 'label' => trans('imet-core::oecm_context.TrendsAndThreats.fields.Effects')],
            ['name' => 'Comments', 'type' => 'text-area', 'label' => trans('imet-core::oecm_context.TrendsAndThreats.fields.Comments')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::oecm_context.TrendsAndThreats.groups.group0'),
            'group1' => trans('imet-core::oecm_context.TrendsAndThreats.groups.group1'),
            'group2' => trans('imet-core::oecm_context.TrendsAndThreats.groups.group2'),
            'group3' => trans('imet-core::oecm_context.TrendsAndThreats.groups.group3'),
            'group4' => trans('imet-core::oecm_context.TrendsAndThreats.groups.group3'),
        ];

        $this->predefined_values = [
            'field' => 'Element',
            'values' => [
                'group0' => trans('imet-core::oecm_context.TrendsAndThreats.predefined_values.group0'),
                'group1' => trans('imet-core::oecm_context.TrendsAndThreats.predefined_values.group1'),
                'group2' => trans('imet-core::oecm_context.TrendsAndThreats.predefined_values.group2'),
                'group3' => trans('imet-core::oecm_context.TrendsAndThreats.predefined_values.group3'),
                'group4' => trans('imet-core::oecm_context.TrendsAndThreats.predefined_values.group3')
            ]
        ];

        $this->module_info = trans('imet-core::oecm_context.StakeholdersNaturalResources.module_info');
        $this->ratingLegend = trans('imet-core::oecm_context.StakeholdersNaturalResources.ratingLegend');

        parent::__construct($attributes);
    }
}
