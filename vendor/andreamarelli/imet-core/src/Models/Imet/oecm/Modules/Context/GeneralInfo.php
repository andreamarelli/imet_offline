<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context;

use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;

class GeneralInfo extends Modules\Component\ImetModule
{
    protected $table = 'imet_oecm.context_general_info';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_LOW;

    public static $rules = [
        'Type' => 'required',
        'Country' => 'required',
    ];

    public function __construct(array $attributes = []) {

        $this->module_type = 'SIMPLE';
        $this->module_code = 'CTX 1.1';
        $this->module_title = trans('imet-core::oecm_context.GeneralInfo.title');
        $this->module_fields = [
            ['name' => 'CompleteName',  'type' => 'text-area',   'label' => trans('imet-core::oecm_context.GeneralInfo.fields.CompleteName')],
            ['name' => 'UsedName',  'type' => 'text-area',   'label' => trans('imet-core::oecm_context.GeneralInfo.fields.UsedName')],
            ['name' => 'CompleteNameWDPA',  'type' => 'text-area',   'label' => trans('imet-core::oecm_context.GeneralInfo.fields.CompleteNameWDPA')],
            ['name' => 'WDPA',  'type' => 'code',   'label' => trans('imet-core::oecm_context.GeneralInfo.fields.WDPA')],
            ['name' => 'Type',  'type' => 'blade-imet-core::oecm.context.fields.ctx11_type',   'label' => trans('imet-core::oecm_context.GeneralInfo.fields.Type')],
            ['name' => 'Country',  'type' => 'dropdown-Imet_Country',   'label' => trans('imet-core::oecm_context.GeneralInfo.fields.Country')],
            ['name' => 'CreationYear',  'type' => 'year',   'label' => trans('imet-core::oecm_context.GeneralInfo.fields.CreationYear')],
            ['name' => 'ReferenceText',  'type' => 'text-area',   'label' => trans('imet-core::oecm_context.GeneralInfo.fields.ReferenceText')],
            ['name' => 'Ownership',  'type' => 'dropdown-ImetV2_OwnershipType',   'label' => trans('imet-core::oecm_context.GeneralInfo.fields.Ownership')],
            ['name' => 'Importance',  'type' => 'text-area',   'label' => trans('imet-core::oecm_context.GeneralInfo.fields.Importance')],
        ];

        $this->module_info = trans('imet-core::oecm_context.GeneralInfo.module_info');

        parent::__construct($attributes);
    }
}
