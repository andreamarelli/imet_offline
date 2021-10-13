<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;

class TerritorialReferenceContext extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_territorial_reference_context';

    public function __construct(array $attributes = []) {

        $this->module_type = 'SIMPLE';
        $this->module_code = 'CTX 2.5';
        $this->module_title = trans('imet-core::v1_context.TerritorialReferenceContext.title');
        $this->module_fields = [
            ['name' => 'ReferenceEcosystemAreaEstimation',  'type' => 'integer',   'label' => trans('imet-core::v1_context.TerritorialReferenceContext.fields.ReferenceEcosystemAreaEstimation')],
            ['name' => 'ReferenceEcosystemAreaPopulation',  'type' => 'integer',   'label' => trans('imet-core::v1_context.TerritorialReferenceContext.fields.ReferenceEcosystemAreaPopulation')],
            ['name' => 'EcologicalAspects',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.TerritorialReferenceContext.fields.EcologicalAspects')],
            ['name' => 'FunctionalArea',  'type' => 'integer',   'label' => trans('imet-core::v1_context.TerritorialReferenceContext.fields.FunctionalArea')],

            ['name' => 'FunctionalAreaPopulation',  'type' => 'integer',   'label' => trans('imet-core::v1_context.TerritorialReferenceContext.fields.FunctionalAreaPopulation')],
            ['name' => 'SocioEconomicAspects',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.TerritorialReferenceContext.fields.SocioEconomicAspects')],
            ['name' => 'SpillOverEffect',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.TerritorialReferenceContext.fields.SpillOverEffect')],
        ];

        parent::__construct($attributes);

    }
}
