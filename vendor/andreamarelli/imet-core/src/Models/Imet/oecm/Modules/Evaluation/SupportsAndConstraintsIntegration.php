<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

/**
 * @property $titles
 */
class SupportsAndConstraintsIntegration extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet_oecm.eval_supports_and_constraints_integration';
    protected $fixed_rows = true;
    public $titles = [];

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'C3.2';
        $this->module_title = trans('imet-core::oecm_evaluation.SupportsAndConstraintsIntegration.title');
        $this->module_fields = [
            ['name' => 'Stakeholder',       'type' => 'disabled',   'label' => trans('imet-core::oecm_evaluation.SupportsAndConstraintsIntegration.fields.Stakeholder')],
            ['name' => 'Weight',            'type' => 'disabled',   'label' => trans('imet-core::oecm_evaluation.SupportsAndConstraintsIntegration.fields.Weight')],
            ['name' => 'Integration',       'type' => 'imet-core::rating-0to3',   'label' => trans('imet-core::oecm_evaluation.SupportsAndConstraintsIntegration.fields.Integration')],
            ['name' => 'IncludeInStatistics',   'type' => 'checkbox-boolean',   'label' => trans('imet-core::oecm_evaluation.SupportsAndConstraintsIntegration.fields.IncludeInStatistics')],
            ['name' => 'Comments',              'type' => 'text-area',   'label' => trans('imet-core::oecm_evaluation.SupportsAndConstraintsIntegration.fields.Comments')],
        ];

        $this->ratingLegend = trans('imet-core::oecm_evaluation.SupportsAndConstraintsIntegration.ratingLegend');

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

        $records = $module_records['records'];

        $preLoaded = [
            'field' => 'Stakeholder',
            'values' => Modules\Context\StakeholdersNaturalResources::getStakeholders($form_id)
        ];

        $module_records['records'] = static::arrange_records($preLoaded, $records, $empty_record);

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


}
