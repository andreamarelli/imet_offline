<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;

class Governance extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_governance';

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'ACCORDION';
        $this->module_code = 'CTX 1.2';
        $this->module_title = trans('imet-core::v1_context.Governance.title');
        $this->module_fields = [
            ['name' => 'Partner',               'type' => 'text-area',         'label' => trans('imet-core::v1_context.Governance.fields.Partner'),            'other' => 'style="width:200px"'],
            ['name' => 'InstitutionType',       'type' => 'dropdown-ImetV1_InstitutionType',      'label' => trans('imet-core::v1_context.Governance.fields.InstitutionType'),    'other' => 'style="width:205px"'],
            ['name' => 'PartnershipsType1',     'type' => 'dropdown-ImetV1_PartnershipsType',     'label' => trans('imet-core::v1_context.Governance.fields.PartnershipsType1'),  'other' => 'style="width:205px"'],
            ['name' => 'PartnershipsType2',     'type' => 'dropdown-ImetV1_PartnershipsType',     'label' => trans('imet-core::v1_context.Governance.fields.PartnershipsType2'),  'other' => 'style="width:205px"'],
            ['name' => 'PartnershipsType3',     'type' => 'dropdown-ImetV1_PartnershipsType',     'label' => trans('imet-core::v1_context.Governance.fields.PartnershipsType3'),  'other' => 'style="width:205px"'],
        ];

        $this->module_common_fields = [
            ['name' => 'Type',      'type' => 'dropdown-ImetV1_GovernanceType',   'label' => trans('imet-core::v1_context.Governance.fields.Type')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.Governance.fields.Comments')],
        ];

        parent::__construct($attributes);
    }

    /**
     * Set parameter required to convert OLD SQLite IMETs
     *
     * @return array
     */
    protected static function conversionParameters(): array
    {
        return [
            'table' => 'Governance',
            'fields' => [
                'Partner','InstitutionType','PartnershipsType1','PartnershipsType2','PartnershipsType3', 'Type', 'Comments'
            ]
        ];
    }
}
