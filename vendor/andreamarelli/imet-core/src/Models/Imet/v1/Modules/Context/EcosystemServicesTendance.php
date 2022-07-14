<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;

class EcosystemServicesTendance extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_ecosystem_services_tendance';

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'CTX 7.2';
        $this->module_title = trans('imet-core::v1_context.EcosystemServicesTendance.title');
        $this->module_fields = [
            ['name' => 'Value',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.EcosystemServicesTendance.fields.Value')],
            ['name' => 'Description',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.EcosystemServicesTendance.fields.Description')],
            ['name' => 'DesiredStatus',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.EcosystemServicesTendance.fields.DesiredStatus')],
            ['name' => 'Trend',  'type' => 'rating-Minus3to3',   'label' => trans('imet-core::v1_context.EcosystemServicesTendance.fields.Trend')],
            ['name' => 'Reliability',  'type' => 'dropdown-ImetV1_SpeciesReliability',   'label' => trans('imet-core::v1_context.EcosystemServicesTendance.fields.Reliability')],
            ['name' => 'Notes',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.EcosystemServicesTendance.fields.Notes')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::v1_context.EcosystemServicesTendance.groups.group0'),
            'group1' => trans('imet-core::v1_context.EcosystemServicesTendance.groups.group1'),
            'group2' => trans('imet-core::v1_context.EcosystemServicesTendance.groups.group2'),
            'group3' => trans('imet-core::v1_context.EcosystemServicesTendance.groups.group3'),
            'group4' => trans('imet-core::v1_context.EcosystemServicesTendance.groups.group4'),
            'group5' => trans('imet-core::v1_context.EcosystemServicesTendance.groups.group5'),
            'group6' => trans('imet-core::v1_context.EcosystemServicesTendance.groups.group6'),
            'group7' => trans('imet-core::v1_context.EcosystemServicesTendance.groups.group7'),
            'group8' => trans('imet-core::v1_context.EcosystemServicesTendance.groups.group8'),
            'group9' => trans('imet-core::v1_context.EcosystemServicesTendance.groups.group9'),
        ];

        $this->module_info = trans('imet-core::v1_context.EcosystemServicesTendance.module_info');
        $this->ratingLegend = trans('imet-core::v1_context.EcosystemServicesTendance.ratingLegend');

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
            'table' => 'EcosystemServicesTendance',
            'fields' => [
                'Value', 'Description', 'DesiredStatus', 'Trend', 'Reliability', 'Notes', 'Group'
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
