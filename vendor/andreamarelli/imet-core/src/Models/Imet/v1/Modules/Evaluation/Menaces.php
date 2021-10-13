<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;

class Menaces extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_menaces';
    protected $fixed_rows = true;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'C3';
        $this->module_title = trans('imet-core::v1_evaluation.Menaces.title');
        $this->module_fields = [
            ['name' => 'Aspect',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.Menaces.fields.Aspect')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.Menaces.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Aspect',
            'values' => trans('imet-core::v1_context.MenacesPressions.categories')   // Comes from context->MenacesPressions
        ];

        $this->module_info = trans('imet-core::v1_evaluation.Menaces.module_info');
        $this->module_info_EvaluationQuestion = trans('imet-core::v1_evaluation.Menaces.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v1_evaluation.Menaces.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v1_evaluation.Menaces.ratingLegend');

        parent::__construct($attributes);

    }
}
