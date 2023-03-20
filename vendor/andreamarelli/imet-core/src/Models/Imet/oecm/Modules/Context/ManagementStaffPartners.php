<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context;

use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;

class ManagementStaffPartners extends Modules\Component\ImetModule
{
    protected $table = 'imet_oecm.context_management_staff_partners';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 3.1.4';
        $this->module_title = trans('imet-core::oecm_context.ManagementStaffPartners.title');
        $this->module_fields = [
            ['name' => 'Partner',       'type' => 'text-area',   'label' => trans('imet-core::oecm_context.ManagementStaffPartners.fields.Partner')],
            ['name' => 'Function',      'type' => 'text-area',   'label' => trans('imet-core::oecm_context.ManagementStaffPartners.fields.Function')],
            ['name' => 'Coordinators',  'type' => 'integer',   'label' => trans('imet-core::oecm_context.ManagementStaffPartners.fields.Coordinators')],
            ['name' => 'Technicians',  'type' => 'integer',   'label' => trans('imet-core::oecm_context.ManagementStaffPartners.fields.Technicians')],
            ['name' => 'Auxiliaries',  'type' => 'integer',   'label' => trans('imet-core::oecm_context.ManagementStaffPartners.fields.Auxiliaries')],
        ];

        parent::__construct($attributes);
    }
}
