<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;

class BoundaryLevel extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_boundary_level_v2';

    public static $rules = [
        'Boundaries'       => 'required'
    ];

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'P3';
        $this->module_title = trans('imet-core::v2_evaluation.BoundaryLevel.title');
        $this->module_fields = [
            ['name' => 'Adequacy',          'type' => 'text-area',               'label' => trans('imet-core::v2_evaluation.BoundaryLevel.fields.Adequacy')],
            ['name' => 'EvaluationScore',   'type' => 'blade-imet-core::components.rating-0to3WithNA',   'label' => trans('imet-core::v2_evaluation.BoundaryLevel.fields.EvaluationScore')],
            ['name' => 'Comments',          'type' => 'text-area',               'label' => trans('imet-core::v2_evaluation.BoundaryLevel.fields.Comments')],
        ];

        $this->module_common_fields =[
            ['name' => 'Boundaries',            'type' => 'blade-imet-core::components.rating-0to6',        'label' => trans('imet-core::v2_evaluation.BoundaryLevel.fields.Boundaries')],
            ['name' => 'BoundariesComments',    'type' => 'text-area',               'label' => trans('imet-core::v2_evaluation.BoundaryLevel.fields.BoundariesComments')],
        ];

        $this->predefined_values = [
            'field' => 'Adequacy',
            'values' => trans('imet-core::v2_evaluation.BoundaryLevel.predefined_values')
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.BoundaryLevel.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.BoundaryLevel.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.BoundaryLevel.ratingLegend');

        parent::__construct($attributes);

    }



}
