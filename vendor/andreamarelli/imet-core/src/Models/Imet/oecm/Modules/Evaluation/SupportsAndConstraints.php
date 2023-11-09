<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

/**
 * @property $titles
 */
class SupportsAndConstraints extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet_oecm.eval_supports_constraints';
    protected $fixed_rows = true;
    public $titles = [];

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    protected static $DEPENDENCY_ON = 'Stakeholder';

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'C2.1';
        $this->module_title = trans('imet-core::oecm_evaluation.SupportsAndConstraints.title');
        $this->module_fields = [
            ['name' => 'Stakeholder',       'type' => 'disabled',   'label' => trans('imet-core::oecm_evaluation.SupportsAndConstraints.fields.Stakeholder')],
            ['name' => 'Weight',            'type' => 'disabled',   'label' => trans('imet-core::oecm_evaluation.SupportsAndConstraints.fields.Weight')],
            ['name' => 'ConstraintLevel',   'type' => 'imet-core::rating-Minus3to3',   'label' => trans('imet-core::oecm_evaluation.SupportsAndConstraints.fields.ConstraintLevel')],
            ['name' => 'Comments',           'type' => 'text-area',   'label' => trans('imet-core::oecm_evaluation.SupportsAndConstraints.fields.Comments')],
        ];

        $this->module_groups = trans('imet-core::oecm_evaluation.SupportsAndConstraints.groups');
        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.SupportsAndConstraints.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::oecm_evaluation.SupportsAndConstraints.module_info_Rating');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.SupportsAndConstraints.ratingLegend');

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
            'field' => 'Stakeholder',
            'values' => $predefined_values
        ];
    }

    protected static function arrange_records($predefined_values, $records, $empty_record): array
    {
        $form_id = $empty_record['FormID'];

        $records = parent::arrange_records($predefined_values, $records, $empty_record);

        $weight = Modules\Context\Stakeholders::calculateWeights($form_id);
        foreach($records as $idx => $record){
            if(array_key_exists($record['Stakeholder'], $weight)){
                $records[$idx]['Weight'] = $weight[$record['Stakeholder']];
            } else {
                $records[$idx]['Weight'] = null;
            }
        }

        return collect($records)
            ->sortByDesc('Weight')
            ->values()
            ->toArray();
    }

    public static function calculateRanking($form_id): array
    {
        $records = static::getModuleRecords($form_id)['records'];

        return collect($records)
            ->map(function($item){
                $item['__score'] = $item['Weight'] !== null && $item['ConstraintLevel'] !== null
                    ? $item['ConstraintLevel'] * $item['Weight']
                    : null;
                return $item;
            })
            ->toArray();
    }


}
