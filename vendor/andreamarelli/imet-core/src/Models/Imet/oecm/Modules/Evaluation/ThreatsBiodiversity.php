<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation;

use AndreaMarelli\ImetCore\Exceptions\MissingDependencyConfigurationException;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ImetCore\Services\ThreatsService;

class ThreatsBiodiversity extends Modules\Component\ImetModule_Eval {

    protected $table = 'eval_threats_biodiversity';
    protected $fixed_rows = true;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    protected static $DEPENDENCY_ON = 'Criteria';

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'C3.1.1';
        $this->module_title = trans('imet-core::oecm_evaluation.ThreatsBiodiversity.title');
        $this->module_fields = [
            ['name' => 'Criteria',      'type' => 'disabled',                       'label' => trans('imet-core::oecm_evaluation.ThreatsBiodiversity.fields.Criteria')],
            ['name' => 'Impact',        'type' => 'imet-core::rating-0to3',         'label' => trans('imet-core::oecm_evaluation.ThreatsBiodiversity.fields.Impact')],
            ['name' => 'Extension',     'type' => 'imet-core::rating-0to3',         'label' => trans('imet-core::oecm_evaluation.ThreatsBiodiversity.fields.Extension')],
            ['name' => 'Duration',      'type' => 'imet-core::rating-0to3',         'label' => trans('imet-core::oecm_evaluation.ThreatsBiodiversity.fields.Duration')],
            ['name' => 'Trend',         'type' => 'imet-core::rating-Minus2to2',    'label' => trans('imet-core::oecm_evaluation.ThreatsBiodiversity.fields.Trend')],
            ['name' => 'Probability',   'type' => 'imet-core::rating-0to3',         'label' => trans('imet-core::oecm_evaluation.ThreatsBiodiversity.fields.Probability')],
            ['name' => 'Note',          'type' => 'text-area',                      'label' => trans('imet-core::oecm_evaluation.ThreatsBiodiversity.fields.Note')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::oecm_evaluation.ThreatsBiodiversity.groups.group0'),
            'group1' => trans('imet-core::oecm_evaluation.ThreatsBiodiversity.groups.group1'),
            'group2' => trans('imet-core::oecm_evaluation.ThreatsBiodiversity.groups.group2'),
        ];

        $this->module_info = trans('imet-core::oecm_evaluation.ThreatsBiodiversity.module_info');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.ThreatsBiodiversity.ratingLegend');

        parent::__construct($attributes);
    }

    /**
     * Inject additional predefined values (last 3 groups) retrieved from CTX
     */
    protected static function getPredefined($form_id = null): array
    {
        $predefined_values = $form_id!==null
            ? [
                'group0' => Modules\Context\AnimalSpecies::getReferenceList($form_id, 'species'),
                'group1' => Modules\Context\VegetalSpecies::getReferenceList($form_id, 'species'),
                'group2' => Modules\Context\Habitats::getReferenceList($form_id, 'EcosystemType')
            ]
            : [];

        return [
            'field' => static::$DEPENDENCY_ON,
            'values' => $predefined_values
        ];
    }

    /**
     * Override: ensure to removed dropped items
     * @throws MissingDependencyConfigurationException
     */
    protected static function arrange_records_with_predefined($form_id, $records, $empty_record): array
    {
        $predefined_values = static::getPredefined($form_id);
        $records = static::arrange_records($predefined_values, $records, $empty_record);

        // Ensure to removed dropped items
        foreach ($records as $record){
            if(!in_array($record[static::$DEPENDENCY_ON], $predefined_values['values'][$record['group_key']])){
                static::dropOrphansDependencyRecords($form_id, [$record[static::$DEPENDENCY_ON]]);
            }
        }

        return $records;
    }


    /**
     * Calculate threat's ranking
     *
     * @param $form_id
     * @param $records
     * @return array
     */
    public static function calculateRanking($form_id, $records = null): array
    {
        $records = $records ?? static::getModuleRecords($form_id)['records'];

        return ThreatsService::calculateRanking($records);
    }


}