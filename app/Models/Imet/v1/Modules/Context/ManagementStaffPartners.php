<?php

namespace App\Models\Imet\v1\Modules\Context;

use App\Models\Imet\v1\Modules;

class ManagementStaffPartners extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_management_staff_partners';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 3.1.2';
        $this->module_title = trans('form/imet/v1/context.ManagementStaffPartners.title');
        $this->module_fields = [
            ['name' => 'Partner',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.ManagementStaffPartners.fields.Partner')],
            ['name' => 'Coordinators',  'type' => 'integer',   'label' => trans('form/imet/v1/context.ManagementStaffPartners.fields.Coordinators')],
            ['name' => 'Technicians',  'type' => 'integer',   'label' => trans('form/imet/v1/context.ManagementStaffPartners.fields.Technicians')],
            ['name' => 'Auxiliaries',  'type' => 'integer',   'label' => trans('form/imet/v1/context.ManagementStaffPartners.fields.Auxiliaries')],
        ];



        parent::__construct($attributes);

    }
}