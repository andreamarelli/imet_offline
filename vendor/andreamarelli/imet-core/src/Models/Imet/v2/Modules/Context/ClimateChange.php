<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ModularForms\Models\Traits\Payload;
use Illuminate\Http\Request;

class ClimateChange extends Modules\Component\ImetModule
{
    protected $table = 'context_climate_change_changements';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    protected static $DEPENDENCIES = [
        [Modules\Evaluation\ImportanceClimateChange::class, 'Value'],
        [Modules\Evaluation\InformationAvailability::class, 'Value'],
        [Modules\Evaluation\KeyConservationTrend::class, 'Value'],
        [Modules\Evaluation\ManagementActivities::class, 'Value'],
        [Modules\Evaluation\ClimateChangeMonitoring::class, 'Value']
    ];

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'CTX 6.1';
        $this->module_title = trans('imet-core::v2_context.ClimateChange.title');
        $this->module_fields = [
            ['name' => 'Value',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.ClimateChange.fields.Value')],
            ['name' => 'Description',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.ClimateChange.fields.Description')],
            ['name' => 'Trend',  'type' => 'rating-0to3',   'label' => trans('imet-core::v2_context.ClimateChange.fields.Trend')],
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

}
