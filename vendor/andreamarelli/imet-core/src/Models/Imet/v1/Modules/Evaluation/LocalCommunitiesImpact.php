<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;

class LocalCommunitiesImpact extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_local_communities_impact';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'E/I4';
        $this->module_title = trans('imet-core::v1_evaluation.LocalCommunitiesImpact.title');
        $this->module_fields = [
            ['name' => 'Impact',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.LocalCommunitiesImpact.fields.Impact')],
            ['name' => 'EvaluationScore',  'type' => 'rating-Minus3to3WithNA',   'label' => trans('imet-core::v1_evaluation.LocalCommunitiesImpact.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.LocalCommunitiesImpact.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Impact',
            'values' => trans('imet-core::v1_evaluation.LocalCommunitiesImpact.predefined_values')
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v1_evaluation.LocalCommunitiesImpact.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v1_evaluation.LocalCommunitiesImpact.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v1_evaluation.LocalCommunitiesImpact.ratingLegend');

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
            'table' => 'Eval_LocalCommunitiesImpact',
            'fields' => [
                'Impact', 'EvaluationScore', 'Comments'
            ]
        ];
    }
}
