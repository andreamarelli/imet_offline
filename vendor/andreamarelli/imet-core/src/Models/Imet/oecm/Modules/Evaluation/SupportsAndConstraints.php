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

        $this->module_type = 'TABLE';
        $this->module_code = 'C2.1';
        $this->module_title = trans('imet-core::oecm_evaluation.SupportsAndConstraints.title');
        $this->module_fields = [
            ['name' => 'Stakeholder',       'type' => 'disabled',   'label' => trans('imet-core::oecm_evaluation.SupportsAndConstraints.fields.Stakeholder')],
            ['name' => 'Weight',            'type' => 'disabled',   'label' => trans('imet-core::oecm_evaluation.SupportsAndConstraints.fields.Weight')],
            ['name' => 'ConstraintLevel',   'type' => 'imet-core::rating-Minus3to3',   'label' => trans('imet-core::oecm_evaluation.SupportsAndConstraints.fields.ConstraintLevel')],
            ['name' => 'Comments',           'type' => 'text-area',   'label' => trans('imet-core::oecm_evaluation.SupportsAndConstraints.fields.Comments')],
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.SupportsAndConstraints.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::oecm_evaluation.SupportsAndConstraints.module_info_Rating');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.SupportsAndConstraints.ratingLegend');

        parent::__construct($attributes);
    }

    /**
     * Preload data from CTX 3.1.2
     *
     * @param $form_id
     * @param null $collection
     * @return array
     */
    public static function getModuleRecords($form_id, $collection = null): array
    {
        $module_records = parent::getModuleRecords($form_id, $collection);
        $empty_record = static::getEmptyRecord($form_id);

        $preLoaded = [
            'field' => 'Stakeholder',
            'values' => Modules\Context\StakeholdersNaturalResources::getStakeholders($form_id)
        ];
        $module_records['records'] = static::arrange_records($preLoaded, $module_records['records'], $empty_record);

        $weight = Modules\Context\StakeholdersNaturalResources::calculateWeights($form_id);
        foreach($module_records['records'] as $idx => $module_record){
            if(array_key_exists($module_record['Stakeholder'], $weight)){
                $module_records['records'][$idx]['Weight'] = $weight[$module_record['Stakeholder']];
            } else {
                $module_records['records'][$idx]['Weight'] = null;
            }
        }

        return $module_records;
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
