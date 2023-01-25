<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class HRmanagementSystems extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_hr_management_systems';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'PR3';
        $this->module_title = trans('imet-core::v1_evaluation.HRmanagementSystems.title');
        $this->module_fields = [
            ['name' => 'Conditions',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.HRmanagementSystems.fields.Conditions')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3WithNA',   'label' => trans('imet-core::v1_evaluation.HRmanagementSystems.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.HRmanagementSystems.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Conditions',
            'values' => trans('imet-core::v1_evaluation.HRmanagementSystems.predefined_values')
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v1_evaluation.HRmanagementSystems.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v1_evaluation.HRmanagementSystems.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v1_evaluation.HRmanagementSystems.ratingLegend');

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
            'table' => 'Eval_HRmanagementSystems',
            'fields' => [
                'Conditions', 'EvaluationScore', 'Comments'
            ]
        ];
    }
}
