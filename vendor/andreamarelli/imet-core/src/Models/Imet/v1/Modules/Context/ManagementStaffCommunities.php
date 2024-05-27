<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class ManagementStaffCommunities extends Modules\Component\ImetModule
{
    protected $table = 'context_management_staff_communities';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 3.1.3';
        $this->module_title = trans('imet-core::v1_context.ManagementStaffCommunities.title');
        $this->module_fields = [
            ['name' => 'Community',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.ManagementStaffCommunities.fields.Community')],
            ['name' => 'Role1',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.ManagementStaffCommunities.fields.Role1')],
            ['name' => 'StaffNUmberRole1',  'type' => 'integer',   'label' => trans('imet-core::v1_context.ManagementStaffCommunities.fields.StaffNUmberRole1')],
            ['name' => 'Role2',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.ManagementStaffCommunities.fields.Role2')],
            ['name' => 'StaffNUmberRole2',  'type' => 'integer',   'label' => trans('imet-core::v1_context.ManagementStaffCommunities.fields.StaffNUmberRole2')],
            ['name' => 'Role3',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.ManagementStaffCommunities.fields.Role3')],
            ['name' => 'StaffNUmberRole3',  'type' => 'integer',   'label' => trans('imet-core::v1_context.ManagementStaffCommunities.fields.StaffNUmberRole3')],
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
            'table' => 'ManagementStaffCommunities',
            'fields' => [
                'Community', 'Role1',  'StaffNUmberRole1', 'Role2',  'StaffNUmberRole2', 'Role3',  'StaffNUmberRole3'
            ]
        ];
    }
}
