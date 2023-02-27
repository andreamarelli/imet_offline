<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class InformationAvailability extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet_oecm.eval_information_availability';
    protected $fixed_rows = true;
    public $titles = [];

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'I1';
        $this->module_title = trans('imet-core::oecm_evaluation.InformationAvailability.title');
        $this->module_fields = [
            ['name' => 'Element',           'type' => 'disabled',   'label' => trans('imet-core::oecm_evaluation.InformationAvailability.fields.Element')],
            ['name' => 'EvaluationScore',   'type' => 'imet-core::rating-0to3',   'label' => trans('imet-core::oecm_evaluation.InformationAvailability.fields.EvaluationScore')],
            ['name' => 'Comments',          'type' => 'text-area',   'label' => trans('imet-core::oecm_evaluation.InformationAvailability.fields.Comments')],
        ];

        $this->module_groups = trans('imet-core::oecm_context.AnalysisStakeholderAccessGovernance.groups');      // Re-use groups from CTX 5.1
        $this->titles = trans('imet-core::oecm_context.AnalysisStakeholderAccessGovernance.titles');            // Re-use titles from CTX 5.1

        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.InformationAvailability.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::oecm_evaluation.InformationAvailability.module_info_Rating');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.InformationAvailability.ratingLegend');

        parent::__construct($attributes);

    }

    /**
     * Preload data from CT 1.2
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

        $c1_2 = Modules\Evaluation\KeyElements::getModule($form_id)
            ->where('IncludeInStatistics', true);
        $preLoaded = [
            'field' => 'Element',
            'values' => [
                'group0' => $c1_2->where('group_key', 'group0')->pluck('Aspect')->toArray(),
                'group1' => $c1_2->where('group_key', 'group1')->pluck('Aspect')->toArray(),
                'group2' => $c1_2->where('group_key', 'group2')->pluck('Aspect')->toArray(),
                'group3' => $c1_2->where('group_key', 'group3')->pluck('Aspect')->toArray(),
                'group4' => $c1_2->where('group_key', 'group4')->pluck('Aspect')->toArray(),
                'group5' => $c1_2->where('group_key', 'group5')->pluck('Aspect')->toArray(),
                'group6' => $c1_2->where('group_key', 'group6')->pluck('Aspect')->toArray(),
                'group7' => $c1_2->where('group_key', 'group7')->pluck('Aspect')->toArray(),
                'group8' => $c1_2->where('group_key', 'group8')->pluck('Aspect')->toArray(),
                'group9' => $c1_2->where('group_key', 'group9')->pluck('Aspect')->toArray(),
                'group10' => $c1_2->where('group_key', 'group10')->pluck('Aspect')->toArray(),
                'group11' => $c1_2->where('group_key', 'group11')->pluck('Aspect')->toArray(),
                'group12' => $c1_2->where('group_key', 'group12')->pluck('Aspect')->toArray(),
                'group13' => $c1_2->where('group_key', 'group13')->pluck('Aspect')->toArray(),
            ]
        ];

        $module_records['records'] = static::arrange_records($preLoaded, $records, $empty_record);
        return $module_records;
    }


    /**
     * Override
     * @param $record
     * @param null $foreign_key
     * @return bool
     */
    public function isEmptyRecord($record, $foreign_key=null): bool
    {
        $isEmpty = true;

        if($record['EvaluationScore']!==null
            || $record['Comments']!==null
        ){
            $isEmpty = false;
        }

        return $isEmpty;
    }


}
