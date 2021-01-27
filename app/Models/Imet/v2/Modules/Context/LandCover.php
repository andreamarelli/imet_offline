<?php

namespace App\Models\Imet\v2\Modules\Context;

use App\Models\Imet\v2\Modules;
use Illuminate\Http\Request;

class LandCover extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_land_cover';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 4.4';
        $this->module_title = trans('form/imet/v2/context.LandCover.title');
        $this->module_fields = [
            ['name' => 'CoverType',  'type' => 'suggestion-ImetV2_LandCoverUseTake',   'label' => trans('form/imet/v2/context.LandCover.fields.CoverType')],
            ['name' => 'HistoricalArea',  'type' => 'numeric',   'label' => trans('form/imet/v2/context.LandCover.fields.HistoricalArea')],
            ['name' => 'ConservationStatusArea',  'type' => 'numeric',   'label' => trans('form/imet/v2/context.LandCover.fields.ConservationStatusArea')],
            ['name' => 'Notes',  'type' => 'text-area',   'label' => trans('form/imet/v2/context.LandCover.fields.Notes')],
        ];

        $this->module_common_fields = [
            ['name' => 'HistoricalAreaData',  'type' => 'date',   'label' => trans('form/imet/v2/context.LandCover.fields.HistoricalAreaData')],
        ];

        $this->module_info = trans('form/imet/v2/context.LandCover.module_info');

        parent::__construct($attributes);

    }

    public static function getVueData($form_id, $collection = null)
    {
        $vue_data = parent::getVueData($form_id, $collection);
        $vue_data['warning_on_save'] =  trans('form/imet/v2/context.LandCover.warning_on_save');
        return $vue_data;
    }

    public static function upgradeModule($record, $v1_to_v2 = false, $imet_version = null)
    {
        // ####  v1 -> v2  ####
        if($v1_to_v2) {
            $record = static::dropField($record, 'PreviousEstimationArea');
            $record = static::dropField($record, 'CurrentEstimationArea');
            $record = static::dropField($record, 'Trend');
            $record = static::dropField($record, 'Reliability');
            $record = static::dropField($record, 'PreviousEstimationAreaData');
            $record = static::addField($record, 'ConservationStatusArea');
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
