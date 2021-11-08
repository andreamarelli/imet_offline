<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use Illuminate\Http\Request;

class LandCover extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_land_cover';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 4.4';
        $this->module_title = trans('imet-core::v2_context.LandCover.title');
        $this->module_fields = [
            ['name' => 'CoverType',  'type' => 'suggestion-ImetV2_LandCoverUseTake',   'label' => trans('imet-core::v2_context.LandCover.fields.CoverType')],
            ['name' => 'HistoricalArea',  'type' => 'numeric',   'label' => trans('imet-core::v2_context.LandCover.fields.HistoricalArea')],
            ['name' => 'ConservationStatusArea',  'type' => 'numeric',   'label' => trans('imet-core::v2_context.LandCover.fields.ConservationStatusArea')],
            ['name' => 'Notes',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.LandCover.fields.Notes')],
        ];

        $this->module_common_fields = [
            ['name' => 'HistoricalAreaData',  'type' => 'date',   'label' => trans('imet-core::v2_context.LandCover.fields.HistoricalAreaData')],
        ];

        $this->module_info = trans('imet-core::v2_context.LandCover.module_info');

        parent::__construct($attributes);

    }

    public static function getVueData($form_id, $collection = null): array
    {
        $vue_data = parent::getVueData($form_id, $collection);
        $vue_data['warning_on_save'] =  trans('imet-core::v2_context.LandCover.warning_on_save');
        return $vue_data;
    }

//    public static function convert_v1_to_v2($record)
//    {
//        $record = static::dropField($record, 'PreviousEstimationArea');
//        $record = static::dropField($record, 'CurrentEstimationArea');
//        $record = static::dropField($record, 'Trend');
//        $record = static::dropField($record, 'Reliability');
//        $record = static::dropField($record, 'PreviousEstimationAreaData');
//        $record = static::addField($record, 'ConservationStatusArea');
//
//        return $record;
//    }

    public static function updateModule(Request $request): array
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
