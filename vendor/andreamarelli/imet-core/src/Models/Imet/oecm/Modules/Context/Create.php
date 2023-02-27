<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context;

use AndreaMarelli\ImetCore\Models\ProtectedArea;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Imet;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ModularForms\Models\Traits\Payload;
use Illuminate\Http\Request;

class Create extends Modules\Component\ImetModule
{
    protected $table = 'imet_oecm.imet_form';
    protected $primaryKey = 'FormID';

    public static $rules = [
        'Year' => 'required',
        'wdpa_id' => 'required',
        'language' => 'required',
    ];

    public function __construct(array $attributes = []) {

        $this->module_type = 'SIMPLE';
        $this->module_title = trans('imet-core::common.Create.title');
        $this->module_fields = [
            ['name' => 'version',   'type' => 'blade-imet-core::oecm.context.fields.version',   'label' => trans('imet-core::common.version')],
            ['name' => 'language',  'type' => 'toggle-ImetV2_languages',                        'label' => trans('imet-core::common.language')],
            ['name' => 'Year',      'type' => 'yearMaxCurrent',                                 'label' => trans('imet-core::common.Create.fields.Year')],
            ['name' => 'wdpa_id',   'type' => 'imet-core::selector-wdpa',                       'label' => trans_choice('imet-core::common.protected_area.protected_area', 1)],
        ];

        parent::__construct($attributes);
    }

    public static function updateModule(Request $request): array
    {
        $records = Payload::decode($request->input('records_json'));

        $pa = ProtectedArea::getByWdpa($records[0]['wdpa_id']);
        $records[0]['Country'] = $pa->country;
        $records[0]['wdpa_id'] = $pa->wdpa_id;
        $records[0]['name'] = $pa->name;

        $records[0]['version'] = Imet::version;

        $request->merge(['records_json' => Payload::encode($records)]);

        return parent::updateModule($request);
    }

}
