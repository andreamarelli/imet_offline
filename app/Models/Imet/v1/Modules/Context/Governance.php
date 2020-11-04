<?php

namespace App\Models\Imet\v1\Modules\Context;

use App\Models\Imet\v1\Modules;

class Governance extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_governance';

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'ACCORDION';
        $this->module_code = 'CTX 1.2';
        $this->module_title = trans('form/imet/v1/context.Governance.title');
        $this->module_fields = [
            ['name' => 'Partner',               'type' => 'text-area',         'label' => trans('form/imet/v1/context.Governance.fields.Partner'),            'other' => 'style="width:200px"'],
            ['name' => 'InstitutionType',       'type' => 'dropdown-ImetV1_InstitutionType',      'label' => trans('form/imet/v1/context.Governance.fields.InstitutionType'),    'other' => 'style="width:205px"'],
            ['name' => 'PartnershipsType1',     'type' => 'dropdown-ImetV1_PartnershipsType',     'label' => trans('form/imet/v1/context.Governance.fields.PartnershipsType1'),  'other' => 'style="width:205px"'],
            ['name' => 'PartnershipsType2',     'type' => 'dropdown-ImetV1_PartnershipsType',     'label' => trans('form/imet/v1/context.Governance.fields.PartnershipsType2'),  'other' => 'style="width:205px"'],
            ['name' => 'PartnershipsType3',     'type' => 'dropdown-ImetV1_PartnershipsType',     'label' => trans('form/imet/v1/context.Governance.fields.PartnershipsType3'),  'other' => 'style="width:205px"'],
        ];

        $this->module_common_fields = [
            ['name' => 'Type',      'type' => 'dropdown-ImetV1_GovernanceType',   'label' => trans('form/imet/v1/context.Governance.fields.Type')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.Governance.fields.Comments')],
        ];

        parent::__construct($attributes);
    }

}