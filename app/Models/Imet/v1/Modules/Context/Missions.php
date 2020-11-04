<?php

namespace App\Models\Imet\v1\Modules\Context;

use App\Models\Imet\v1\Modules;

class Missions extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_missions';

    public function __construct(array $attributes = []) {

        $this->module_type = 'SIMPLE';
        $this->module_code = 'CTX 1.5';
        $this->module_title = trans('form/imet/v1/context.Missions.title');
        $this->module_fields = [
            ['name' => 'LocalVision',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.Missions.fields.LocalVision')],
            ['name' => 'LocalMission',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.Missions.fields.LocalMission')],
            ['name' => 'LocalObjective',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.Missions.fields.LocalObjective')],
            ['name' => 'LocalSource',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.Missions.fields.LocalSource')],
            ['name' => 'LocalManagementPlan',  'type' => 'upload',   'label' => trans('form/imet/v1/context.Missions.fields.LocalManagementPlan')],
            ['name' => 'InternationalVision',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.Missions.fields.InternationalVision')],
            ['name' => 'InternationalMission',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.Missions.fields.InternationalMission')],
            ['name' => 'InternationalObjective',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.Missions.fields.InternationalObjective')],
            ['name' => 'InternationalSource',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.Missions.fields.InternationalSource')],
            ['name' => 'InternationalManagementPlan',  'type' => 'upload',   'label' => trans('form/imet/v1/context.Missions.fields.InternationalManagementPlan')],
            ['name' => 'Observation',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.Missions.fields.Observation')],
        ];



        parent::__construct($attributes);

    }
}