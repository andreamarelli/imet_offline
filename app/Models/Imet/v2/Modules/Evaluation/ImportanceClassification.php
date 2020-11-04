<?php

namespace App\Models\Imet\v2\Modules\Evaluation;

use App\Models\Imet\v2\Modules;

class ImportanceClassification extends Modules\Component\ImetModule_Eval
{ 
    protected $table = 'imet.eval_importance_c12';
    
    public function __construct(array $attributes = []) {
    
        $this->module_type = 'TABLE';
        $this->module_code = 'C1.1';
        $this->module_title = trans('form/imet/v2/evaluation.ImportanceClassification.title');
        $this->module_fields = [
            ['name' => 'Aspect',  'type' => 'text-area',   'label' => trans('form/imet/v2/evaluation.ImportanceClassification.fields.Aspect')],
            ['name' => 'EvaluationScore',  'type' => 'blade-admin.imet.components.rating-0to3',   'label' => trans('form/imet/v2/evaluation.ImportanceClassification.fields.EvaluationScore')],
            ['name' => 'SignificativeClassification',  'type' => 'checkbox-boolean',   'label' => trans('form/imet/v2/evaluation.ImportanceClassification.fields.SignificativeClassification')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('form/imet/v2/evaluation.ImportanceClassification.fields.Comments')],
        ];

        $this->module_subTitle = trans('form/imet/v2/evaluation.ImportanceClassification.module_subTitle');
        $this->module_info_EvaluationQuestion = trans('form/imet/v2/evaluation.ImportanceClassification.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('form/imet/v2/evaluation.ImportanceClassification.module_info_Rating');
        $this->ratingLegend = trans('form/imet/v2/evaluation.ImportanceClassification.ratingLegend');

        parent::__construct($attributes);
     
    }
}