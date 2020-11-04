<?php

namespace App\Models\Imet\v2\Modules\Context;

use App\Models\Imet\v2\Modules;
use Illuminate\Http\Request;

class Habitats extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_habitats';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 4.3.1';
        $this->module_title = trans('form/imet/v2/context.Habitats.title');
        $this->module_fields = [
            ['name' => 'EcosystemType',             'type' => 'text-area',   'label' => trans('form/imet/v2/context.Habitats.fields.EcosystemType')],
            ['name' => 'Value',                     'type' => 'text-area',   'label' => trans('form/imet/v2/context.Habitats.fields.Value')],
            ['name' => 'Area',                      'type' => 'numeric',   'label' => trans('form/imet/v2/context.Habitats.fields.Area')],
            ['name' => 'DesiredConservationStatus', 'type' => 'numeric',   'label' => trans('form/imet/v2/context.Habitats.fields.DesiredConservationStatus')],
            ['name' => 'Sectors',                   'type' => 'text-area',   'label' => trans('form/imet/v2/context.Habitats.fields.Sectors')],
            ['name' => 'Comments',                  'type' => 'text-area',   'label' => trans('form/imet/v2/context.Habitats.fields.Comments')],
        ];

        $this->module_info = trans('form/imet/v2/context.Habitats.module_info');

        parent::__construct($attributes);

    }

    public static function getVueData($form_id, $collection = null)
    {
        $vue_data = parent::getVueData($form_id, $collection);
        $vue_data['warning_on_save'] =  trans('form/imet/v2/context.Habitats.warning_on_save');
        return $vue_data;
    }

    public static function upgradeModule($record, $v1_to_v2 = false, $imet_version = null, $db_version = null)
    {
        // ####  v1 -> v2  ####
        if($v1_to_v2) {
            $record = static::dropField($record, 'Trend');
            $record = static::dropField($record, 'Reliability');
            $record = static::addField($record, 'Comments');
        }

        return $record;
    }

    public static function updateModule(Request $request)
    {
        static::forceLanguage($request->input('form_id'));

        $records = json_decode($request->input('records_json'), true);
        $form_id = $request->input('form_id');

        static::dropFromDependencies($form_id, $records, [
            Modules\Evaluation\ImportanceHabitats::class,
            Modules\Evaluation\InformationAvailability::class,
            Modules\Evaluation\KeyConservationTrend::class,
            Modules\Evaluation\ManagementActivities::class,
        ]);

        return parent::updateModule($request);
    }

}