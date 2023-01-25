<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class Missions extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_missions';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_LOW;

    public function __construct(array $attributes = []) {

        $this->module_type = 'SIMPLE';
        $this->module_code = 'CTX 1.5';
        $this->module_title = trans('imet-core::v2_context.Missions.title');
        $this->module_fields = [
            ['name' => 'LocalVision',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.Missions.fields.LocalVision')],
            ['name' => 'LocalMission',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.Missions.fields.LocalMission')],
            ['name' => 'LocalObjective',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.Missions.fields.LocalObjective')],
            ['name' => 'LocalSource',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.Missions.fields.LocalSource')],
            ['name' => 'LocalManagementPlan',  'type' => 'upload',   'label' => trans('imet-core::v2_context.Missions.fields.LocalManagementPlan')],
            ['name' => 'InternationalVision',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.Missions.fields.InternationalVision')],
            ['name' => 'InternationalMission',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.Missions.fields.InternationalMission')],
            ['name' => 'InternationalObjective',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.Missions.fields.InternationalObjective')],
            ['name' => 'InternationalSource',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.Missions.fields.InternationalSource')],
            ['name' => 'InternationalManagementPlan',  'type' => 'upload',   'label' => trans('imet-core::v2_context.Missions.fields.InternationalManagementPlan')],
            ['name' => 'Observation',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.Missions.fields.Observation')],
        ];



        parent::__construct($attributes);

    }
}
