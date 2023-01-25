<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class TerritorialReferenceContext extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_territorial_reference_context';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_LOW;

    public function __construct(array $attributes = []) {

        $this->module_type = 'SIMPLE';
        $this->module_code = 'CTX 2.5';
        $this->module_title = trans('imet-core::v1_context.TerritorialReferenceContext.title');
        $this->module_fields = [
            ['name' => 'FunctionalKm2',  'type' => 'integer',   'label' => trans('imet-core::v1_context.TerritorialReferenceContext.fields.ReferenceEcosystemAreaEstimation')],
            ['name' => 'FunctionalPopulation',  'type' => 'integer',   'label' => trans('imet-core::v1_context.TerritorialReferenceContext.fields.ReferenceEcosystemAreaPopulation')],
            ['name' => 'EcologicalAspects',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.TerritorialReferenceContext.fields.EcologicalAspects')],
            ['name' => 'BenefitKm2',  'type' => 'integer',   'label' => trans('imet-core::v1_context.TerritorialReferenceContext.fields.FunctionalArea')],

            ['name' => 'FunctionalAreaPopulation',  'type' => 'integer',   'label' => trans('imet-core::v1_context.TerritorialReferenceContext.fields.FunctionalAreaPopulation')],
            ['name' => 'BenefitSocioEconomicAspects',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.TerritorialReferenceContext.fields.SocioEconomicAspects')],
            ['name' => 'SpillOverEffect',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.TerritorialReferenceContext.fields.SpillOverEffect')],
        ];

        parent::__construct($attributes);

    }


    public static function upgradeModule($record, $imet_version = null)
    {
        $record = static::renameField($record, 'ReferenceEcosystemAreaEstimation', 'FunctionalKm2');
        $record = static::renameField($record, 'ReferenceEcosystemAreaPopulation', 'FunctionalPopulation');
        $record = static::renameField($record, 'FunctionalArea', 'BenefitKm2');
        $record = static::renameField($record, 'SocioEconomicAspects', 'BenefitSocioEconomicAspects');

        return $record;
    }

    /**
     * Set parameter required to convert OLD SQLite IMETs
     *
     * @return array
     */
    protected static function conversionParameters(): array
    {
        return [
            'table' => 'TerritorialReferenceContext',
            'fields' => [
                'ReferenceEcosystemAreaEstimation', 'ReferenceEcosystemAreaPopulation', 'EcologicalAspects', 'FunctionalArea',
                 'FunctionalAreaPopulation', 'SocioEconomicAspects', 'SpillOverEffect'
            ]
        ];
    }
}
