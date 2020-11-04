<?php

namespace App\Models\Person\Modules;

use App\Models\Components\EntityModel;
use App\Models\Components\Module;


class Email extends Module
{

    protected $table = 'persons';

    public static $rules = [
        'email' => 'email|unique:persons',
    ];

    public function __construct(array $attributes = [])
    {
        $this->module_type = 'SIMPLE';
        $this->module_title = trans('entities.common.email');
        $this->module_fields =[
            ['name' => 'email', 'type' => 'email', 'label' => trans('entities.common.email')]
        ];

        parent::__construct($attributes);
    }

}