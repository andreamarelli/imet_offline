<?php

namespace App\Models\Imet\v2\Modules\Evaluation;

use App\Models\Imet\v2\Modules;

class BoundaryLevel extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_boundary_level_v2';

    public static $rules = [
        'Boundaries'       => 'required'
    ];

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'P3';
        $this->module_title = trans('form/imet/v2/evaluation.BoundaryLevel.title');
        $this->module_fields = [
            ['name' => 'Adequacy',          'type' => 'text-area',               'label' => trans('form/imet/v2/evaluation.BoundaryLevel.fields.Adequacy')],
            ['name' => 'EvaluationScore',   'type' => 'blade-admin.imet.components.rating-0to3WithNA',   'label' => trans('form/imet/v2/evaluation.BoundaryLevel.fields.EvaluationScore')],
            ['name' => 'Comments',          'type' => 'text-area',               'label' => trans('form/imet/v2/evaluation.BoundaryLevel.fields.Comments')],
        ];

        $this->module_common_fields =[
            ['name' => 'Boundaries',            'type' => 'blade-admin.imet.components.rating-0to6',        'label' => trans('form/imet/v2/evaluation.BoundaryLevel.fields.Boundaries')],
            ['name' => 'BoundariesComments',    'type' => 'text-area',               'label' => trans('form/imet/v2/evaluation.BoundaryLevel.fields.BoundariesComments')],
        ];

        $this->predefined_values = [
            'field' => 'Adequacy',
            'values' => trans('form/imet/v2/evaluation.BoundaryLevel.predefined_values')
        ];

        $this->module_info_EvaluationQuestion = trans('form/imet/v2/evaluation.BoundaryLevel.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('form/imet/v2/evaluation.BoundaryLevel.module_info_Rating');
        $this->ratingLegend = trans('form/imet/v2/evaluation.BoundaryLevel.ratingLegend');

        parent::__construct($attributes);

    }

    public static function upgradeModule($record, $v1_to_v2 = false, $imet_version = null)
    {
        // ####  v1 -> v2  ####
        if($v1_to_v2) {
            return null;  // fully incompatible
        }

        return $record;
    }

}
