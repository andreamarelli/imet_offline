<?php

namespace App\Models\Imet\v1\Modules\Context;

use App\Models\Imet\v1\Modules;

class Networks extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_networks';

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'CTX 1.4';
        $this->module_title = trans('form/imet/v1/context.Networks.title');
        $this->module_fields = [
            ['name' => 'NetworkName',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.Networks.fields.NetworkName')],
            ['name' => 'ProtectedAreas',  'type' => 'dropdown_multiple-ImetV1_ProtectedArea',   'label' => trans('form/imet/v1/context.Networks.fields.ProtectedAreas')],
        ];

        $this->module_groups = [
            'group0' => trans('form/imet/v1/context.Networks.groups.group0'),
            'group1' => trans('form/imet/v1/context.Networks.groups.group1'),
            'group2' => trans('form/imet/v1/context.Networks.groups.group2'),
        ];

        parent::__construct($attributes);

    }
}