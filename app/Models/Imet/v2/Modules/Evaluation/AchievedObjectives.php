<?php

namespace App\Models\Imet\v2\Modules\Evaluation;

use App\Models\Imet\v2\Modules;

class AchievedObjectives extends Modules\Component\ImetModule_Eval
{ 
    protected $table = 'imet.eval_achived_objectives';
    
    public function __construct(array $attributes = []) {
    
        $this->module_type = 'TABLE';
        $this->module_code = 'O/C1';
        $this->module_title = trans('form/imet/v2/evaluation.AchievedObjectives.title');
        $this->module_fields = [
            ['name' => 'Objective',  'type' => 'text-area',   'label' => trans('form/imet/v2/evaluation.AchievedObjectives.fields.Objective')],
            ['name' => 'EvaluationScore',  'type' => 'blade-admin.imet.components.rating-0to3',   'label' => trans('form/imet/v2/evaluation.AchievedObjectives.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('form/imet/v2/evaluation.AchievedObjectives.fields.Comments')],
        ];

        $this->module_info_EvaluationQuestion = trans('form/imet/v2/evaluation.AchievedObjectives.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('form/imet/v2/evaluation.AchievedObjectives.module_info_Rating');
        $this->ratingLegend = trans('form/imet/v2/evaluation.AchievedObjectives.ratingLegend');
        
        parent::__construct($attributes);
    }

    public static function upgradeModule($record, $v1_to_v2 = false, $imet_version = null, $db_version = null)
    {
        // ####  v1 -> v2  ####
        if($v1_to_v2) {
            $record = static::dropField($record, 'Percentage');
        }

        return $record;
    }
}