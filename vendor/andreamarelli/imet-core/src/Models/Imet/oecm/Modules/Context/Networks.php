<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context;

use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;

class Networks extends Modules\Component\ImetModule
{
    protected $table = 'imet_oecm.context_networks';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_LOW;

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'CTX 1.4';
        $this->module_title = trans('imet-core::oecm_context.Networks.title');
        $this->module_fields = [
            ['name' => 'NetworkName',  'type' => 'text-area',   'label' => trans('imet-core::oecm_context.Networks.fields.NetworkName')],
            ['name' => 'ProtectedAreas',  'type' => 'imet-core::selector-wdpa_multiple',   'label' => trans('imet-core::oecm_context.Networks.fields.ProtectedAreas')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::oecm_context.Networks.groups.group0'),
            'group1' => trans('imet-core::oecm_context.Networks.groups.group1'),
            'group2' => trans('imet-core::oecm_context.Networks.groups.group2'),
        ];

        parent::__construct($attributes);
    }

}
