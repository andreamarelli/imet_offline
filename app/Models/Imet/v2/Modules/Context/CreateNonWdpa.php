<?php

namespace App\Models\Imet\v2\Modules\Context;

use App\Models\Imet\Utils\ProtectedArea;
use App\Models\Imet\Utils\ProtectedAreaNonWdpa;
use App\Models\Imet\v2\Imet;
use App\Models\Imet\v2\Modules;
use Illuminate\Http\Request;

class CreateNonWdpa extends Modules\Component\ImetModule
{
    protected $table = 'imet.imet_form';
    protected $primaryKey = 'FormID';

    public static $rules = [
        'Year' => 'required',
        'wdpa_id' => 'required',
        'language' => 'required'
    ];

    public function __construct(array $attributes = []) {

        $this->module_type = 'SIMPLE';
        $this->module_title = trans('form/imet/v2/context.CreateNonWdpa.title');
        $this->module_fields = [
            ['name' => 'version',       'type' => 'blade-admin.imet.v2.context.fields.version', 'label' => trans('form/imet/v2/context.CreateNonWdpa.fields.version')],
            ['name' => 'Year',          'type' => 'yearMaxCurrent',                             'label' => trans('form/imet/v2/context.CreateNonWdpa.fields.Year')],
            ['name' => 'language',      'type' => 'toggle-ImetV2_languages',                    'label' => trans('form/imet/v2/context.CreateNonWdpa.fields.language')],
            ['name' => 'pa_def',        'type' => 'dropdown-ImetV2_NonWdpaPaDef',               'label' => trans('form/imet/v2/context.CreateNonWdpa.fields.pa_def')],
            ['name' => 'country',       'type' => 'dropdown-Country',                           'label' => trans('form/imet/v2/context.CreateNonWdpa.fields.country')],
            ['name' => 'name',          'type' => 'text-area',                                  'label' => trans('form/imet/v2/context.CreateNonWdpa.fields.name')],
            ['name' => 'origin_name',   'type' => 'text-area',                                  'label' => trans('form/imet/v2/context.CreateNonWdpa.fields.origin_name')],
            ['name' => 'designation',   'type' => 'text-area',                                  'label' => trans('form/imet/v2/context.CreateNonWdpa.fields.designation')],
            ['name' => 'designation_eng',   'type' => 'blade-admin.imet.v2.context.fields.designation_eng', 'label' => trans('form/imet/v2/context.CreateNonWdpa.fields.designation_eng')],
            ['name' => 'designation_type',  'type' => 'toggle-ImetV2_NonWdpaDesignType',        'label' => trans('form/imet/v2/context.CreateNonWdpa.fields.designation_type')],
            ['name' => 'marine',        'type' => 'dropdown-ImetV2_NonWdpaTypology',            'label' => trans('form/imet/v2/context.CreateNonWdpa.fields.marine')],
            ['name' => 'rep_m_area',    'type' => 'numeric',                                  'label' => trans('form/imet/v2/context.CreateNonWdpa.fields.rep_m_area')],
            ['name' => 'rep_area',      'type' => 'numeric',                                  'label' => trans('form/imet/v2/context.CreateNonWdpa.fields.rep_area')],
            ['name' => 'status',        'type' => 'toggle-ImetV2_NonWdpaStatus',              'label' => trans('form/imet/v2/context.CreateNonWdpa.fields.status')],
            ['name' => 'status_year',    'type' => 'year',                                      'label' => trans('form/imet/v2/context.CreateNonWdpa.fields.status_year')],
        ];

        parent::__construct($attributes);
    }

}
