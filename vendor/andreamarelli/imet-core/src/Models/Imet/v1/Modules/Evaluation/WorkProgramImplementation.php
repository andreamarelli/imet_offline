<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class WorkProgramImplementation extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_work_program_implementation';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'R1';
        $this->module_title = trans('imet-core::v1_evaluation.WorkProgramImplementation.title');
        $this->module_fields = [
            ['name' => 'Activity',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.WorkProgramImplementation.fields.Activity')],
            ['name' => 'Action',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.WorkProgramImplementation.fields.Action')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3',   'label' => trans('imet-core::v1_evaluation.WorkProgramImplementation.fields.EvaluationScore')],
            ['name' => 'Percentage',  'type' => 'integer',   'label' => trans('imet-core::v1_evaluation.WorkProgramImplementation.fields.Percentage')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.WorkProgramImplementation.fields.Comments')],
        ];

        $this->module_info = trans('imet-core::v1_evaluation.WorkProgramImplementation.module_info');
        $this->module_info_EvaluationQuestion = trans('imet-core::v1_evaluation.WorkProgramImplementation.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v1_evaluation.WorkProgramImplementation.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v1_evaluation.WorkProgramImplementation.ratingLegend');

        $this->max_rows = 5;

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
            'table' => 'Eval_WorkProgramImplementation',
            'fields' => [
                'Activity', 'Action', 'EvaluationScore', 'Percentage', 'Comments'
            ]
        ];
    }
}
