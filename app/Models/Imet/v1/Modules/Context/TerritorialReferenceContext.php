<?php

namespace App\Models\Imet\v1\Modules\Context;

use App\Models\Imet\v1\Modules;

class TerritorialReferenceContext extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_territorial_reference_context';

    public function __construct(array $attributes = []) {

        $this->module_type = 'SIMPLE';
        $this->module_code = 'CTX 2.5';
        $this->module_title = trans('form/imet/v1/context.TerritorialReferenceContext.title');
        $this->module_fields = [
            ['name' => 'ReferenceEcosystemAreaEstimation',  'type' => 'integer',   'label' => trans('form/imet/v1/context.TerritorialReferenceContext.fields.ReferenceEcosystemAreaEstimation')],
            ['name' => 'ReferenceEcosystemAreaPopulation',  'type' => 'integer',   'label' => trans('form/imet/v1/context.TerritorialReferenceContext.fields.ReferenceEcosystemAreaPopulation')],
            ['name' => 'EcologicalAspects',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.TerritorialReferenceContext.fields.EcologicalAspects')],
            ['name' => 'FunctionalArea',  'type' => 'integer',   'label' => trans('form/imet/v1/context.TerritorialReferenceContext.fields.FunctionalArea')],

            ['name' => 'FunctionalAreaPopulation',  'type' => 'integer',   'label' => trans('form/imet/v1/context.TerritorialReferenceContext.fields.FunctionalAreaPopulation')],
            ['name' => 'SocioEconomicAspects',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.TerritorialReferenceContext.fields.SocioEconomicAspects')],
            ['name' => 'SpillOverEffect',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.TerritorialReferenceContext.fields.SpillOverEffect')],
        ];

        parent::__construct($attributes);

    }
}