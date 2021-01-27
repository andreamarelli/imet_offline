<?php

namespace App\Models\Imet\v2\Modules\Context;

use App\Library\Ofac\Input\SelectionList;
use App\Models\Imet\v2\Modules;

class Governance extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_governance';

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'ACCORDION';
        $this->module_code = 'CTX 1.2';
        $this->module_title = trans('form/imet/v2/context.Governance.title');
        $this->module_fields = [
            ['name' => 'Partner',               'type' => 'text-area',         'label' => trans('form/imet/v2/context.Governance.fields.Partner'),            'other' => 'style="width:200px"'],
            ['name' => 'InstitutionType',       'type' => 'dropdown-ImetV2_InstitutionType',      'label' => trans('form/imet/v2/context.Governance.fields.InstitutionType'),    'other' => 'style="width:205px"'],
            ['name' => 'PartnershipsType1',     'type' => 'dropdown-ImetV2_PartnershipsType',     'label' => trans('form/imet/v2/context.Governance.fields.PartnershipsType1'),  'other' => 'style="width:205px"'],
            ['name' => 'PartnershipsType2',     'type' => 'dropdown-ImetV2_PartnershipsType',     'label' => trans('form/imet/v2/context.Governance.fields.PartnershipsType2'),  'other' => 'style="width:205px"'],
            ['name' => 'PartnershipsType3',     'type' => 'dropdown-ImetV2_PartnershipsType',     'label' => trans('form/imet/v2/context.Governance.fields.PartnershipsType3'),  'other' => 'style="width:205px"'],
        ];

        $this->module_common_fields = [
            ['name' => 'Type',      'type' => 'dropdown-ImetV2_GovernanceType',   'label' => trans('form/imet/v2/context.Governance.fields.Type')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('form/imet/v2/context.Governance.fields.Comments')],
        ];

        parent::__construct($attributes);
    }

    public static function upgradeModule($record, $v1_to_v2 = false, $imet_version = null)
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
