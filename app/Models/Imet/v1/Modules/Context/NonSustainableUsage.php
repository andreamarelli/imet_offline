<?php

namespace App\Models\Imet\v1\Modules\Context;

use App\Models\Imet\v1\Modules;

class NonSustainableUsage extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_non_sustainable_usage';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 4.5';
        $this->module_title = trans('form/imet/v1/context.NonSustainableUsage.title');
        $this->module_fields = [
            ['name' => 'HabitatParameter',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.NonSustainableUsage.fields.HabitatParameter')],
            ['name' => 'HistoricalArea',  'type' => 'integer',   'label' => trans('form/imet/v1/context.NonSustainableUsage.fields.HistoricalArea')],
            ['name' => 'PreviousEstimationArea',  'type' => 'integer',   'label' => trans('form/imet/v1/context.NonSustainableUsage.fields.PreviousEstimationArea')],
            ['name' => 'CurrentEstimationArea',  'type' => 'integer',   'label' => trans('form/imet/v1/context.NonSustainableUsage.fields.CurrentEstimationArea')],
            ['name' => 'Trend',  'type' => 'rating-Minus2to2',   'label' => trans('form/imet/v1/context.NonSustainableUsage.fields.Trend')],
            ['name' => 'Reliability',  'type' => 'dropdown-ImetV1_SpeciesReliability',   'label' => trans('form/imet/v1/context.NonSustainableUsage.fields.Reliability'), 'class' => 'width100px'],
            ['name' => 'Sectors',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.NonSustainableUsage.fields.Sectors')],
        ];

        $this->module_common_fields = [
            ['name' => 'HistoricalAreaData',  'type' => 'date',   'label' => trans('form/imet/v1/context.NonSustainableUsage.fields.HistoricalAreaData')],
            ['name' => 'PreviousEstimationAreaData',  'type' => 'date',   'label' => trans('form/imet/v1/context.NonSustainableUsage.fields.PreviousEstimationAreaData')],
        ];

        $this->predefined_values = [
            'field' => 'HabitatParameter',
            'values' => trans('form/imet/v1/context.NonSustainableUsage.predefined_values')
        ];

        $this->module_info = trans('form/imet/v1/context.NonSustainableUsage.module_info');
        $this->ratingLegend = trans('form/imet/v1/context.NonSustainableUsage.ratingLegend');

        parent::__construct($attributes);

    }
}