<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class ManagementActivities extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet_oecm.eval_management_activities';
    protected $fixed_rows = true;
    public $titles = [];

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'PR6';
        $this->module_title = trans('imet-core::oecm_evaluation.ManagementActivities.title');
        $this->module_fields = [
            ['name' => 'Activity',          'type' => 'disabled',   'label' => trans('imet-core::oecm_evaluation.ManagementActivities.fields.Activity')],
            ['name' => 'EvaluationScore',   'type' => 'imet-core::rating-0to3WithNA',   'label' => trans('imet-core::oecm_evaluation.ManagementActivities.fields.EvaluationScore')],
            ['name' => 'InManagementPlan',  'type' => 'checkbox-boolean_numeric',   'label' => trans('imet-core::oecm_evaluation.ManagementActivities.fields.InManagementPlan')],
            ['name' => 'Comments',          'type' => 'text-area',   'label' => trans('imet-core::oecm_evaluation.ManagementActivities.fields.Comments')],
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.ManagementActivities.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::oecm_evaluation.ManagementActivities.module_info_Rating');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.ManagementActivities.ratingLegend');

        parent::__construct($attributes);
    }


    /**
     * Override
     * @param $record
     * @param null $foreign_key
     * @return bool
     */
    public function isEmptyRecord($record, $foreign_key=null): bool
    {
        if($record['EvaluationScore']!==null || $record['InManagementPlan']!==null || $record['Comments']!==null){
            return false;
        }
        return true;
    }


    /**
     * Preload data from C1, C2, C3 & C4
     *
     * @param $form_id
     * @param null $collection
     * @return array
     */
    public static function getModuleRecords($form_id, $collection = null): array
    {
        $module_records = parent::getModuleRecords($form_id, $collection);
        $empty_record = static::getEmptyRecord($form_id);

        $records = $module_records['records'];

        $c1_values = collect(Designation::getModuleRecords($form_id)['records'])
            ->filter(function($item){
                return $item['IncludeInStatistics'];
            })
            ->pluck('Aspect')
            ->toArray();

        $c2_values = collect(SupportsAndConstraintsIntegration::getModuleRecords($form_id)['records'])
            ->filter(function($item){
                return $item['IncludeInStatistics'];
            })
            ->pluck('Stakeholder')
            ->toArray();

        $c3_values = collect(ThreatsIntegration::getModuleRecords($form_id)['records'])
            ->filter(function($item){
                return $item['IncludeInStatistics'];
            })
            ->pluck('Threat')
            ->toArray();

        $c4_values = collect(KeyElements::getModuleRecords($form_id)['records'])
            ->filter(function($item){
                return $item['IncludeInStatistics'];
            })
            ->pluck('Aspect')
            ->toArray();

        $preLoaded = [
            'field' => 'Activity',
            'values' => array_merge($c1_values, $c2_values, $c3_values, $c4_values)
        ];

        $module_records['records'] = static::arrange_records($preLoaded, $records, $empty_record);
        return $module_records;
    }

}
