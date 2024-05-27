<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class GeneralInfo extends Modules\Component\ImetModule
{
    protected $table = 'context_general_info';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_LOW;

    public static $rules = [
        'Type' => 'required',
        'Country' => 'required',
    ];

    public function __construct(array $attributes = []) {

        $this->module_type = 'SIMPLE';
        $this->module_code = 'CTX 1.1';
        $this->module_title = trans('imet-core::v1_context.GeneralInfo.title');
        $this->module_fields = [
            ['name' => 'CompleteName',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.GeneralInfo.fields.CompleteName')],
            ['name' => 'UsedName',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.GeneralInfo.fields.UsedName')],
            ['name' => 'CompleteNameWDPA',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.GeneralInfo.fields.CompleteNameWDPA')],
            ['name' => 'WDPA',  'type' => 'code',   'label' => trans('imet-core::v1_context.GeneralInfo.fields.WDPA')],
            ['name' => 'Type',  'type' => 'dropdown-ImetV2_PaType',   'label' => trans('imet-core::v2_context.GeneralInfo.fields.Type')],
            ['name' => 'NationalCategory',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.GeneralInfo.fields.NationalCategory')],
            ['name' => 'IUCNCategory1',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.GeneralInfo.fields.IUCNCategory1')],
            ['name' => 'IUCNCategory2',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.GeneralInfo.fields.IUCNCategory2')],
            ['name' => 'IUCNCategory3',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.GeneralInfo.fields.IUCNCategory3')],
            ['name' => 'Country',  'type' => 'dropdown-ImetV2_Country',   'label' => trans('imet-core::v1_context.GeneralInfo.fields.Country')],
            ['name' => 'CreationYear',  'type' => 'year',   'label' => trans('imet-core::v1_context.GeneralInfo.fields.CreationYear')],
            ['name' => 'Institution',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.GeneralInfo.fields.Institution')],
            ['name' => 'Biome',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.GeneralInfo.fields.Biome')],
            ['name' => 'Ecoregions',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.GeneralInfo.fields.Ecoregions')],
            ['name' => 'Ecotype',  'type' => 'dropdown_multiple-ImetV1_EcoType',   'label' => trans('imet-core::v1_context.GeneralInfo.fields.Ecotype')],
            ['name' => 'ReferenceText',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.GeneralInfo.fields.ReferenceText')],
            ['name' => 'ReferenceTextDocument',  'type' => 'upload',   'label' => trans('imet-core::v1_context.GeneralInfo.fields.ReferenceTextDocument')],
            ['name' => 'ReferenceTextValues',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.GeneralInfo.fields.ReferenceTextValues')],
        ];

        parent::__construct($attributes);
    }

    /**
     * Set parameter required to convert OLD SQLite IMETs
     *
     * @return array
     */
    protected static function conversionParameters(): array
    {
        return [
            'table' => 'GeneralInfo',
            'fields' => [
                null,
                'UsedName',
                'CompleteNameWDPA',
                'WDPA',
                null,
                'NationalCategory',
                'IUCNCategory1',
                'IUCNCategory2',
                'IUCNCategory3',
                null,
                'CreationYear',
                'Institution',
                'Biome',
                'Ecoregions',
                'Ecotype',
                'ReferenceText',
                'ReferenceTextDocument',
                'ReferenceTextValues'
            ]
        ];
    }
}
