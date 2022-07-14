<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;

class NaturalResourcesMonitoring extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_natural_resources_monitoring';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'PR16';
        $this->module_title = trans('imet-core::v1_evaluation.NaturalResourcesMonitoring.title');
        $this->module_fields = [
            ['name' => 'Aspect',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.NaturalResourcesMonitoring.fields.Aspect')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3WithNA',   'label' => trans('imet-core::v1_evaluation.NaturalResourcesMonitoring.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.NaturalResourcesMonitoring.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Aspect',
            'values' => trans('imet-core::v1_evaluation.NaturalResourcesMonitoring.predefined_values')
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v1_evaluation.NaturalResourcesMonitoring.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v1_evaluation.NaturalResourcesMonitoring.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v1_evaluation.NaturalResourcesMonitoring.ratingLegend');

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
            'table' => 'Eval_NaturalResourcesMonitoring',
            'fields' => [
                'Aspect',  'EvaluationScore', 'Comments'
            ]
        ];
    }
}
