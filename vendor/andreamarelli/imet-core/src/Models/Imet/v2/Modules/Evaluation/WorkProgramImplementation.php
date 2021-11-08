<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;

class WorkProgramImplementation extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_work_program_implementation';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'O/P1';
        $this->module_title = trans('imet-core::v2_evaluation.WorkProgramImplementation.title');
        $this->module_fields = [
            ['name' => 'Category',            'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.WorkProgramImplementation.fields.Category')],
            ['name' => 'Activity',          'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.WorkProgramImplementation.fields.Activity')],
            ['name' => 'TargetedActivity',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.WorkProgramImplementation.fields.TargetedActivity')],
            ['name' => 'EvaluationScore',   'type' => 'imet-core::rating-0to3',   'label' => trans('imet-core::v2_evaluation.WorkProgramImplementation.fields.EvaluationScore')],
            ['name' => 'Comments',          'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.WorkProgramImplementation.fields.Comments')],
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.WorkProgramImplementation.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.WorkProgramImplementation.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.WorkProgramImplementation.ratingLegend');

        parent::__construct($attributes);
    }

//    public static function convert_v1_to_v2($record)
//    {
//        $record['Category'] = $record['Activity'] ?? null;
//        $record['Activity'] = $record['Action'] ?? null;
//        $record = static::dropField($record, 'Action');
//        $record = static::dropField($record, 'Percentage');
//        return $record;
//    }

}
