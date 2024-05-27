<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class ManagementStaffPartners extends Modules\Component\ImetModule
{
    protected $table = 'context_management_staff_partners';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 3.1.2';
        $this->module_title = trans('imet-core::v2_context.ManagementStaffPartners.title');
        $this->module_fields = [
            ['name' => 'Partner',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.ManagementStaffPartners.fields.Partner')],
            ['name' => 'Coordinators',  'type' => 'integer',   'label' => trans('imet-core::v2_context.ManagementStaffPartners.fields.Coordinators')],
            ['name' => 'Technicians',  'type' => 'integer',   'label' => trans('imet-core::v2_context.ManagementStaffPartners.fields.Technicians')],
            ['name' => 'Auxiliaries',  'type' => 'integer',   'label' => trans('imet-core::v2_context.ManagementStaffPartners.fields.Auxiliaries')],
        ];



        parent::__construct($attributes);

    }
}
