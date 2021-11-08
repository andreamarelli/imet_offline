<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;

class ImportanceSpecies extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_importance_c13';

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'C1.3';
        $this->module_title = trans('imet-core::v1_evaluation.ImportanceSpecies.title');
        $this->module_fields = [
            ['name' => 'Aspect',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.ImportanceSpecies.fields.Aspect')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3',   'label' => trans('imet-core::v1_evaluation.ImportanceSpecies.fields.EvaluationScore')],
            ['name' => 'SignificativeSpecies',  'type' => 'toggle-yes_no',   'label' => trans('imet-core::v1_evaluation.ImportanceSpecies.fields.SignificativeSpecies')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.ImportanceSpecies.fields.Comments')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::v1_evaluation.ImportanceSpecies.groups.group0'),
            'group1' => trans('imet-core::v1_evaluation.ImportanceSpecies.groups.group1'),
        ];

        $this->module_subTitle = trans('imet-core::v1_evaluation.ImportanceSpecies.module_subTitle');
        $this->module_info_EvaluationQuestion = trans('imet-core::v1_evaluation.ImportanceSpecies.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v1_evaluation.ImportanceSpecies.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v1_evaluation.ImportanceSpecies.ratingLegend');



        parent::__construct($attributes);

    }
}
