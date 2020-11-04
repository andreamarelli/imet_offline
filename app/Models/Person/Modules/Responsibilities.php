<?php

namespace App\Models\Person\Modules;

use App\Models\Components\EntityModel;
use App\Models\Components\Module;
use App\Models\Person\Person;


class Responsibilities extends Module
{

    protected $table = 'responsible';
    public static $foreign_key = 'person_id';

    public function __construct(array $attributes = [])
    {
        $this->module_type = 'TABLE';
        $this->module_title = trans('entities.staff.responsibilities');
        $this->module_fields = [
            [
                'name' => 'domain',
                'type' => 'dropdown-responsibilities_domain',
                'label' => trans('entities.common.level'),
                'other' => 'v-on:change="refresh(index, \'domain\')"'
            ],
            [
                'name' => 'country',
                'type' => 'dropdown-countryOFACwithALL',
                'label' => trans('entities.common.domain'),
                'other' => 'v-on:change="refresh(index, \'country\')" v-bind:disabled="disableToggle(index, \'country\')"'
            ],
            [
                'name' => 'site',
                'type' => 'blade-admin.person.fields.site',
                'other' => 'v-on:change="refresh(index, \'site\')" v-bind:disabled="disableToggle(index, \'site\')"'
            ],
            [
                'name' => 'role',
                'type' => 'dropdown-responsibilities_role',
                'label' => trans('entities.common.role'),
                'other' => 'v-bind:disabled="disableToggle(index, \'role\')"'
            ],
        ];

        parent::__construct($attributes);
    }

    /**
     * Relation to Person
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}