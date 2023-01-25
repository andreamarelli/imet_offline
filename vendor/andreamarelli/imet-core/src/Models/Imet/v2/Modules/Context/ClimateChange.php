<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ModularForms\Models\Traits\Payload;
use Illuminate\Http\Request;

class ClimateChange extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_climate_change_changements';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'CTX 6.1';
        $this->module_title = trans('imet-core::v2_context.ClimateChange.title');
        $this->module_fields = [
            ['name' => 'Value',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.ClimateChange.fields.Value')],
            ['name' => 'Description',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.ClimateChange.fields.Description')],
            ['name' => 'Trend',  'type' => 'imet-core::rating-0to3',   'label' => trans('imet-core::v2_context.ClimateChange.fields.Trend')],
            ['name' => 'Notes',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.ClimateChange.fields.Notes')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::v2_context.ClimateChange.groups.group0'),
            'group1' => trans('imet-core::v2_context.ClimateChange.groups.group1'),
            'group2' => trans('imet-core::v2_context.ClimateChange.groups.group2'),
            'group3' => trans('imet-core::v2_context.ClimateChange.groups.group3'),
            'group4' => trans('imet-core::v2_context.ClimateChange.groups.group4'),
            'group5' => trans('imet-core::v2_context.ClimateChange.groups.group5')
        ];

        $this->module_info = trans('imet-core::v2_context.ClimateChange.module_info');
        $this->ratingLegend = trans('imet-core::v2_context.ClimateChange.ratingLegend');


        parent::__construct($attributes);

    }

    public static function getVueData($form_id, $collection = null): array
    {
        $vue_data = parent::getVueData($form_id, $collection);
        $vue_data['warning_on_save'] =  trans('imet-core::v2_context.ClimateChange.warning_on_save');
        return $vue_data;
    }

    public static function updateModule(Request $request): array
    {
        static::forceLanguage($request->input('form_id'));

        $records = Payload::decode($request->input('records_json'));
        $form_id = $request->input('form_id');

        static::dropFromDependencies($form_id, $records, [
            Modules\Evaluation\ImportanceClimateChange::class,
            Modules\Evaluation\InformationAvailability::class,
            Modules\Evaluation\KeyConservationTrend::class,
            Modules\Evaluation\ManagementActivities::class,
            Modules\Evaluation\ClimateChangeMonitoring::class,
        ]);

        return parent::updateModule($request);
    }
}
