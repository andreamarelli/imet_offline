<?php

namespace App\Models\Person\Modules;


class RightsSpecific extends _Rights
{
    public static $permissions = [
        'news',
        'catalogue',
        'protected_area',
        'concession',
        'transformation_plant',
        'institution',
        'projects',
        'experts',
        'trainings',
        'gisrepository'
    ];

    public function __construct(array $attributes = [])
    {
        $this->module_type = 'TABLE';
        $this->module_title = trans('form/rights.specific_authorizations');
        $this->module_fields = [
            [
                'name' => 'scope',
                'type' => 'text',
                'label' => trans('form/rights.scope'),
            ],
            [
                'name' => 'access',
                'type' => '',
                'label' => trans('form/rights.access'),
            ],

        ];
        parent::__construct($attributes);
    }

}