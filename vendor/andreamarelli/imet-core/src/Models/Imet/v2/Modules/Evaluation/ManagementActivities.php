<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;
use Illuminate\Support\Str;

class ManagementActivities extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_management_activities';
    protected $fixed_rows = true;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    protected static $DEPENDENCY_ON = 'Activity';

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'PR7';
        $this->module_title = trans('imet-core::v2_evaluation.ManagementActivities.title');
        $this->module_fields = [
            ['name' => 'Activity',  'type' => 'blade-imet-core::v2.evaluation.fields.key_element',   'label' => trans('imet-core::v2_evaluation.ManagementActivities.fields.Activity')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3WithNA',   'label' => trans('imet-core::v2_evaluation.ManagementActivities.fields.EvaluationScore')],
            ['name' => 'InManagementPlan',  'type' => 'checkbox-boolean_numeric',   'label' => trans('imet-core::v2_evaluation.ManagementActivities.fields.InManagementPlan')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.ManagementActivities.fields.Comments')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::v2_evaluation.ManagementActivities.groups.group0'),
            'group1' => trans('imet-core::v2_evaluation.ManagementActivities.groups.group1'),
            'group2' => trans('imet-core::v2_evaluation.ManagementActivities.groups.group2'),
            'group4' => trans('imet-core::v2_evaluation.ManagementActivities.groups.group4'),
            'group5' => trans('imet-core::v2_evaluation.ManagementActivities.groups.group5')
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.ManagementActivities.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.ManagementActivities.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.ManagementActivities.ratingLegend');

        parent::__construct($attributes);

    }

    /**
     * Prefill from CTX
     */
    protected static function getPredefined($form_id = null): ?array
    {
        return [
            'field' => static::$DEPENDENCY_ON,
            'values' => $form_id !== null
                ? [
                    'group0' => Modules\Evaluation\ImportanceSpecies::getModule($form_id)->filter(function ($item){
                        return $item['IncludeInStatistics'] && $item['group_key']==="group0";
                    })->pluck('Aspect')->toArray(),
                    'group1' =>Modules\Evaluation\ImportanceSpecies::getModule($form_id)->filter(function ($item){
                        return $item['IncludeInStatistics'] && $item['group_key']==="group1";
                    })->pluck('Aspect')->toArray(),
                    'group2' => Modules\Evaluation\ImportanceHabitats::getModule($form_id)->filter(function ($item){
                        return $item['IncludeInStatistics'];
                    })->pluck('Aspect')->toArray(),
                    'group4' => Modules\Evaluation\Menaces::getModule($form_id)->filter(function ($item){
                        return $item['IncludeInStatistics'];
                    })->pluck('Aspect')->toArray(),
                    'group5' => Modules\Evaluation\ImportanceEcosystemServices::getModule($form_id)->filter(function ($item){
                        return $item['IncludeInStatistics'];
                    })->pluck('Aspect')->toArray(),
                ]
                : []
        ];
    }

    public static function upgradeModule($record, $imet_version = null)
    {
        // ####  v2.7 -> v2.8 (marine pas)  ####
        if(empty($imet_version) or $imet_version < 'v2.7.6b'){
            // group3 merged into group2
            $record = static::replaceGroup($record, 'group_key', 'group3', 'group2');
        }

        return $record;
    }


}
