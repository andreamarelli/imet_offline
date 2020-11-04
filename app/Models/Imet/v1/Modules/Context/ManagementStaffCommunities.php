<?php

namespace App\Models\Imet\v1\Modules\Context;

use App\Models\Imet\v1\Modules;

class ManagementStaffCommunities extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_management_staff_communities';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 3.1.3';
        $this->module_title = trans('form/imet/v1/context.ManagementStaffCommunities.title');
        $this->module_fields = [
            ['name' => 'Community',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.ManagementStaffCommunities.fields.Community')],
            ['name' => 'Role1',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.ManagementStaffCommunities.fields.Role1')],
            ['name' => 'StaffNUmberRole1',  'type' => 'integer',   'label' => trans('form/imet/v1/context.ManagementStaffCommunities.fields.StaffNUmberRole1')],
            ['name' => 'Role2',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.ManagementStaffCommunities.fields.Role2')],
            ['name' => 'StaffNUmberRole2',  'type' => 'integer',   'label' => trans('form/imet/v1/context.ManagementStaffCommunities.fields.StaffNUmberRole2')],
            ['name' => 'Role3',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.ManagementStaffCommunities.fields.Role3')],
            ['name' => 'StaffNUmberRole3',  'type' => 'integer',   'label' => trans('form/imet/v1/context.ManagementStaffCommunities.fields.StaffNUmberRole3')],
        ];



        parent::__construct($attributes);

    }
}