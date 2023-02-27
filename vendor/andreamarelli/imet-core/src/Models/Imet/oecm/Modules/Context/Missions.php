<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context;

use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;

class Missions extends Modules\Component\ImetModule
{
    protected $table = 'imet_oecm.context_missions';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_LOW;

    public function __construct(array $attributes = []) {

        $this->module_type = 'SIMPLE';
        $this->module_code = 'CTX 1.5';
        $this->module_title = trans('imet-core::oecm_context.Missions.title');
        $this->module_fields = [
            ['name' => 'LocalVision',  'type' => 'text-area',   'label' => trans('imet-core::oecm_context.Missions.fields.LocalVision')],
            ['name' => 'LocalMission',  'type' => 'text-area',   'label' => trans('imet-core::oecm_context.Missions.fields.LocalMission')],
            ['name' => 'LocalObjective',  'type' => 'text-area',   'label' => trans('imet-core::oecm_context.Missions.fields.LocalObjective')],
            ['name' => 'LocalSource',  'type' => 'text-area',   'label' => trans('imet-core::oecm_context.Missions.fields.LocalSource')],
            ['name' => 'Observation',  'type' => 'text-area',   'label' => trans('imet-core::oecm_context.Missions.fields.Observation')],
        ];



        parent::__construct($attributes);

    }
}
