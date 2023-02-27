<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class BoundaryLevel extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet_oecm.eval_boundary_level';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public static $rules = [
        'Boundaries'       => 'required'
    ];

    public function __construct(array $attributes = []) {

        $this->module_type = 'SIMPLE';
        $this->module_code = 'P3';
        $this->module_title = trans('imet-core::oecm_evaluation.BoundaryLevel.title');

        $this->module_fields =[
            ['name' => 'Boundaries',    'type' => 'imet-core::rating-0to6',         'label' => trans('imet-core::oecm_evaluation.BoundaryLevel.fields.Boundaries')],
            ['name' => 'Adequacy',      'type' => 'imet-core::rating-0to3',   'label' => trans('imet-core::oecm_evaluation.BoundaryLevel.fields.Adequacy')],
            ['name' => 'Comments',      'type' => 'text-area',                      'label' => trans('imet-core::oecm_evaluation.BoundaryLevel.fields.Comments')],
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.BoundaryLevel.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::oecm_evaluation.BoundaryLevel.module_info_Rating');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.BoundaryLevel.ratingLegend');

        parent::__construct($attributes);

    }
}
