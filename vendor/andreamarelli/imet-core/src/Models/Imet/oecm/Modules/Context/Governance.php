<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context;

use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;

class Governance extends Modules\Component\ImetModule
{
    protected $table = 'imet_oecm.context_governance';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_LOW;

    public function __construct(array $attributes = [])
    {
        $this->module_type = 'SIMPLE';
        $this->module_code = 'CTX 1.2';
        $this->module_title = trans('imet-core::oecm_context.Governance.title');

        $this->module_fields = [
            ['name' => 'GovernanceModel',   'type' => 'dropdown-ImetOECM_GovernanceModel',   'label' => trans('imet-core::oecm_context.Governance.fields.GovernanceModel')],
            ['name' => 'AdditionalInfo',    'type' => 'text',   'label' => trans('imet-core::oecm_context.Governance.fields.AdditionalInfo')],

            ['name' => 'ManagementUnique',  'type' => 'toggle-ImetOECM_ManagementUnique',         'label' => trans('imet-core::oecm_context.Governance.fields.ManagementUnique')],
            ['name' => 'ManagementName',    'type' => 'text-area',      'label' => trans('imet-core::oecm_context.Governance.fields.ManagementName')],
            ['name' => 'ManagementType',    'type' => 'dropdown-ImetOECM_ManagementType',     'label' => trans('imet-core::oecm_context.Governance.fields.ManagementType')],
            ['name' => 'ManagementList',    'type' => 'text-area',      'label' => trans('imet-core::oecm_context.Governance.fields.ManagementList')],
            ['name' => 'DateOfCreation',    'type' => 'suggestion-ImetOECM_DateOfCreation',     'label' => trans('imet-core::oecm_context.Governance.fields.DateOfCreation')],
            ['name' => 'OfficialRecognition',   'type' => 'toggle-yes_no',   'label' => trans('imet-core::oecm_context.Governance.fields.OfficialRecognition')],
            ['name' => 'SupervisoryInstitution','type' => 'text-area',          'label' => trans('imet-core::oecm_context.Governance.fields.SupervisoryInstitution')],
        ];

        parent::__construct($attributes);
    }
}
