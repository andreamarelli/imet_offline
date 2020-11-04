<?php

namespace App\Models\ProtectedArea\Modules;

use App\Models\Components\Module;


class GeneralInfo extends Module
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
            ['name' => 'name',                      'type' => 'text',                           'label' => trans('form/protected_area.general_info.fields.name')],
            ['name' => 'short_name',                'type' => 'text',                           'label' => trans('form/protected_area.general_info.fields.short_name')],
            ['name' => 'Country',                   'type' => 'dropdown-countryOFAC',           'label' => trans('form/protected_area.general_info.fields.Country')],
            ['name' => 'creation_date',             'type' => 'date',                           'label' => trans('form/protected_area.general_info.fields.creation_date')],
            ['name' => 'classification_date',       'type' => 'date',                           'label' => trans('form/protected_area.general_info.fields.classification_date')],
            ['name' => 'classification_document',   'type' => 'text-area',                      'label' => trans('form/protected_area.general_info.fields.classification_document')],
            ['name' => 'designation',          'type' => 'dropdown-PA_designation',   'label' => trans('form/protected_area.designation')],
            ['name' => 'manager',                   'type' => 'text',                           'label' => trans('form/protected_area.general_info.fields.manager')],
            ['name' => 'management_document',       'type' => 'text-area',                      'label' => trans('form/protected_area.general_info.fields.management_document')],
            ['name' => 'iucn_category',             'type' => 'dropdown-PA_iucn_categories',    'label' => trans('form/protected_area.iucn_category')],
            ['name' => 'activities',                'type' => 'text-area',                      'label' => trans('form/protected_area.general_info.fields.activities')],
            ['name' => 'key_species',               'type' => 'text',                           'label' => trans('form/protected_area.general_info.fields.key_species')],
            ['name' => 'vegetation_types',          'type' => 'text',                           'label' => trans('form/protected_area.general_info.fields.vegetation_types')],
            ['name' => 'shp_source',                'type' => 'text',                           'label' => trans('form/protected_area.general_info.fields.shp_source')],
            ['name' => 'comments',                  'type' => 'text-area',                      'label' => trans('form/protected_area.general_info.fields.comments')],
            ['name' => 'complex_pa_code',           'type' => 'text',                           'label' => trans('form/protected_area.general_info.fields.complex_pa_code')],
            ['name' => 'official_area',             'type' => 'integer',                         'label' => trans('form/protected_area.general_info.fields.official_area')],
            ['name' => 'calculated_area',           'type' => 'integer',                         'label' => trans('form/protected_area.general_info.fields.calculated_area')],
            ['name' => 'validated',                 'type' => 'toggle-yes_no',     'label' => trans('form/protected_area.general_info.fields.validated')],
            ['name' => 'imet_1610',                 'type' => 'text',                           'label' => trans('form/protected_area.general_info.fields.imet_1610')],


            ['name' => 'Status',                    'type' => 'dropdown-PA_status',             'label' => trans('form/protected_area.status')],
        ];

        parent::__construct($attributes);
    }

}