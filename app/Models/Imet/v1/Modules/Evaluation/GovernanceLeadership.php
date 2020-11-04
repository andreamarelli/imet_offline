<?php

namespace App\Models\Imet\v1\Modules\Evaluation;

use App\Models\Imet\v1\Modules;

class GovernanceLeadership extends Modules\Component\ImetModule_Eval
{ 
    protected $table = 'imet.eval_governance_leadership';
    
    public function __construct(array $attributes = []) {
    
        $this->module_type = 'SIMPLE';
        $this->module_code = 'PR4';
        $this->module_title = trans('form/imet/v1/evaluation.GovernanceLeadership.title');
        $this->module_fields = [
            ['name' => 'EvaluationScoreGovernace',  'type' => 'rating-0to3',   'label' => trans('form/imet/v1/evaluation.GovernanceLeadership.fields.EvaluationScoreGovernace')],
            ['name' => 'EvaluationScoreLeadership',  'type' => 'rating-0to3',   'label' => trans('form/imet/v1/evaluation.GovernanceLeadership.fields.EvaluationScoreLeadership')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.GovernanceLeadership.fields.Comments')],
        ];

        $this->module_info_EvaluationQuestion = trans('form/imet/v1/evaluation.GovernanceLeadership.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('form/imet/v1/evaluation.GovernanceLeadership.module_info_Rating');
        $this->ratingLegend = trans('form/imet/v1/evaluation.GovernanceLeadership.ratingLegend');

        parent::__construct($attributes);
    }
}