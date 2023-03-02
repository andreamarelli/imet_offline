<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context;

use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;

class ManagementStaff extends Modules\Component\ImetModule
{
    protected $table = 'imet_oecm.context_management_staff';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 3.1.3';
        $this->module_title = trans('imet-core::oecm_context.ManagementStaff.title');
        $this->module_fields = [
            ['name' => 'Function',  'type' => 'text-area',   'label' => trans('imet-core::oecm_context.ManagementStaff.fields.Function')],
            ['name' => 'Number',  'type' => 'integer',   'label' => trans('imet-core::oecm_context.ManagementStaff.fields.Number')],
            ['name' => 'Male',  'type' => 'text-area',   'label' => trans('imet-core::oecm_context.ManagementStaff.fields.Male')],
            ['name' => 'Female',  'type' => 'text-area',   'label' => trans('imet-core::oecm_context.ManagementStaff.fields.Female')],
            ['name' => 'Descriptions',  'type' => 'text-area',   'label' => trans('imet-core::oecm_context.ManagementStaff.fields.Descriptions')],
            ['name' => 'AdequateNumber',  'type' => 'integer',   'label' => trans('imet-core::oecm_context.ManagementStaff.fields.AdequateNumber')]
        ];


        $this->module_info = trans('imet-core::oecm_context.ManagementStaff.module_info');

        parent::__construct($attributes);
    }

    public static function calculateWeights($form_id){
        $records = static::getModuleRecords($form_id)['records'];
        $records = collect($records)->map(function($item){
            $item['__weight'] = round(sqrt($item['Number']), 2);
            return $item;
        })->pluck('__weight', 'Function')->toArray();

        return $records;
    }
}
