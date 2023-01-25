<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class ClimateChange extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_climate_change_changements';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'CTX 6.2';
        $this->module_title = trans('imet-core::v1_context.ClimateChange.title');
        $this->module_fields = [
            ['name' => 'Value',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.ClimateChange.fields.Value')],
            ['name' => 'Description',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.ClimateChange.fields.Description')],
            ['name' => 'DesiredStatus',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.ClimateChange.fields.DesiredStatus')],
            ['name' => 'Trend',  'type' => 'rating-Minus3to3',   'label' => trans('imet-core::v1_context.ClimateChange.fields.Trend')],
            ['name' => 'Notes',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.ClimateChange.fields.Notes')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::v1_context.ClimateChange.groups.group0'),
            'group1' => trans('imet-core::v1_context.ClimateChange.groups.group1'),
            'group2' => trans('imet-core::v1_context.ClimateChange.groups.group2'),
            'group3' => trans('imet-core::v1_context.ClimateChange.groups.group3'),
            'group4' => trans('imet-core::v1_context.ClimateChange.groups.group4'),
            'group5' => trans('imet-core::v1_context.ClimateChange.groups.group5')
        ];

        $this->module_info = trans('imet-core::v1_context.ClimateChange.module_info');
        $this->ratingLegend = trans('imet-core::v1_context.ClimateChange.ratingLegend');


        parent::__construct($attributes);

    }

    /**
     * Set parameter required to convert OLD SQLite IMETs
     *
     * @return array
     */
    protected static function conversionParameters(): array
    {
        return [
            'table' => 'ClimateChangeChangements',
            'fields' => [
                'Value', 'Description', 'DesiredStatus', 'Trend', 'Notes', 'Group'
            ]
        ];
    }

    /**
     * Review data from SQLITE
     *
     * @param $record
     * @param $sqlite_connection
     * @return array
     */
    protected static function conversionDataReview($record, $sqlite_connection): array
    {
        return static::convertGroupLabelToKey($record, 'Group');
    }
}
