<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class StakeholderCooperation extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet_oecm.eval_stakeholder_cooperation';
    protected $fixed_rows = true;
    public $titles = [];

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    protected static $DEPENDENCY_ON = 'Element';

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'PR9';
        $this->module_title = trans('imet-core::oecm_evaluation.StakeholderCooperation.title');
        $this->module_fields = [
            ['name' => 'Element',           'type' => 'disabled',           'label' => trans('imet-core::oecm_evaluation.StakeholderCooperation.fields.Element'), 'other'=>'rows="3"'],
            ['name' => 'Weight',            'type' => 'disabled',           'label' => trans('imet-core::oecm_evaluation.StakeholderCooperation.fields.Weight')],
            ['name' => 'Cooperation',       'type' => 'imet-core::rating-0to3WithNA',  'label' => trans('imet-core::oecm_evaluation.StakeholderCooperation.fields.Cooperation')],
            ['name' => 'Comments',          'type' => 'text-area',          'label' => trans('imet-core::oecm_evaluation.StakeholderCooperation.fields.Comments')],
        ];

        $this->module_groups = trans('imet-core::oecm_evaluation.StakeholderCooperation.groups');

        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.StakeholderCooperation.module_info_EvaluationQuestion');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.StakeholderCooperation.ratingLegend');
        $this->module_info_Rating = trans('imet-core::oecm_evaluation.StakeholderCooperation.module_info_Rating');

        parent::__construct($attributes);
    }

    protected static function getPredefined($form_id = null): array
    {
        $predefined_values = $form_id!==null
            ? [
                'group0' => Modules\Context\Stakeholders::getStakeholders($form_id, Modules\Context\Stakeholders::ONLY_DIRECT),
                'group1' => Modules\Context\Stakeholders::getStakeholders($form_id, Modules\Context\Stakeholders::ONLY_INDIRECT),
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
        $weight = Modules\Context\Stakeholders::calculateWeights($form_id);

        foreach($records as $idx => $record){
            if(array_key_exists($record['Element'], $weight)){
                $records[$idx]['Weight'] = $weight[$record['Element']];
            } else {
                $records[$idx]['Weight'] = null;
            }
        }

        return collect($records)
            ->sortByDesc('Weight')
            ->values()
            ->toArray();
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

        if($record['Element']!==null){
            $isEmpty = false;
        }

        return $isEmpty;
    }

}
