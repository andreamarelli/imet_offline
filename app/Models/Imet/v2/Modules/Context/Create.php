<?php

namespace App\Models\Imet\v2\Modules\Context;

use App\Models\Imet\Utils\ProtectedArea;
use App\Models\Imet\v2\Imet;
use App\Models\Imet\v2\Modules;
use Illuminate\Http\Request;

class Create extends Modules\Component\ImetModule
{
    protected $table = 'imet.imet_form';
    protected $primaryKey = 'FormID';

    public static $rules = [
        'Year' => 'required',
        'wdpa_id' => 'required',
        'language' => 'required',
    ];

    public function __construct(array $attributes = []) {

        $this->module_type = 'SIMPLE';
        $this->module_title = trans('form/imet/common.create');
        $this->module_fields = [
            ['name' => 'version',                   'type' => 'blade-admin.imet.v2.context.fields.version',   'label' => trans('common.version')],
            ['name' => 'Year',                      'type' => 'yearMaxCurrent',             'label' => trans('entities.common.year')],
            ['name' => 'wdpa_id',  'type' => 'selector-wdpa',   'label' => trans_choice('entities.protected_area.protected_area', 1)],
            ['name' => 'language',                  'type' => 'toggle-ImetV2_languages',    'label' => trans('entities.common.language')],
        ];

        parent::__construct($attributes);
    }

    public static function updateModule(Request $request)
    {
        $records = json_decode($request->input('records_json'), true);

        $pa = ProtectedArea::getByWdpa($records[0]['wdpa_id']);
        $records[0]['Country'] = $pa->country;
        $records[0]['wdpa_id'] = $pa->wdpa_id;
        $records[0]['name'] = $pa->name;

        $records[0]['version'] = Imet::version;

        $request->merge(['records_json' => json_encode($records)]);
        return parent::updateModule($request);
    }

}
