<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation;


use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class Objectives extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet_oecm.eval_objectives';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    protected static $DEPENDENCY_ON = 'Objective';
    protected static $DEPENDENCIES = [
        [AchievedObjectives::class, 'Aspect']
    ];

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'P6';
        $this->module_title = trans('imet-core::oecm_evaluation.Objectives.title');
        $this->module_fields = [
            ['name' => 'Objective',  'type' => 'text-area',   'label' => trans('imet-core::oecm_evaluation.Objectives.fields.Objective')],
            ['name' => 'Existence',  'type' => 'checkbox-boolean',   'label' => trans('imet-core::oecm_evaluation.Objectives.fields.Existence')],
            ['name' => 'EvaluationScore',  'type' => 'imet-core::rating-0to3',   'label' => trans('imet-core::oecm_evaluation.Objectives.fields.EvaluationScore')],
            ['name' => 'IncludeInPlanning',  'type' => 'checkbox-boolean',   'label' => trans('imet-core::oecm_evaluation.Objectives.fields.IncludeInPlanning')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::oecm_evaluation.Objectives.fields.Comments')],
        ];

        $this->module_groups = trans('imet-core::oecm_evaluation.Objectives.groups');

        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.Objectives.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::oecm_evaluation.Objectives.module_info_Rating');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.Objectives.ratingLegend');

        parent::__construct($attributes);
    }

    /**
     * Preload data from C4
     *
     * @param $predefined_values
     * @param $records
     * @param $empty_record
     * @return array
     */
    protected static function arrange_records($predefined_values, $records, $empty_record): array
    {
        $form_id = $empty_record['FormID'];

        $preLoaded = [
            'field' => 'Objective',
            'values' => [
                'group0' => [],
                'group1' => KeyElements::getPrioritizedElements($form_id)
            ]
        ];

        return parent::arrange_records($preLoaded, $records, $empty_record);
    }

}
