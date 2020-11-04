<?php

namespace App\Models\ProtectedArea\Modules;

use App\Models\Components\Module;


class Wdpa extends Module
{

    protected $table = 'KnowledgeBase.ProtectedAreas_WDPA';
    public static $foreign_key = 'ofac_id';

    public static $rules = [
        'wdpa_id' => 'required',
    ];

    public function __construct(array $attributes = [])
    {
        $this->module_type = 'TABLE';
        $this->module_title =  trans_choice('form/protected_area.wdpa_id', 2);
        $this->module_fields =[
            ['name' => 'wdpa_id',      'type' => 'integer',     'label' => trans_choice('form/protected_area.wdpa_id', 1)],
        ];

        parent::__construct($attributes);
    }

}