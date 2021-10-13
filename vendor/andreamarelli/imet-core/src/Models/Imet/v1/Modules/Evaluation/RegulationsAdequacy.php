<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;

class RegulationsAdequacy extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_regulations_adequacy';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'P1';
        $this->module_title = trans('imet-core::v1_evaluation.RegulationsAdequacy.title');
        $this->module_fields = [
            ['name' => 'Regulation',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.RegulationsAdequacy.fields.Regulation')],
            ['name' => 'EvaluationScore',  'type' => 'rating-Minus3to3WithNA',   'label' => trans('imet-core::v1_evaluation.RegulationsAdequacy.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.RegulationsAdequacy.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Regulation',
            'values' => trans('imet-core::v1_evaluation.RegulationsAdequacy.predefined_values')
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v1_evaluation.RegulationsAdequacy.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v1_evaluation.RegulationsAdequacy.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v1_evaluation.RegulationsAdequacy.ratingLegend');

        parent::__construct($attributes);

    }
}
