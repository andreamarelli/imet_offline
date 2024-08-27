<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class AchievedObjectives extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_achived_objectives';
    protected $fixed_rows = true;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    protected static $DEPENDENCY_ON = 'Objective';

    public function __construct(array $attributes = []) {
        $this->module_type = 'TABLE';
        $this->module_code = 'O/C1';
        $this->module_title = trans('imet-core::oecm_evaluation.AchievedObjectives.title');
        $this->module_fields = [
            ['name' => 'Objective',  'type' => 'disabled',   'label' => trans('imet-core::oecm_evaluation.AchievedObjectives.fields.Objective')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3',   'label' => trans('imet-core::oecm_evaluation.AchievedObjectives.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::oecm_evaluation.AchievedObjectives.fields.Comments')],
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.AchievedObjectives.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::oecm_evaluation.AchievedObjectives.module_info_Rating');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.AchievedObjectives.ratingLegend');

        parent::__construct($attributes);
    }

    /**
     * Prefill from P6
     *
     * @param $form_id
     * @return array
     */
    protected static function getPredefined($form_id = null): ?array
    {
        $p6_values = $form_id!==null
            ? collect(Objectives::getModuleRecords($form_id)['records'])
                ->filter(function($item){
                    return $item['group_key']==='group0' // All objectives of group0 ("Adequacy of management plan objectives for the key elements")
                        || $item['Existence'];           //  + only objectives with "Existence" from group1 (derived form Context: C1, C2.2, C3.2 & C4 )
                })
                ->pluck('Objective')
                ->toArray()
            : [] ;

        return [
            'field' => static::$DEPENDENCY_ON,
            'values' => $p6_values
        ];
    }

}
