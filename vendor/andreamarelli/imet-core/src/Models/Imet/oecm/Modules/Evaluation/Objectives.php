<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ModularForms\Models\Traits\Payload;
use Exception;
use Illuminate\Http\Request;

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
     * @param $form_id
     * @param null $collection
     * @return array
     */
    public static function getModuleRecords($form_id, $collection = null): array
    {
        $module_records = parent::getModuleRecords($form_id, $collection);
        $empty_record = static::getEmptyRecord($form_id);

        $records = $module_records['records'];

        $c4_values = collect(KeyElements::getModuleRecords($form_id)['records'])
            ->filter(function($item){
                return $item['IncludeInStatistics'];
            })
            ->pluck('Aspect')
            ->toArray();

        $c_values = array_merge($c4_values);

        $preLoaded = [
            'field' => 'Objective',
            'values' => [
                'group0' => [],
                'group1' => $c4_values
            ]
        ];

        $module_records['records'] = static::arrange_records($preLoaded, $records, $empty_record);
        return $module_records;
    }

}
