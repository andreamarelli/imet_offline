<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class ManagementStaff extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_management_staff';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 3.1.1';
        $this->module_title = trans('imet-core::v2_context.ManagementStaff.title');
        $this->module_fields = [
            ['name' => 'Function',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.ManagementStaff.fields.Function')],
            ['name' => 'ExpectedPermanent',  'type' => 'integer',   'label' => trans('imet-core::v2_context.ManagementStaff.fields.ExpectedPermanent')],
            ['name' => 'ActualPermanent',  'type' => 'integer',   'label' => trans('imet-core::v2_context.ManagementStaff.fields.ActualPermanent')],
            ['name' => 'Observations',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.ManagementStaff.fields.Observations')],
        ];

        $this->module_common_fields = [
            ['name' => 'Source',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.ManagementStaff.fields.Source')],
        ];

        $this->max_rows = 14;

        $this->module_info = trans('imet-core::v2_context.ManagementStaff.module_info');

        parent::__construct($attributes);

    }
}
