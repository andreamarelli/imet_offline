<?php

namespace App\Models\Imet\v1\Modules\Evaluation;

use App\Models\Imet\v1\Modules;

class ImportanceEcosystemServices extends Modules\Component\ImetModule_Eval
{ 
    protected $table = 'imet.eval_importance_c16';
    protected $fixed_rows = true;
    
    public function __construct(array $attributes = []) {
    
        $this->module_type = 'TABLE';
        $this->module_code = 'C1.6';
        $this->module_title = trans('form/imet/v1/evaluation.ImportanceEcosystemServices.title');
        $this->module_fields = [
            ['name' => 'Aspect',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.ImportanceEcosystemServices.fields.Aspect')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.ImportanceEcosystemServices.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Aspect',
            'values' => trans('form/imet/v1/evaluation.ImportanceEcosystemServices.predefined_values')
        ];

        $this->module_info = trans('form/imet/v1/evaluation.ImportanceEcosystemServices.module_info');
        $this->module_subTitle = trans('form/imet/v1/evaluation.ImportanceEcosystemServices.module_subTitle');
        $this->module_info_EvaluationQuestion = trans('form/imet/v1/evaluation.ImportanceEcosystemServices.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('form/imet/v1/evaluation.ImportanceEcosystemServices.module_info_Rating');
        $this->ratingLegend = trans('form/imet/v1/evaluation.ImportanceClimateChange.ratingLegend');


        parent::__construct($attributes);
     
    }
}