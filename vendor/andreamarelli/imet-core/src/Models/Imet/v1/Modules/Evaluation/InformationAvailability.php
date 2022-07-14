<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;

class InformationAvailability extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_information_availability';

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'I1';
        $this->module_title = trans('imet-core::v1_evaluation.InformationAvailability.title');
        $this->module_fields = [
            ['name' => 'Element',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.InformationAvailability.fields.Element')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3',   'label' => trans('imet-core::v1_evaluation.InformationAvailability.fields.EvaluationScore')],
            ['name' => 'PercentageLevel',  'type' => 'integer',   'label' => trans('imet-core::v1_evaluation.InformationAvailability.fields.PercentageLevel')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.InformationAvailability.fields.Comments')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::v1_evaluation.InformationAvailability.groups.group0'),
            'group1' => trans('imet-core::v1_evaluation.InformationAvailability.groups.group1'),
            'group2' => trans('imet-core::v1_evaluation.InformationAvailability.groups.group2'),
            'group3' => trans('imet-core::v1_evaluation.InformationAvailability.groups.group3'),
            'group4' => trans('imet-core::v1_evaluation.InformationAvailability.groups.group4'),
            'group5' => trans('imet-core::v1_evaluation.InformationAvailability.groups.group5'),
            'group6' => trans('imet-core::v1_evaluation.InformationAvailability.groups.group6'),
            'group7' => trans('imet-core::v1_evaluation.InformationAvailability.groups.group7'),
            'group8' => trans('imet-core::v1_evaluation.InformationAvailability.groups.group8'),
            'group9' => trans('imet-core::v1_evaluation.InformationAvailability.groups.group9'),
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v1_evaluation.InformationAvailability.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v1_evaluation.InformationAvailability.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v1_evaluation.InformationAvailability.ratingLegend');

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
            'table' => 'Eval_InformationAvailability',
            'fields' => [
                'Element',  'EvaluationScore', 'PercentageLevel', 'Comments', 'GroupElement'
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
        return static::convertGroupLabelToKey($record, 'GroupElement');
    }
}
