<?php

namespace App\Models\Imet\v1\Modules\Context;

use App\Models\Imet\v1\Modules;

class LandCover extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_land_cover';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 4.4';
        $this->module_title = trans('form/imet/v1/context.LandCover.title');
        $this->module_fields = [
            ['name' => 'CoverType',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.LandCover.fields.CoverType')],
            ['name' => 'HistoricalArea',  'type' => 'integer',   'label' => trans('form/imet/v1/context.LandCover.fields.HistoricalArea')],
            ['name' => 'PreviousEstimationArea',  'type' => 'integer',   'label' => trans('form/imet/v1/context.LandCover.fields.PreviousEstimationArea')],
            ['name' => 'CurrentEstimationArea',  'type' => 'integer',   'label' => trans('form/imet/v1/context.LandCover.fields.CurrentEstimationArea')],
            ['name' => 'Trend',  'type' => 'rating-Minus2to2',   'label' => trans('form/imet/v1/context.LandCover.fields.Trend')],
            ['name' => 'Reliability',  'type' => 'dropdown-ImetV1_SpeciesReliability',   'label' => trans('form/imet/v1/context.LandCover.fields.Reliability'), 'class' => 'width100px'],
            ['name' => 'Notes',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.LandCover.fields.Notes')],
        ];

        $this->module_common_fields = [
            ['name' => 'HistoricalAreaData',  'type' => 'date',   'label' => trans('form/imet/v1/context.LandCover.fields.HistoricalAreaData')],
            ['name' => 'PreviousEstimationAreaData',  'type' => 'date',   'label' => trans('form/imet/v1/context.LandCover.fields.PreviousEstimationAreaData')],
        ];

        $this->predefined_values = [
            'field' => 'CoverType',
            'values' => trans('form/imet/v1/context.LandCover.predefined_values')
        ];

        $this->module_info = trans('form/imet/v1/context.LandCover.module_info');
        $this->ratingLegend = trans('form/imet/v1/context.LandCover.ratingLegend');

        parent::__construct($attributes);

    }
}