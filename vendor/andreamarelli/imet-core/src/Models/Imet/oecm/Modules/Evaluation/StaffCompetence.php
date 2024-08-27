<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class StaffCompetence extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_staff_competence';
    protected $fixed_rows = true;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    protected static $DEPENDENCY_ON = 'Member';

    public function __construct(array $attributes = [])
    {
        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'PR1';
        $this->module_title = trans('imet-core::oecm_evaluation.StaffCompetence.title');
        $this->module_fields = [
            ['name' => 'Member',    'type' => 'disabled',   'label' => trans('imet-core::oecm_evaluation.StaffCompetence.fields.Member')],
            ['name' => 'Weight',    'type' => 'disabled',   'label' => trans('imet-core::oecm_evaluation.StaffCompetence.fields.Weight')],
            ['name' => 'Adequacy',  'type' => 'rating-0to3',   'label' => trans('imet-core::oecm_evaluation.StaffCompetence.fields.Adequacy')],
            ['name' => 'Comments',  'type' => 'text-area',  'label' => trans('imet-core::oecm_evaluation.StaffCompetence.fields.Comments')],
        ];

        $this->module_groups = trans('imet-core::oecm_evaluation.StaffCompetence.groups');

        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.StaffCompetence.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::oecm_evaluation.StaffCompetence.module_info_Rating');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.StaffCompetence.ratingLegend');

        parent::__construct($attributes);
    }

    protected static function getPredefined($form_id = null): ?array
    {
        $predefined_values = $form_id!==null
            ? [
                'group0' => Modules\Context\ManagementStaff::getModule($form_id)->pluck('Function')->toArray(),
                'group1' => Modules\Context\Stakeholders::getStakeholders($form_id),
            ]
            : [];

        return [
            'field' => static::$DEPENDENCY_ON,
            'values' => $predefined_values
        ];
    }

    protected static function arrange_records($predefined_values, $records, $empty_record): array
    {
        $form_id = $empty_record['FormID'];

        $records = parent::arrange_records($predefined_values, $records, $empty_record);

        $weighted_staff = Modules\Context\ManagementStaff::calculateWeights($form_id);
        $weighted_stakeholder = Modules\Context\Stakeholders::calculateWeights($form_id);

        foreach($records as $idx => $record){
            if($record['group_key']==='group0'){
                $records[$idx]['Weight'] = $weighted_staff[$record['Member']] ?? null;
            } elseif($record['group_key']==='group1'){
                $records[$idx]['Weight'] = $weighted_stakeholder[$record['Member']] ?? null;
            }
        }

        return $records;
    }

}
