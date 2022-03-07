<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;

class LandCover extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_land_cover';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 4.4';
        $this->module_title = trans('imet-core::v1_context.LandCover.title');
        $this->module_fields = [
            ['name' => 'CoverType',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.LandCover.fields.CoverType')],
            ['name' => 'HistoricalArea',  'type' => 'integer',   'label' => trans('imet-core::v1_context.LandCover.fields.HistoricalArea')],
            ['name' => 'PreviousEstimationArea',  'type' => 'integer',   'label' => trans('imet-core::v1_context.LandCover.fields.PreviousEstimationArea')],
            ['name' => 'CurrentEstimationArea',  'type' => 'integer',   'label' => trans('imet-core::v1_context.LandCover.fields.CurrentEstimationArea')],
            ['name' => 'Trend',  'type' => 'rating-Minus2to2',   'label' => trans('imet-core::v1_context.LandCover.fields.Trend')],
            ['name' => 'Reliability',  'type' => 'dropdown-ImetV1_SpeciesReliability',   'label' => trans('imet-core::v1_context.LandCover.fields.Reliability'), 'class' => 'width100px'],
            ['name' => 'Notes',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.LandCover.fields.Notes')],
        ];

        $this->module_common_fields = [
            ['name' => 'HistoricalAreaData',  'type' => 'date',   'label' => trans('imet-core::v1_context.LandCover.fields.HistoricalAreaData')],
            ['name' => 'PreviousEstimationAreaData',  'type' => 'date',   'label' => trans('imet-core::v1_context.LandCover.fields.PreviousEstimationAreaData')],
        ];

        $this->predefined_values = [
            'field' => 'CoverType',
            'values' => trans('imet-core::v1_context.LandCover.predefined_values')
        ];

        $this->module_info = trans('imet-core::v1_context.LandCover.module_info');
        $this->ratingLegend = trans('imet-core::v1_context.LandCover.ratingLegend');

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
            'table' => 'LandCover',
            'fields' => [
                'CoverType',
                'HistoricalArea',
                'PreviousEstimationArea',
                'CurrentEstimationArea',
                'Trend',
                'Reliability',
                'Notes',
                'HistoricalAreaData',
                'PreviousEstimationAreaData'
            ]
        ];
    }
}
