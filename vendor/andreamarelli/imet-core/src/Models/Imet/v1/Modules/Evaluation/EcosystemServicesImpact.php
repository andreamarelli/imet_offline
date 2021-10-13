<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;

class EcosystemServicesImpact extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_ecosystem_services_impact';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'E/I6';
        $this->module_title = trans('imet-core::v1_evaluation.EcosystemServicesImpact.title');
        $this->module_fields = [
            ['name' => 'Impact',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.EcosystemServicesImpact.fields.Impact')],
            ['name' => 'EvaluationScore',  'type' => 'rating-Minus3to3WithNA',   'label' => trans('imet-core::v1_evaluation.EcosystemServicesImpact.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.EcosystemServicesImpact.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Impact',
            'values' => trans('imet-core::v1_evaluation.EcosystemServicesImpact.predefined_values')
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v1_evaluation.EcosystemServicesImpact.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v1_evaluation.EcosystemServicesImpact.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v1_evaluation.EcosystemServicesImpact.ratingLegend');

        parent::__construct($attributes);

    }
}
