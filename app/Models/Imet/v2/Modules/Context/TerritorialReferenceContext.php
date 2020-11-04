<?php

namespace App\Models\Imet\v2\Modules\Context;

use App\Models\Imet\v2\Modules;

class TerritorialReferenceContext extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_territorial_reference_context';

    public function __construct(array $attributes = []) {

        $this->module_type = 'SIMPLE';
        $this->module_code = 'CTX 2.4';
        $this->module_title = trans('form/imet/v2/context.TerritorialReferenceContext.title');
        $this->module_fields = [
            ['name' => 'ReferenceEcosystemAreaEstimation',  'type' => 'numeric',   'label' => trans('form/imet/v2/context.TerritorialReferenceContext.fields.ReferenceEcosystemAreaEstimation')],
            ['name' => 'ReferenceEcosystemAreaPopulation',  'type' => 'numeric',   'label' => trans('form/imet/v2/context.TerritorialReferenceContext.fields.ReferenceEcosystemAreaPopulation')],
            ['name' => 'EcologicalAspects',  'type' => 'text-area',   'label' => trans('form/imet/v2/context.TerritorialReferenceContext.fields.EcologicalAspects')],
            ['name' => 'FunctionalArea',  'type' => 'numeric',   'label' => trans('form/imet/v2/context.TerritorialReferenceContext.fields.FunctionalArea')],
            ['name' => 'NoTakeArea',  'type' => 'toggle-yes_no',   'label' => trans('form/imet/v2/context.TerritorialReferenceContext.fields.NoTakeArea')],       
            ['name' => 'FunctionalAreaPopulation',  'type' => 'numeric',   'label' => trans('form/imet/v2/context.TerritorialReferenceContext.fields.FunctionalAreaPopulation')],
            ['name' => 'SocioEconomicAspects',  'type' => 'text-area',   'label' => trans('form/imet/v2/context.TerritorialReferenceContext.fields.SocioEconomicAspects')],
            ['name' => 'SpillOverEffect',  'type' => 'text-area',   'label' => trans('form/imet/v2/context.TerritorialReferenceContext.fields.SpillOverEffect')],
        ];

        parent::__construct($attributes);
    }

    public static function upgradeModule($record, $v1_to_v2 = false, $imet_version = null, $db_version = null)
    {
        // ####  v1 -> v2  ####
        if($v1_to_v2) {
            $record = static::addField($record, 'NoTakeArea');
        }

        return $record;
    }

}