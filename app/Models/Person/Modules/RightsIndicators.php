<?php

namespace App\Models\Person\Modules;

use App\Models\UserRight;
use Illuminate\Http\Request;


class RightsIndicators extends _Rights
{
    public static $permissions = [
        'S2',
        'S5'
    ];

    public function __construct(array $attributes = [])
    {
        $this->module_title = trans('form/rights.indicators.title');

        $this->module_type = 'TABLE';
        $this->module_fields = [
            [
                'name' => 'scope',
                'type' => 'dropdown-permissions_indicators',
                'label' => trans('form/rights.scope'),
                'other' => 'v-on:change="refresh(index, \'scope\')"'
            ],
            [
                'name' => 'country',
                'type' => 'dropdown-countryOFACwithALL',
                'label' => trans('entities.common.domain'),
                'other' => 'v-bind:disabled="disableToggle(index, \'country\')" v-on:change="refresh(index, \'country\')"'
            ],
            [
                'name' => 'site',
                'type' => 'blade-admin.person.fields.site',
                'other' => 'v-bind:disabled="disableToggle(index, \'site\')" v-on:change="refresh(index, \'site\')"'
            ],
            [
                'name' => 'encode',
                'type' => 'blade-admin.person.fields.permission_toggle',
                'other' => 'v-bind:disabled="disableToggle(index, \'encode\')" v-bind:checked="hasPermission(index, \'encode\')" v-on:change="givePermission(index, \'encode\')"',
                'label' => trans('form/rights.indicators.fields.encode')
            ],
            [
                'name' => 'modify',
                'type' => 'blade-admin.person.fields.permission_toggle',
                'other' => 'v-bind:disabled="disableToggle(index, \'modify\')" v-bind:checked="hasPermission(index, \'modify\')" v-on:change="givePermission(index, \'modify\')"',
                'label' => trans('form/rights.indicators.fields.modify')
            ],
            [
                'name' => 'validate',
                'type' => 'blade-admin.person.fields.permission_toggle',
                'other' => 'v-bind:disabled="disableToggle(index, \'validate\')" v-bind:checked="hasPermission(index, \'validate\')" v-on:change="givePermission(index, \'validate\')"',
                'label' => trans('form/rights.indicators.fields.validate')
            ],
            [
                'name' => 'delete',
                'type' => 'blade-admin.person.fields.permission_toggle',
                'other' => 'v-bind:disabled="disableToggle(index, \'delete\')" v-bind:checked="hasPermission(index, \'delete\')" v-on:change="givePermission(index, \'delete\')"',
                'label' => trans('form/rights.indicators.fields.delete')
            ]
        ];

        parent::__construct($attributes);
    }

    public static function updateModule(Request $request)
    {
        $records = json_decode($request->input('records_json'), true);
        $form_id = $request->input('form_id', null);
        $records_ids = [];

        foreach($records as $record){
            UserRight::updateIndicator($record); // Todo: use tha same also for create
            $records_ids[] = $record['id'];
        }

        $records_ids_to_delete = static::get_records_to_delete($records_ids, $form_id, ['scope', 'IN', static::$permissions]);

        if(!empty($records_ids_to_delete)){
            UserRight::destroy($records_ids_to_delete);
        }

        return static::successResponse($form_id);
    }

}