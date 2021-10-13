<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;

class ImportanceClassification extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_importance_c12';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'C1.1';
        $this->module_title = trans('imet-core::v2_evaluation.ImportanceClassification.title');
        $this->module_fields = [
            ['name' => 'Aspect',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.ImportanceClassification.fields.Aspect')],
            ['name' => 'EvaluationScore',  'type' => 'blade-imet-core::components.rating-0to3',   'label' => trans('imet-core::v2_evaluation.ImportanceClassification.fields.EvaluationScore')],
            ['name' => 'SignificativeClassification',  'type' => 'checkbox-boolean',   'label' => trans('imet-core::v2_evaluation.ImportanceClassification.fields.SignificativeClassification')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.ImportanceClassification.fields.Comments')],
        ];

        $this->module_subTitle = trans('imet-core::v2_evaluation.ImportanceClassification.module_subTitle');
        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.ImportanceClassification.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.ImportanceClassification.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.ImportanceClassification.ratingLegend');

        parent::__construct($attributes);

    }
}
