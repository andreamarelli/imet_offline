<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;

class GovernanceLeadership extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_governance_leadership';

    public function __construct(array $attributes = []) {

        $this->module_type = 'SIMPLE';
        $this->module_code = 'PR4';
        $this->module_title = trans('imet-core::v1_evaluation.GovernanceLeadership.title');
        $this->module_fields = [
            ['name' => 'EvaluationScoreGovernace',  'type' => 'rating-0to3',   'label' => trans('imet-core::v1_evaluation.GovernanceLeadership.fields.EvaluationScoreGovernace')],
            ['name' => 'EvaluationScoreLeadership',  'type' => 'rating-0to3',   'label' => trans('imet-core::v1_evaluation.GovernanceLeadership.fields.EvaluationScoreLeadership')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.GovernanceLeadership.fields.Comments')],
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v1_evaluation.GovernanceLeadership.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v1_evaluation.GovernanceLeadership.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v1_evaluation.GovernanceLeadership.ratingLegend');

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
            'table' => 'Eval_Governance_Leadership',
            'fields' => [
                'EvaluationScoreGovernace', 'EvaluationScoreLeadership', 'Comments'
            ]
        ];
    }
}
