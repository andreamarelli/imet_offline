<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class KeyElements extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet_oecm.eval_key_elements';
    protected $fixed_rows = true;
    public $titles = [];

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'C1.2';
        $this->module_title = trans('imet-core::oecm_evaluation.KeyElements.title');
        $this->module_fields = [
            ['name' => 'Aspect',                'type' => 'disabled',      'label' => trans('imet-core::oecm_evaluation.KeyElements.fields.Aspect')],
            ['name' => 'EvaluationScore',       'type' => 'imet-core::rating-0to3',   'label' => trans('imet-core::oecm_evaluation.KeyElements.fields.EvaluationScore')],
            ['name' => 'IncludeInStatistics',   'type' => 'checkbox-boolean',   'label' => trans('imet-core::oecm_evaluation.KeyElements.fields.IncludeInStatistics')],
            ['name' => 'Comments',              'type' => 'text-area',   'label' => trans('imet-core::oecm_evaluation.KeyElements.fields.Comments')],
        ];

        $this->module_groups = trans('imet-core::oecm_context.AnalysisStakeholderAccessGovernance.groups');     // Re-use groups from CTX 5.1
        $this->titles = trans('imet-core::oecm_context.AnalysisStakeholderAccessGovernance.titles');            // Re-use titles from CTX 5.1

        $this->module_subTitle = trans('imet-core::oecm_evaluation.KeyElements.module_subTitle');
        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.KeyElements.module_info_EvaluationQuestion');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.KeyElements.ratingLegend');

        parent::__construct($attributes);
    }

    /**
     * Preload data from CTX 5.1
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

        $ctx5 = Modules\Context\AnalysisStakeholderAccessGovernance::getModule($form_id);
        $preLoaded = [
            'field' => 'Aspect',
            'values' => [
                'group0' => $ctx5->where('group_key', 'group0')->pluck('Element')->toArray(),
                'group1' => $ctx5->where('group_key', 'group1')->pluck('Element')->toArray(),
                'group2' => $ctx5->where('group_key', 'group2')->pluck('Element')->toArray(),
                'group3' => $ctx5->where('group_key', 'group3')->pluck('Element')->toArray(),
                'group4' => $ctx5->where('group_key', 'group4')->pluck('Element')->toArray(),
                'group5' => $ctx5->where('group_key', 'group5')->pluck('Element')->toArray(),
                'group6' => $ctx5->where('group_key', 'group6')->pluck('Element')->toArray(),
                'group7' => $ctx5->where('group_key', 'group7')->pluck('Element')->toArray(),
                'group8' => $ctx5->where('group_key', 'group8')->pluck('Element')->toArray(),
                'group9' => $ctx5->where('group_key', 'group9')->pluck('Element')->toArray(),
                'group10' => $ctx5->where('group_key', 'group10')->pluck('Element')->toArray(),
                'group11' => $ctx5->where('group_key', 'group11')->pluck('Element')->toArray(),
                'group12' => $ctx5->where('group_key', 'group12')->pluck('Element')->toArray(),
                'group13' => $ctx5->where('group_key', 'group13')->pluck('Element')->toArray(),
            ]
        ];

        $module_records['records'] = static::arrange_records($preLoaded, $records, $empty_record);
        return $module_records;
    }
}