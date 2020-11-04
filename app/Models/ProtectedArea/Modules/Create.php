<?php

namespace App\Models\ProtectedArea\Modules;

use App\Models\Components\Module;


class Create extends Module
{

    protected $table = 'KnowledgeBase.ProtectedAreas';

    public static $rules = [
        'name' => 'required',
        'Country' => 'required',
    ];

    public function __construct(array $attributes = [])
    {
        $this->module_type = 'SIMPLE';
        $this->module_title = trans('common.general_info');
        $this->module_fields =[
            ['name' => 'name',      'type' => 'text',   'label' => trans('form/protected_area.general_info.fields.name')],
            ['name' => 'Country',   'type' => 'dropdown-countryOFAC',   'label' => trans('form/protected_area.general_info.fields.Country')],
        ];

        parent::__construct($attributes);
    }

}