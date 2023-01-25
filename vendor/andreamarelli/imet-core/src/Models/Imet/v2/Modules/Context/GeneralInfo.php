<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context;

use AndreaMarelli\ImetCore\Helpers\Template;
use AndreaMarelli\ImetCore\Models\Imet\v2\Imet;
use AndreaMarelli\ImetCore\Models\ProtectedArea;
use AndreaMarelli\ImetCore\Models\ProtectedAreaNonWdpa;
use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ModularForms\Helpers\Input\SelectionList;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;

class GeneralInfo extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_general_info';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_LOW;

    public static $rules = [
        'Type' => 'required',
        'Country' => 'required',
    ];

    public function __construct(array $attributes = []) {

        $this->module_type = 'SIMPLE';
        $this->module_code = 'CTX 1.1';
        $this->module_title = trans('imet-core::v2_context.GeneralInfo.title');
        $this->module_fields = [
            ['name' => 'CompleteName',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.GeneralInfo.fields.CompleteName')],
            ['name' => 'UsedName',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.GeneralInfo.fields.UsedName')],
            ['name' => 'CompleteNameWDPA',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.GeneralInfo.fields.CompleteNameWDPA')],
            ['name' => 'WDPA',  'type' => 'code',   'label' => trans('imet-core::v2_context.GeneralInfo.fields.WDPA')],
            ['name' => 'Type',  'type' => 'blade-imet-core::v2.context.fields.ctx11_type',   'label' => trans('imet-core::v2_context.GeneralInfo.fields.Type')],
            ['name' => 'NationalCategory',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.GeneralInfo.fields.NationalCategory')],
            ['name' => 'IUCNCategory1',  'type' => 'dropdown-ImetV2_IUCNDesignation',   'label' => trans('imet-core::v2_context.GeneralInfo.fields.IUCNCategory1')],
            ['name' => 'IUCNCategory2',  'type' => 'dropdown-ImetV2_IUCNDesignation',   'label' => trans('imet-core::v2_context.GeneralInfo.fields.IUCNCategory2')],
            ['name' => 'IUCNCategory3',  'type' => 'dropdown-ImetV2_IUCNDesignation',   'label' => trans('imet-core::v2_context.GeneralInfo.fields.IUCNCategory3')],
            ['name' => 'MarineDesignation',  'type' => 'suggestion_multiple-ImetV2_MarineDesignation',
                'label' => Template::module_scope(static::MARINE).trans('imet-core::v2_context.GeneralInfo.fields.MarineDesignation')],
            ['name' => 'Country',  'type' => 'dropdown-ImetV2_Country',   'label' => trans('imet-core::v2_context.GeneralInfo.fields.Country')],
            ['name' => 'CreationYear',  'type' => 'year',   'label' => trans('imet-core::v2_context.GeneralInfo.fields.CreationYear')],
            ['name' => 'Institution',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.GeneralInfo.fields.Institution')],
            ['name' => 'Biome',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.GeneralInfo.fields.Biome')],
            ['name' => 'Ecoregions',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.GeneralInfo.fields.Ecoregions')],
            ['name' => 'Ecotype',  'type' => 'dropdown_multiple-ImetV2_EcoType',   'label' => trans('imet-core::v2_context.GeneralInfo.fields.Ecotype')],
            ['name' => 'ReferenceText',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.GeneralInfo.fields.ReferenceText')],
            ['name' => 'ReferenceTextValues',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.GeneralInfo.fields.ReferenceTextValues')],
        ];

        $this->module_info = trans('imet-core::v2_context.GeneralInfo.module_info');

        parent::__construct($attributes);
    }

    public static function getVueData($form_id, $collection = null): array
    {
        $vue_data = parent::getVueData($form_id, $collection);

        $imet = Imet::find($vue_data['form_id']);
        $pa = Imet::getProtectedArea($imet->wdpa_id);

        $vue_data['records'][0]['CompleteName'] = $vue_data['records'][0]['CompleteName'] ?? $pa->name;
        $vue_data['records'][0]['WDPA'] = $vue_data['records'][0]['WDPA'] ?? (ProtectedAreaNonWdpa::isNonWdpa($pa->wdpa_id) ? null : $pa->wdpa_id);
        $vue_data['records'][0]['Type'] = $vue_data['records'][0]['Type'] ?? $imet->Type;
        $vue_data['records'][0]['IUCNCategory1'] = $vue_data['records'][0]['IUCNCategory1'] ?? $pa->iucn_category;
        $vue_data['records'][0]['Country'] = $vue_data['records'][0]['Country'] ?? $pa->country;
        $vue_data['records'][0]['CreationYear'] = $vue_data['records'][0]['CreationYear'] ??
            ($pa->creation_date!==null ? substr($pa->creation_date, 0, 4) : null);

        return $vue_data;
    }

    public static function upgradeModule($record, $imet_version = null)
    {
        // ####  v2.7 -> v2.8 (marine pas)  ####
        $record = static::replacePredefinedValue($record, 'Type', 'Terrestrial', 'terrestrial');
        $record = static::replacePredefinedValue($record, 'Type', 'Marine', 'marine_and_coastal');
        $record = static::replacePredefinedValue($record, 'Type', 'Mixed', 'marine_and_coastal');
        $record = static::replacePredefinedValue($record, 'Type', 'Terrestre', 'terrestrial');
        $record = static::replacePredefinedValue($record, 'Type', 'Maritime', 'marine_and_coastal');
        $record = static::replacePredefinedValue($record, 'Type', 'Mixte', 'marine_and_coastal');
        $record = static::replacePredefinedValue($record, 'Type', 'Terrestre', 'terrestrial');
        $record = static::replacePredefinedValue($record, 'Type', 'Marinho', 'marine_and_coastal');
        $record = static::replacePredefinedValue($record, 'Type', 'Misturado', 'marine_and_coastal');


        return $record;
    }


}
