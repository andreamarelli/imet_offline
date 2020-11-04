<?php

namespace App\Models\Imet\v2\Modules\Evaluation;

use App\Models\Imet\v2\Modules;

class WorkProgramImplementation extends Modules\Component\ImetModule_Eval
{ 
    protected $table = 'imet.eval_work_program_implementation';
    
    public function __construct(array $attributes = []) {
    
        $this->module_type = 'TABLE';
        $this->module_code = 'O/P1';
        $this->module_title = trans('form/imet/v2/evaluation.WorkProgramImplementation.title');
        $this->module_fields = [
            ['name' => 'Category',            'type' => 'text-area',   'label' => trans('form/imet/v2/evaluation.WorkProgramImplementation.fields.Category')],
            ['name' => 'Activity',          'type' => 'text-area',   'label' => trans('form/imet/v2/evaluation.WorkProgramImplementation.fields.Activity')],
            ['name' => 'TargetedActivity',  'type' => 'text-area',   'label' => trans('form/imet/v2/evaluation.WorkProgramImplementation.fields.TargetedActivity')],
            ['name' => 'EvaluationScore',   'type' => 'blade-admin.imet.components.rating-0to3',   'label' => trans('form/imet/v2/evaluation.WorkProgramImplementation.fields.EvaluationScore')],
            ['name' => 'Comments',          'type' => 'text-area',   'label' => trans('form/imet/v2/evaluation.WorkProgramImplementation.fields.Comments')],
        ];

        $this->module_info_EvaluationQuestion = trans('form/imet/v2/evaluation.WorkProgramImplementation.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('form/imet/v2/evaluation.WorkProgramImplementation.module_info_Rating');
        $this->ratingLegend = trans('form/imet/v2/evaluation.WorkProgramImplementation.ratingLegend');

        parent::__construct($attributes);
    }

    public static function upgradeModule($record, $v1_to_v2 = false, $imet_version = null, $db_version = null)
    {
        // ####  v1 -> v2  ####
        if($v1_to_v2) {
            $record['Category'] = $record['Activity'] ?? null;
            $record['Activity'] = $record['Action'] ?? null;
            $record = static::dropField($record, 'Action');
            $record = static::dropField($record, 'Percentage');
        }

        return $record;
    }
}