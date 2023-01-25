<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class ManagementActivities extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_management_activities';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'PR7';
        $this->module_title = trans('imet-core::v1_evaluation.ManagementActivities.title');
        $this->module_fields = [
            ['name' => 'Activity',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.ManagementActivities.fields.Activity')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3WithNA',   'label' => trans('imet-core::v1_evaluation.ManagementActivities.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.ManagementActivities.fields.Comments')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::v1_evaluation.ManagementActivities.groups.group0'),
            'group1' => trans('imet-core::v1_evaluation.ManagementActivities.groups.group1'),
            'group2' => trans('imet-core::v1_evaluation.ManagementActivities.groups.group2'),
            'group3' => trans('imet-core::v1_evaluation.ManagementActivities.groups.group3'),
            'group4' => trans('imet-core::v1_evaluation.ManagementActivities.groups.group4'),
            'group5' => trans('imet-core::v1_evaluation.ManagementActivities.groups.group5'),
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v1_evaluation.ManagementActivities.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v1_evaluation.ManagementActivities.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v1_evaluation.ManagementActivities.ratingLegend');

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
            'table' => 'Eval_ManagementActivities',
            'fields' => [
                'Activity', 'EvaluationScore', 'Comments', 'GroupActivity'
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
