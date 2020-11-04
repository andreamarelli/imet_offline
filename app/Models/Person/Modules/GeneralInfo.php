<?php

namespace App\Models\Person\Modules;

use App\Models\Components\EntityModel;
use App\Models\Components\Module;


class GeneralInfo extends Module
{

    protected $table = 'persons';

    public static $rules = [
        'first_name' => 'required',
        'last_name' => 'required',
    ];

    public function __construct(array $attributes = [])
    {
        $this->module_type = 'SIMPLE';
        $this->module_title = trans('entities.staff.general_info');
        $this->module_fields =[
            ['name' => 'first_name',    'type' => 'text',   'label' => trans('entities.common.first_name')],
            ['name' => 'last_name',     'type' => 'text',   'label' => trans('entities.common.last_name')],
            ['name' => 'organisation',  'type' => 'text',   'label' => trans('entities.staff.institution')],
            ['name' => 'function',      'type' => 'text',   'label' => trans('entities.staff.function')]
        ];

        parent::__construct($attributes);
    }
}