<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context;

use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ModularForms\Helpers\Input\SelectionList;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;

class Governance extends Modules\Component\ImetModule
{
    protected $table = 'context_governance';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_LOW;

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'ACCORDION';
        $this->module_code = 'CTX 1.2';
        $this->module_title = trans('imet-core::v2_context.Governance.title');
        $this->module_fields = [
            ['name' => 'Partner',               'type' => 'text-area',         'label' => trans('imet-core::v2_context.Governance.fields.Partner'),            'other' => 'style="width:200px"'],
            ['name' => 'InstitutionType',       'type' => 'dropdown-ImetV2_InstitutionType',      'label' => trans('imet-core::v2_context.Governance.fields.InstitutionType'),    'other' => 'style="width:205px"'],
            ['name' => 'PartnershipsType1',     'type' => 'dropdown-ImetV2_PartnershipsType',     'label' => trans('imet-core::v2_context.Governance.fields.PartnershipsType1'),  'other' => 'style="width:205px"'],
            ['name' => 'PartnershipsType2',     'type' => 'dropdown-ImetV2_PartnershipsType',     'label' => trans('imet-core::v2_context.Governance.fields.PartnershipsType2'),  'other' => 'style="width:205px"'],
            ['name' => 'PartnershipsType3',     'type' => 'dropdown-ImetV2_PartnershipsType',     'label' => trans('imet-core::v2_context.Governance.fields.PartnershipsType3'),  'other' => 'style="width:205px"'],
        ];

        $this->module_common_fields = [
            ['name' => 'Type',      'type' => 'suggestion_multiple-ImetV2_GovernanceType',   'label' => trans('imet-core::v2_context.Governance.fields.Type')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.Governance.fields.Comments')],
        ];

        parent::__construct($attributes);
    }

    public static function upgradeModule($record, $imet_version = null)
    {
        // #### not in predefined lists ####
        $record['InstitutionType'] = static::dropIfValueNotInPredefinedList($record['InstitutionType'], 'InstitutionType');
        $record['PartnershipsType1'] = static::dropIfValueNotInPredefinedList($record['PartnershipsType1'], 'PartnershipsType');
        $record['PartnershipsType2'] = static::dropIfValueNotInPredefinedList($record['PartnershipsType2'], 'PartnershipsType');
        $record['PartnershipsType3'] = static::dropIfValueNotInPredefinedList($record['PartnershipsType3'], 'PartnershipsType');
        $record['Type'] = static::dropIfValueNotInPredefinedList($record['Type'], 'GovernanceType');

        return $record;
    }

}
