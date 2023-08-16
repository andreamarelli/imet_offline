<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class CapacityAdequacy extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet_oecm.eval_capacity_adequacy';
    protected $fixed_rows = true;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    protected static $DEPENDENCY_ON = 'Member';

    public function __construct(array $attributes = [])
    {
        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'I2';
        $this->module_title = trans('imet-core::oecm_evaluation.CapacityAdequacy.title');
        $this->module_fields = [
            ['name' => 'Member',        'type' => 'disabled',                   'label' => trans('imet-core::oecm_evaluation.CapacityAdequacy.fields.Member')],
            ['name' => 'Weight',        'type' => 'disabled',                   'label' => trans('imet-core::oecm_evaluation.CapacityAdequacy.fields.Weight')],
            ['name' => 'Adequacy',      'type' => 'imet-core::rating-0to3',     'label' => trans('imet-core::oecm_evaluation.CapacityAdequacy.fields.Adequacy')],
            ['name' => 'Comments',      'type' => 'text-area',                  'label' => trans('imet-core::oecm_evaluation.CapacityAdequacy.fields.Comments')],
        ];

        $this->module_groups = trans('imet-core::oecm_evaluation.CapacityAdequacy.groups');

        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.CapacityAdequacy.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::oecm_evaluation.CapacityAdequacy.module_info_Rating');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.CapacityAdequacy.ratingLegend');

        parent::__construct($attributes);
    }

    /**
     * Preload data
     * @param $predefined_values
     * @param $records
     * @param $empty_record
     * @return array
     */
    protected static function arrange_records($predefined_values, $records, $empty_record): array
    {
        $form_id = $empty_record['FormID'];

        $preLoaded = [
            'field' => 'Member',
            'values' => [
                'group0' => Modules\Context\ManagementStaff::getModule($form_id)->pluck('Function')->toArray(),
                'group1' => Modules\Context\Stakeholders::getStakeholders($form_id),
            ]
        ];

        $records = parent::arrange_records($preLoaded, $records, $empty_record);

        $weighted_staff = Modules\Context\ManagementStaff::calculateWeights($form_id);
        $weighted_stakeholder = Modules\Context\Stakeholders::calculateWeights($form_id);

        foreach($records as $idx => $module_record){
            if($module_record['group_key']==='group0'){
                $records[$idx]['Weight'] = $weighted_staff[$module_record['Member']] ?? null;
            } elseif($module_record['group_key']==='group1'){
                $records[$idx]['Weight'] = $weighted_stakeholder[$module_record['Member']] ?? null;
            }
        }

        return $records;
    }
}
