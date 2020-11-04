<?php

namespace App\Models\Imet\v1\Modules\Context;

use App\Models\Imet\v1\Modules;

class GeneralInfo extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_general_info';

    public static $rules = [
        'Type' => 'required',
        'Country' => 'required',
    ];

    public function __construct(array $attributes = []) {

        $this->module_type = 'SIMPLE';
        $this->module_code = 'CTX 1.1';
        $this->module_title = trans('form/imet/v1/context.GeneralInfo.title');
        $this->module_fields = [
            ['name' => 'CompleteName',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.GeneralInfo.fields.CompleteName')],
            ['name' => 'UsedName',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.GeneralInfo.fields.UsedName')],
            ['name' => 'CompleteNameWDPA',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.GeneralInfo.fields.CompleteNameWDPA')],
            ['name' => 'WDPA',  'type' => 'code',   'label' => trans('form/imet/v1/context.GeneralInfo.fields.WDPA')],
            ['name' => 'Type',  'type' => 'dropdown-ImetV2_PaType',   'label' => trans('form/imet/v2/context.GeneralInfo.fields.Type')],
            ['name' => 'NationalCategory',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.GeneralInfo.fields.NationalCategory')],
            ['name' => 'IUCNCategory1',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.GeneralInfo.fields.IUCNCategory1')],
            ['name' => 'IUCNCategory2',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.GeneralInfo.fields.IUCNCategory2')],
            ['name' => 'IUCNCategory3',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.GeneralInfo.fields.IUCNCategory3')],
            ['name' => 'Country',  'type' => 'dropdown-Country',   'label' => trans('form/imet/v1/context.GeneralInfo.fields.Country')],
            ['name' => 'CreationYear',  'type' => 'year',   'label' => trans('form/imet/v1/context.GeneralInfo.fields.CreationYear')],
            ['name' => 'Institution',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.GeneralInfo.fields.Institution')],
            ['name' => 'Biome',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.GeneralInfo.fields.Biome')],
            ['name' => 'Ecoregions',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.GeneralInfo.fields.Ecoregions')],
            ['name' => 'Ecotype',  'type' => 'dropdown_multiple-ImetV1_EcoType',   'label' => trans('form/imet/v1/context.GeneralInfo.fields.Ecotype')],
            ['name' => 'ReferenceText',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.GeneralInfo.fields.ReferenceText')],
            ['name' => 'ReferenceTextDocument',  'type' => 'upload',   'label' => trans('form/imet/v1/context.GeneralInfo.fields.ReferenceTextDocument')],
            ['name' => 'ReferenceTextValues',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.GeneralInfo.fields.ReferenceTextValues')],
        ];



        parent::__construct($attributes);

    }
}