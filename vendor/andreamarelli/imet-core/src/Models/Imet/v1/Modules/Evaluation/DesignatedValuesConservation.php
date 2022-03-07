<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;

class DesignatedValuesConservation extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_designated_values_conservation';

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'E/I2';
        $this->module_title = trans('imet-core::v1_evaluation.DesignatedValuesConservation.title');
        $this->module_fields = [
            ['name' => 'Value',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.DesignatedValuesConservation.fields.Value')],
            ['name' => 'EvaluationScore',  'type' => 'rating-Minus3to3WithNA',   'label' => trans('imet-core::v1_evaluation.DesignatedValuesConservation.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.DesignatedValuesConservation.fields.Comments')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::v1_evaluation.DesignatedValuesConservation.groups.group0'),
            'group1' => trans('imet-core::v1_evaluation.DesignatedValuesConservation.groups.group1'),
            'group2' => trans('imet-core::v1_evaluation.DesignatedValuesConservation.groups.group2'),
            'group3' => trans('imet-core::v1_evaluation.DesignatedValuesConservation.groups.group3'),
            'group4' => trans('imet-core::v1_evaluation.DesignatedValuesConservation.groups.group4'),
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v1_evaluation.DesignatedValuesConservation.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v1_evaluation.DesignatedValuesConservation.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v1_evaluation.DesignatedValuesConservation.ratingLegend');

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
            'table' => 'Eval_DesignatedValuesConservation',
            'fields' => [
                'Value', 'EvaluationScore', 'Comments', 'GroupValue'
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
        return static::convertGroupLabelToKey($record, 'GroupValue');
    }
}
