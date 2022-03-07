<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;

class EcosystemServices extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_ecosystem_services';

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'PR19';
        $this->module_title = trans('imet-core::v1_evaluation.EcosystemServices.title');
        $this->module_fields = [
            ['name' => 'Intervention',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.EcosystemServices.fields.Intervention')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3WithNA',   'label' => trans('imet-core::v1_evaluation.EcosystemServices.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.EcosystemServices.fields.Comments')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::v1_evaluation.EcosystemServices.groups.group0'),
            'group1' => trans('imet-core::v1_evaluation.EcosystemServices.groups.group1'),
            'group2' => trans('imet-core::v1_evaluation.EcosystemServices.groups.group2'),
            'group3' => trans('imet-core::v1_evaluation.EcosystemServices.groups.group3'),
            'group4' => trans('imet-core::v1_evaluation.EcosystemServices.groups.group4'),
            'group5' => trans('imet-core::v1_evaluation.EcosystemServices.groups.group5'),
            'group6' => trans('imet-core::v1_evaluation.EcosystemServices.groups.group6'),
            'group7' => trans('imet-core::v1_evaluation.EcosystemServices.groups.group7'),
            'group8' => trans('imet-core::v1_evaluation.EcosystemServices.groups.group8'),
            'group9' => trans('imet-core::v1_evaluation.EcosystemServices.groups.group9'),
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v1_evaluation.EcosystemServices.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v1_evaluation.EcosystemServices.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v1_evaluation.EcosystemServices.ratingLegend');

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
            'table' => 'Eval_EcosystemServices',
            'fields' => [
                'Intervention', 'EvaluationScore', 'Comments', 'GroupIntervention'
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
        return static::convertGroupLabelToKey($record, 'GroupIntervention');
    }
}
