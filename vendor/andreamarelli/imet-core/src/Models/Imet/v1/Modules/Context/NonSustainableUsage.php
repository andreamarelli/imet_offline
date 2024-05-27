<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class NonSustainableUsage extends Modules\Component\ImetModule
{
    protected $table = 'context_non_sustainable_usage';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 4.5';
        $this->module_title = trans('imet-core::v1_context.NonSustainableUsage.title');
        $this->module_fields = [
            ['name' => 'HabitatParameter',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.NonSustainableUsage.fields.HabitatParameter')],
            ['name' => 'HistoricalArea',  'type' => 'integer',   'label' => trans('imet-core::v1_context.NonSustainableUsage.fields.HistoricalArea')],
            ['name' => 'PreviousEstimationArea',  'type' => 'integer',   'label' => trans('imet-core::v1_context.NonSustainableUsage.fields.PreviousEstimationArea')],
            ['name' => 'CurrentEstimationArea',  'type' => 'integer',   'label' => trans('imet-core::v1_context.NonSustainableUsage.fields.CurrentEstimationArea')],
            ['name' => 'Trend',  'type' => 'rating-Minus2to2',   'label' => trans('imet-core::v1_context.NonSustainableUsage.fields.Trend')],
            ['name' => 'Reliability',  'type' => 'dropdown-ImetV1_SpeciesReliability',   'label' => trans('imet-core::v1_context.NonSustainableUsage.fields.Reliability'), 'class' => 'width100px'],
            ['name' => 'Sectors',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.NonSustainableUsage.fields.Sectors')],
        ];

        $this->module_common_fields = [
            ['name' => 'HistoricalAreaData',  'type' => 'date',   'label' => trans('imet-core::v1_context.NonSustainableUsage.fields.HistoricalAreaData')],
            ['name' => 'PreviousEstimationAreaData',  'type' => 'date',   'label' => trans('imet-core::v1_context.NonSustainableUsage.fields.PreviousEstimationAreaData')],
        ];

        $this->predefined_values = [
            'field' => 'HabitatParameter',
            'values' => trans('imet-core::v1_context.NonSustainableUsage.predefined_values')
        ];

        $this->module_info = trans('imet-core::v1_context.NonSustainableUsage.module_info');
        $this->ratingLegend = trans('imet-core::v1_context.NonSustainableUsage.ratingLegend');

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
            'table' => 'NonSustainableUsage',
            'fields' => [
                'HabitatParameter',
                'HistoricalArea',
                'PreviousEstimationArea',
                'CurrentEstimationArea',
                'Trend',
                'Reliability',
                'Sectors',
                'HistoricalAreaData',
                'PreviousEstimationAreaData'
            ]
        ];
    }
}
