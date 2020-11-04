<?php

namespace App\Models\Person\Modules;

use App\Models\Components\EntityModel;
use App\Models\Components\Module;


class RoleOFAC extends Module
{

    protected $table = 'persons';

    public function __construct(array $attributes = []) {

        $this->module_type = 'SIMPLE';
        $this->module_title = trans('entities.staff.role_ofac');
        $this->module_fields = [
            ['name' => 'role_ofac', 'type' => 'dropdown-role_ofac', 'label' => trans('entities.staff.role_ofac')]
        ];

        parent::__construct($attributes);
    }

}