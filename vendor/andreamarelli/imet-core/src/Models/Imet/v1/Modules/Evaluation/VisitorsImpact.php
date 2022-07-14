<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;

class VisitorsImpact extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_visitors_impact';

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'PR15';
        $this->module_title = trans('imet-core::v1_evaluation.VisitorsImpact.title');
        $this->module_fields = [
            ['name' => 'Impact',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.VisitorsImpact.fields.Impact')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3',   'label' => trans('imet-core::v1_evaluation.VisitorsImpact.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.VisitorsImpact.fields.Comments')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::v1_evaluation.VisitorsImpact.groups.group0'),
            'group1' => trans('imet-core::v1_evaluation.VisitorsImpact.groups.group1'),
        ];

        $this->predefined_values = [
            'field' => 'Impact',
            'values' => [
                'group0' => trans('imet-core::v1_evaluation.VisitorsImpact.predefined_values.group0'),
                'group1' => trans('imet-core::v1_evaluation.VisitorsImpact.predefined_values.group1')
            ]
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v1_evaluation.VisitorsImpact.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v1_evaluation.VisitorsImpact.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v1_evaluation.VisitorsImpact.ratingLegend');

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
            'table' => 'Eval_VisitorsImpact',
            'fields' => [
                'Impact',  'EvaluationScore', 'Comments', 'GroupImpact'
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
        return static::convertGroupLabelToKey($record, 'GroupImpact');
    }
}
