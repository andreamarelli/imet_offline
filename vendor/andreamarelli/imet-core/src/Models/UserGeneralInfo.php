<?php

namespace AndreaMarelli\ImetCore\Models;

use AndreaMarelli\ModularForms\Models\Module;


class UserGeneralInfo extends Module
{

    protected $table = 'persons';

    public static $rules = [
        'first_name' => 'required',
        'last_name' => 'required',
    ];

    public function __construct(array $attributes = [])
    {
        $this->module_type = 'SIMPLE';
        $this->module_title = trans('imet-core::common.staff.general_info');
        $this->module_fields =[
            ['name' => 'first_name',    'type' => 'text',   'label' => trans('imet-core::common.staff.first_name')],
            ['name' => 'last_name',     'type' => 'text',   'label' => trans('imet-core::common.staff.last_name')],
            ['name' => 'organisation',  'type' => 'text',   'label' => trans('imet-core::common.staff.institution')],
            ['name' => 'function',      'type' => 'text',   'label' => trans('imet-core::common.staff.function')]
        ];

        parent::__construct($attributes);
    }
}
