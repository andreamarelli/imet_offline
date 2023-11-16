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
        [Objectives::class, 'Stakeholder'],
        [Modules\Evaluation\InformationAvailability::class, 'Stakeholder']
    ];

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'C2.2';
        $this->module_title = trans('imet-core::oecm_evaluation.SupportsAndConstraintsIntegration.title');
        $this->module_fields = [
            ['name' => 'Stakeholder',       'type' => 'blade-imet-core::oecm.evaluation.fields.support_integration_stakeholder_with_ranking',   'label' => trans('imet-core::oecm_evaluation.SupportsAndConstraintsIntegration.fields.Stakeholder')],
            ['name' => 'Integration',       'type' => 'imet-core::rating-0to3',   'label' => trans('imet-core::oecm_evaluation.SupportsAndConstraintsIntegration.fields.Integration')],
            ['name' => 'IncludeInStatistics',   'type' => 'checkbox-boolean',   'label' => trans('imet-core::oecm_evaluation.SupportsAndConstraintsIntegration.fields.IncludeInStatistics')],
            ['name' => 'Comments',              'type' => 'text-area',   'label' => trans('imet-core::oecm_evaluation.SupportsAndConstraintsIntegration.fields.Comments')],
        ];

        $this->module_groups = trans('imet-core::oecm_evaluation.SupportsAndConstraintsIntegration.groups');
        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.SupportsAndConstraintsIntegration.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::oecm_evaluation.SupportsAndConstraintsIntegration.module_info_Rating');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.SupportsAndConstraintsIntegration.ratingLegend');

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
        $records  = parent::arrange_records($predefined_values, $records, $empty_record);
        $form_id = $empty_record['FormID'];

        $weight = Modules\Context\Stakeholders::calculateWeights($form_id);
        $ranking = collect(SupportsAndConstraints::calculateRanking($form_id))
            ->pluck('ConstraintLevel', 'Stakeholder')
            ->toArray();

        foreach($records as $idx => $record){
            $records[$idx]['__weight'] = $weight[$record['Stakeholder']] ?? null;
            $records[$idx]['__score'] = $ranking[$record['Stakeholder']]!==null ? $ranking[$record['Stakeholder']]*100/3 : null;
        }

        return collect($records)
            ->sortBy('__score')
            ->values()
            ->toArray();
    }

    /**
     * Provide the list of prioritized key elements
     * @param $form_id
     * @return array
     */
    public static function getPrioritizedElements($form_id): array
    {
        return collect(static::getModuleRecords($form_id)['records'])
            ->filter(function ($item) {
                return $item['IncludeInStatistics'];
            })
            ->pluck('Stakeholder')
            ->toArray();
    }

    protected static function getRecordsToBeDropped($records, $form_id, $dependency_on): array
    {
        // Get list of values (of reference field) from DB and from updated records
        $existing_values = static::getModule($form_id)
            ->where('IncludeInStatistics', true)
            ->pluck($dependency_on)
            ->toArray();
        $updated_values = collect($records)
            ->where('IncludeInStatistics', true)
            ->pluck($dependency_on)
            ->toArray();

        // Make diff to find out what to drop
        $to_be_dropped = array_diff($existing_values, $updated_values);
        return array_values($to_be_dropped);
    }

}
