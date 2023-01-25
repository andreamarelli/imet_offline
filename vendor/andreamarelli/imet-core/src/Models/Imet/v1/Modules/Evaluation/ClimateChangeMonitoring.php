<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class ClimateChangeMonitoring extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_climate_change_monitoring';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'PR18';
        $this->module_title = trans('imet-core::v1_evaluation.ClimateChangeMonitoring.title');
        $this->module_fields = [
            ['name' => 'Program',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.ClimateChangeMonitoring.fields.Program')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3WithNA',   'label' => trans('imet-core::v1_evaluation.ClimateChangeMonitoring.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.ClimateChangeMonitoring.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Program',
            'values' => trans('imet-core::v1_evaluation.ClimateChangeMonitoring.predefined_values')
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v1_evaluation.ClimateChangeMonitoring.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v1_evaluation.ClimateChangeMonitoring.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v1_evaluation.ClimateChangeMonitoring.ratingLegend');

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
            'table' => 'Eval_ClimateChangeMonitoring',
            'fields' => [
                'Program', 'EvaluationScore', 'Comments'
            ]
        ];
    }
}
