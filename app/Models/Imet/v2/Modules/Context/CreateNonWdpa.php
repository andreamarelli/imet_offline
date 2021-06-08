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
            ['name' => 'name',          'type' => 'text-area',                                  'label' => trans('form/imet/v2/context.CreateNonWdpa.fields.name')],
            ['name' => 'designation',   'type' => 'text-area',                                  'label' => trans('form/imet/v2/context.CreateNonWdpa.fields.designation')],
            ['name' => 'designation_type',   'type' => 'text-area',                             'label' => trans('form/imet/v2/context.CreateNonWdpa.fields.designation_type')],
            ['name' => 'status',        'type' => 'text-area',                                  'label' => trans('form/imet/v2/context.CreateNonWdpa.fields.status')],
            ['name' => 'country',       'type' => 'dropdown-Country',                           'label' => trans('form/imet/v2/context.CreateNonWdpa.fields.country')],

        ];

        parent::__construct($attributes);
    }

    public static function updateModule(Request $request)
    {
        $records = json_decode($request->input('records_json'), true);

        $records[0]['Country'] = $records[0]['country'];
        $records[0]['version'] = Imet::version;

        unset($records[0]['designation']);
        unset($records[0]['designation_type']);
        unset($records[0]['status']);
        unset($records[0]['country']);

        $request->merge(['records_json' => json_encode($records)]);
        return parent::updateModule($request);
    }

}
