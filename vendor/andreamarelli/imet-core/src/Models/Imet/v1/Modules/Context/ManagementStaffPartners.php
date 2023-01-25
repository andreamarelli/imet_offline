<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class ManagementStaffPartners extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_management_staff_partners';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 3.1.2';
        $this->module_title = trans('imet-core::v1_context.ManagementStaffPartners.title');
        $this->module_fields = [
            ['name' => 'Partner',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.ManagementStaffPartners.fields.Partner')],
            ['name' => 'Coordinators',  'type' => 'integer',   'label' => trans('imet-core::v1_context.ManagementStaffPartners.fields.Coordinators')],
            ['name' => 'Technicians',  'type' => 'integer',   'label' => trans('imet-core::v1_context.ManagementStaffPartners.fields.Technicians')],
            ['name' => 'Auxiliaries',  'type' => 'integer',   'label' => trans('imet-core::v1_context.ManagementStaffPartners.fields.Auxiliaries')],
        ];

        parent::__construct($attributes);
    }

    /**
     * Set parameter required to convert OLD SQLite IMETs
     *
     * @return array
     */
    protected static function conversionParameters(): array
    {
        return [
            'table' => 'ManagementStaffPartners',
            'fields' => [
                'Partner', 'Coordinators', 'Technicians', 'Auxiliaries'
            ]
        ];
    }
}
