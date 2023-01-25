<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class SpecialStatus extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_special_status';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_LOW;

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_ACCORDION';
        $this->module_code = 'CTX 1.3';
        $this->module_title = trans('imet-core::v2_context.SpecialStatus.title');
        $this->module_fields = [
            ['name' => 'Designation',           'type' => 'suggestion-ImetV2_SpecialDesignation',   'label' => trans('imet-core::v2_context.SpecialStatus.fields.Designation')],
            ['name' => 'RegistrationDate',      'type' => 'dateMaxToday',   'label' => trans('imet-core::v2_context.SpecialStatus.fields.RegistrationDate')],
            ['name' => 'Code',                  'type' => 'text-area',   'label' => trans('imet-core::v2_context.SpecialStatus.fields.Code')],
            ['name' => 'Area',                  'type' => 'numeric',   'label' => trans('imet-core::v2_context.SpecialStatus.fields.Area')],
            ['name' => 'DesignationCriteria',   'type' => 'text-area',   'label' => trans('imet-core::v2_context.SpecialStatus.fields.DesignationCriteria')],
            ['name' => 'upload',                'type' => 'upload',   'label' => trans('imet-core::v2_context.SpecialStatus.fields.upload')],
        ];

        $this->module_groups = [
            'conventions'   => trans('imet-core::v2_context.SpecialStatus.groups.conventions'),
            'networks'      => trans('imet-core::v2_context.SpecialStatus.groups.networks'),
            'conservation'  => trans('imet-core::v2_context.SpecialStatus.groups.conservation'),
            'marine_pa'     => trans('imet-core::v2_context.SpecialStatus.groups.marine_pa'),
        ];

        parent::__construct($attributes);

    }
}
