<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class HRmanagementPolitics extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_hr_management_politics';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'PR2';
        $this->module_title = trans('imet-core::v1_evaluation.HRmanagementPolitics.title');
        $this->module_fields = [
            ['name' => 'Conditions',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.HRmanagementPolitics.fields.Conditions'), 'other'=>'rows="2"'],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3WithNA',   'label' => trans('imet-core::v1_evaluation.HRmanagementPolitics.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.HRmanagementPolitics.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Conditions',
            'values' => trans('imet-core::v1_evaluation.HRmanagementPolitics.predefined_values')
        ];


        $this->module_info_EvaluationQuestion = trans('imet-core::v1_evaluation.HRmanagementPolitics.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v1_evaluation.HRmanagementPolitics.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v1_evaluation.HRmanagementPolitics.ratingLegend');

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
            'table' => 'Eval_HRmanagementPolitics',
            'fields' => [
                'Conditions', 'EvaluationScore', 'Comments'
            ]
        ];
    }
}
