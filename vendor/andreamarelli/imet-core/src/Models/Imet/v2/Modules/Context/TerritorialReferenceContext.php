<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class TerritorialReferenceContext extends Modules\Component\ImetModule
{
    protected $table = 'context_territorial_reference_context';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_LOW;

    public function __construct(array $attributes = []) {

        $this->module_type = 'SIMPLE';
        $this->module_code = 'CTX 2.4';
        $this->module_title = trans('imet-core::v2_context.TerritorialReferenceContext.title');
        $this->module_fields = [
            ['name' => 'FunctionalHasNoTakeArea',  'type' => 'toggle-yes_no',   'label' => trans('imet-core::v2_context.TerritorialReferenceContext.fields.FunctionalHasNoTakeArea')],
            ['name' => 'FunctionalKm2',  'type' => 'numeric',   'label' => ''],
            ['name' => 'FunctionalKm',  'type' => 'numeric',   'label' => ''],
            ['name' => 'FunctionalPopulation',  'type' => 'numeric',   'label' => trans('imet-core::v2_context.TerritorialReferenceContext.fields.FunctionalPopulation')],
            ['name' => 'BenefitKm2',  'type' => 'numeric',   'label' => ''],
            ['name' => 'BenefitKm',  'type' => 'numeric',   'label' => ''],
            ['name' => 'BenefitPopulation',  'type' => 'numeric',   'label' => trans('imet-core::v2_context.TerritorialReferenceContext.fields.BenefitPopulation')],
            ['name' => 'BenefitSocioEconomicAspects',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.TerritorialReferenceContext.fields.BenefitSocioEconomicAspects')],
            ['name' => 'SpillOverKm2',  'type' => 'numeric',   'label' => ''],
            ['name' => 'SpillOverKm',  'type' => 'numeric',   'label' => ''],
            ['name' => 'SpillOverEvalPredatory0_500', 'type' => 'imet-core::rating-Minus2to0', 'label' => trans('imet-core::v2_context.TerritorialReferenceContext.info.spill_over_variation')],
            ['name' => 'SpillOverEvalPredatory500_1000', 'type' => 'imet-core::rating-Minus2to0', 'label' => ''],
            ['name' => 'SpillOverEvalPredatory200_3000', 'type' => 'imet-core::rating-Minus2to0', 'label' => ''],
            ['name' => 'SpillOverEvalComposition0_500', 'type' => 'imet-core::rating-Minus2to0', 'label' => ''],
            ['name' => 'SpillOverEvalComposition500_1000', 'type' => 'imet-core::rating-Minus2to0', 'label' => ''],
            ['name' => 'SpillOverEvalComposition200_3000', 'type' => 'imet-core::rating-Minus2to0', 'label' => ''],
            ['name' => 'SpillOverEvalDistance0_500', 'type' => 'imet-core::rating-Minus2to0', 'label' => ''],
            ['name' => 'SpillOverEvalDistance500_1000', 'type' => 'imet-core::rating-Minus2to0', 'label' => ''],
            ['name' => 'SpillOverEvalDistance200_3000', 'type' => 'imet-core::rating-Minus2to0', 'label' => '']
        ];

        $this->module_info = trans('imet-core::v2_context.TerritorialReferenceContext.module_info');
        $this->ratingLegend = trans('imet-core::v2_context.TerritorialReferenceContext.ratingLegend');

        parent::__construct($attributes);
    }


    public static function upgradeModule($record, $imet_version = null)
    {
        // ####  v2.2 -> v2.3 ####
        $record = static::addField($record, 'FunctionalHasNoTakeArea');
        $record = static::renameField($record, 'ReferenceEcosystemAreaEstimation', 'FunctionalKm2');
        $record = static::addField($record, 'FunctionalKm');
        $record = static::renameField($record, 'ReferenceEcosystemAreaPopulation', 'FunctionalPopulation');
        $record = static::renameField($record, 'FunctionalArea', 'BenefitKm2');
        $record = static::addField($record, 'BenefitKm');
        $record = static::addField($record, 'BenefitPopulation');
        $record = static::renameField($record, 'SocioEconomicAspects', 'BenefitSocioEconomicAspects');
        $record = static::addField($record, 'SpillOverKm2');
        $record = static::addField($record, 'SpillOverKm');

        return $record;
    }

}
