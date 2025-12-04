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
        [AchievedObjectives::class, 'Objective']
    ];

    private static $cache_predefined_values = null;

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'P6';
        $this->module_title = trans('imet-core::oecm_evaluation.Objectives.title');
        $this->module_fields = [
            ['name' => 'Objective',  'type' => 'text-area',   'label' => trans('imet-core::oecm_evaluation.Objectives.fields.Objective')],
            ['name' => 'Existence',  'type' => 'checkbox-boolean',   'label' => trans('imet-core::oecm_evaluation.Objectives.fields.Existence')],
            ['name' => 'EvaluationScore',  'type' => 'imet-core::rating-0to3',   'label' => trans('imet-core::oecm_evaluation.Objectives.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::oecm_evaluation.Objectives.fields.Comments')],
        ];

        $this->module_groups = trans('imet-core::oecm_evaluation.Objectives.groups');

        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.Objectives.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::oecm_evaluation.Objectives.module_info_Rating');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.Objectives.ratingLegend');

        parent::__construct($attributes);
    }

    protected static function getPredefined($form_id = null): array
    {
        if (static::$cache_predefined_values === null) {
            $key_elements = $form_id != null
                ? array_merge(
                    KeyElements::getPrioritizedElements($form_id),
                    Designation::getPrioritizedElements($form_id),
                    SupportsAndConstraintsIntegration::getPrioritizedElements($form_id),
                    ThreatsIntegration::getPrioritizedElements($form_id)
                )
                : [];


            static::$cache_predefined_values = [
                'field' => static::$DEPENDENCY_ON,
                'values' => [
                    'group0' => [],
                    'group1' => $key_elements
                ]
            ];
        }
        return static::$cache_predefined_values;
    }

    /**
     * Override
     */
    public static function upgradeModule($record, $imet_version = null): array
    {
        // ####  v2.12 -> v2.13 ####
        return self::dropField($record, 'IncludeInPlanning');
    }

    protected static function getRecordsToBeDropped($records, $form_id, $dependency_on): array
    {
        // Get list of values (of reference field) from DB and from updated records
        $existing_values = static::getModule($form_id)
            ->filter(function($item){
                return $item['group_key']==='group0'
                    || $item['Existence'];
            })
            ->pluck($dependency_on)
            ->toArray();
        $updated_values = collect($records)
            ->filter(function($item){
                return $item['group_key']==='group0'
                    || $item['Existence'];
            })
            ->pluck($dependency_on)
            ->toArray();

        // Make diff to find out what to drop
        $to_be_dropped = array_diff($existing_values, $updated_values);
        return array_values($to_be_dropped);
    }

}
