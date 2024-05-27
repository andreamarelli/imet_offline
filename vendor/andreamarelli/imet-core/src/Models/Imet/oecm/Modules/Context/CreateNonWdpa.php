<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;


class CreateNonWdpa extends Modules\Component\ImetModule
{
    protected $table = 'imet_form';
    protected $primaryKey = 'FormID';

    public static $rules = [
        'Year' => 'required',
        'wdpa_id' => 'required',
        'language' => 'required'
    ];

    public function __construct(array $attributes = []) {

        $this->module_type = 'SIMPLE';
        $this->module_title = trans('imet-core::oecm_context.CreateNonWdpa.title');
        $this->module_fields = [
            ['name' => 'version',       'type' => 'blade-imet-core::oecm.context.fields.version', 'label' => trans('imet-core::oecm_context.CreateNonWdpa.fields.version')],
            ['name' => 'Year',          'type' => 'yearMaxCurrent',                             'label' => trans('imet-core::oecm_context.CreateNonWdpa.fields.Year')],
            ['name' => 'language',      'type' => 'toggle-ImetOECM_languages',                    'label' => trans('imet-core::oecm_context.CreateNonWdpa.fields.language')],
            ['name' => 'pa_def',        'type' => 'dropdown-ImetV2_NonWdpaPaDef',               'label' => trans('imet-core::oecm_context.CreateNonWdpa.fields.pa_def')],
            ['name' => 'country',       'type' => 'dropdown-ImetV2_Country',                           'label' => trans('imet-core::oecm_context.CreateNonWdpa.fields.country')],
            ['name' => 'name',          'type' => 'text-area',                                  'label' => trans('imet-core::oecm_context.CreateNonWdpa.fields.name')],
            ['name' => 'origin_name',   'type' => 'text-area',                                  'label' => trans('imet-core::oecm_context.CreateNonWdpa.fields.origin_name')],
            ['name' => 'designation',   'type' => 'text-area',                                  'label' => trans('imet-core::oecm_context.CreateNonWdpa.fields.designation')],
            ['name' => 'designation_eng',   'type' => 'blade-imet-core::oecm.context.fields.designation_eng', 'label' => trans('imet-core::oecm_context.CreateNonWdpa.fields.designation_eng')],
            ['name' => 'designation_type',  'type' => 'toggle-ImetV2_NonWdpaDesignType',        'label' => trans('imet-core::oecm_context.CreateNonWdpa.fields.designation_type')],
            ['name' => 'marine',        'type' => 'dropdown-ImetV2_NonWdpaTypology',            'label' => trans('imet-core::oecm_context.CreateNonWdpa.fields.marine')],
            ['name' => 'rep_m_area',    'type' => 'numeric',                                  'label' => trans('imet-core::oecm_context.CreateNonWdpa.fields.rep_m_area')],
            ['name' => 'rep_area',      'type' => 'numeric',                                  'label' => trans('imet-core::oecm_context.CreateNonWdpa.fields.rep_area')],
            ['name' => 'status',        'type' => 'toggle-ImetV2_NonWdpaStatus',              'label' => trans('imet-core::oecm_context.CreateNonWdpa.fields.status')],
            ['name' => 'ownership_type',  'type' => 'dropdown-ImetV2_OwnershipType',              'label' => trans('imet-core::oecm_context.CreateNonWdpa.fields.ownership_type')],
            ['name' => 'status_year',    'type' => 'year',                                      'label' => trans('imet-core::oecm_context.CreateNonWdpa.fields.status_year')],
        ];

        parent::__construct($attributes);
    }

}
