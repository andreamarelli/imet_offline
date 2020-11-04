<?php

namespace App\Models\Imet\v1\Modules\Context;

use App\Models\Imet\v1\Modules;

class ManagementStaff extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_management_staff';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 3.1.1';
        $this->module_title = trans('form/imet/v1/context.ManagementStaff.title');
        $this->module_fields = [
            ['name' => 'Function',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.ManagementStaff.fields.Function')],
            ['name' => 'ExpectedPermanent',  'type' => 'integer',   'label' => trans('form/imet/v1/context.ManagementStaff.fields.ExpectedPermanent')],
            ['name' => 'ActualPermanent',  'type' => 'integer',   'label' => trans('form/imet/v1/context.ManagementStaff.fields.ActualPermanent')],
            ['name' => 'Observations',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.ManagementStaff.fields.Observations')],
        ];

        $this->module_common_fields = [
            ['name' => 'Source',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.ManagementStaff.fields.Source')],
        ];

        $this->max_rows = 14;

        $this->module_info = trans('form/imet/v1/context.ManagementStaff.module_info');

        parent::__construct($attributes);

    }
}