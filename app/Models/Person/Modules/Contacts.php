<?php

namespace App\Models\Person\Modules;

use App\Models\Components\EntityModel;
use App\Models\Components\Module;


class Contacts extends Module
{

    protected $table = 'persons';

    public static $rules = [
        'country' => 'required',
    ];

    public function __construct(array $attributes = [])
    {
        $this->module_type = 'SIMPLE';
        $this->module_title = trans('entities.staff.contacts');
        $this->module_fields = [
            ['name' => 'address',   'type' => 'text',               'label' => trans('entities.common.address')],
            ['name' => 'city',      'type' => 'text',               'label' => trans('entities.common.city')],
            ['name' => 'country',   'type' => 'dropdown-Country',   'label' => trans('entities.common.country')],
            ['name' => 'telephone', 'type' => 'text',                'label' => trans('entities.common.phone')]
        ];

        parent::__construct($attributes);
    }

}