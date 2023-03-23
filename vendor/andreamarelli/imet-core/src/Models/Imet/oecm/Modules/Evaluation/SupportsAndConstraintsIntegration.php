<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation;


use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

/**
 * @property $titles
 */
class SupportsAndConstraintsIntegration extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet_oecm.eval_supports_constraints_integration';
    protected $fixed_rows = true;
    public $titles = [];

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    protected static $DEPENDENCY_ON = 'Stakeholder';
    protected static $DEPENDENCIES = [
        [Modules\Evaluation\InformationAvailability::class, 'Stakeholder'],
        [Modules\Evaluation\ManagementActivities::class, 'Stakeholder']
    ];

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'C2.2';
        $this->module_title = trans('imet-core::oecm_evaluation.SupportsAndConstraintsIntegration.title');
        $this->module_fields = [
            ['name' => 'Stakeholder',       'type' => 'blade-imet-core::oecm.evaluation.fields.support_integration_stakeholder_with_ranking',   'label' => trans('imet-core::oecm_evaluation.SupportsAndConstraintsIntegration.fields.Stakeholder')],
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

        $preLoaded = [
            'field' => 'Stakeholder',
            'values' => Modules\Context\StakeholdersNaturalResources::getStakeholders($form_id)
        ];
        $module_records['records'] = static::arrange_records($preLoaded, $module_records['records'], $empty_record);

        $weight = Modules\Context\StakeholdersNaturalResources::calculateWeights($form_id);
        $ranking = collect(SupportsAndConstraints::calculateRanking($form_id))
            ->pluck('__score', 'Stakeholder')
            ->toArray();

        foreach($module_records['records'] as $idx => $module_record){
            $module_records['records'][$idx]['__weight'] = $weight[$module_record['Stakeholder']] ?? null;
            $module_records['records'][$idx]['__score'] = $ranking[$module_record['Stakeholder']] ?? null;
        }
        return $module_records;
    }

}
