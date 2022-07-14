<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;

class ProtectionActivities extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_protection_activities';

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'PR8';
        $this->module_title = trans('imet-core::v1_evaluation.ProtectionActivities.title');
        $this->module_fields = [
            ['name' => 'Activity',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.ProtectionActivities.fields.Activity')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3WithNA',   'label' => trans('imet-core::v1_evaluation.ProtectionActivities.fields.EvaluationScore')],
            ['name' => 'Percentage',  'type' => 'integer',   'label' => trans('imet-core::v1_evaluation.ProtectionActivities.fields.Percentage')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.ProtectionActivities.fields.Comments')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::v1_evaluation.ProtectionActivities.groups.group0'),
            'group1' => trans('imet-core::v1_evaluation.ProtectionActivities.groups.group1'),
            'group2' => trans('imet-core::v1_evaluation.ProtectionActivities.groups.group2'),
            'group3' => trans('imet-core::v1_evaluation.ProtectionActivities.groups.group3'),
            'group4' => trans('imet-core::v1_evaluation.ProtectionActivities.groups.group4'),
            'group5' => trans('imet-core::v1_evaluation.ProtectionActivities.groups.group5'),
            'group6' => trans('imet-core::v1_evaluation.ProtectionActivities.groups.group6'),
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v1_evaluation.ProtectionActivities.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v1_evaluation.ProtectionActivities.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v1_evaluation.ProtectionActivities.ratingLegend');

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
            'table' => 'Eval_ProtectionActivities',
            'fields' => [
                'Activity', 'EvaluationScore', 'Percentage', 'Comments', 'GroupActivity'
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
        return static::convertGroupLabelToKey($record, 'GroupActivity');
    }
}
