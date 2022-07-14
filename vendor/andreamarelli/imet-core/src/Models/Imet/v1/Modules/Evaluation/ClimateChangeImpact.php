<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;

class ClimateChangeImpact extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_climate_change_impact';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'E/I5';
        $this->module_title = trans('imet-core::v1_evaluation.ClimateChangeImpact.title');
        $this->module_fields = [
            ['name' => 'Impact',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.ClimateChangeImpact.fields.Impact')],
            ['name' => 'EvaluationScore',  'type' => 'rating-Minus3to3WithNA',   'label' => trans('imet-core::v1_evaluation.ClimateChangeImpact.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.ClimateChangeImpact.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Impact',
            'values' => trans('imet-core::v1_evaluation.ClimateChangeImpact.predefined_values')
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v1_evaluation.ClimateChangeImpact.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v1_evaluation.ClimateChangeImpact.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v1_evaluation.ClimateChangeImpact.ratingLegend');

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
            'table' => 'Eval_ClimateChangeImpact',
            'fields' => [
                'Impact', 'EvaluationScore', 'Comments'
            ]
        ];
    }
}
