<?php

namespace App\Models\Imet\v2\Modules\Context;

use App\Models\Imet\v2\Modules;

class SpecialStatus extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_special_status';

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_ACCORDION';
        $this->module_code = 'CTX 1.3';
        $this->module_title = trans('form/imet/v2/context.SpecialStatus.title');
        $this->module_fields = [
            ['name' => 'Designation',           'type' => 'suggestion-ImetV2_Designation',   'label' => trans('form/imet/v2/context.SpecialStatus.fields.Designation')],
            ['name' => 'RegistrationDate',      'type' => 'dateMaxToday',   'label' => trans('form/imet/v2/context.SpecialStatus.fields.RegistrationDate')],
            ['name' => 'Code',                  'type' => 'text-area',   'label' => trans('form/imet/v2/context.SpecialStatus.fields.Code')],
            ['name' => 'Area',                  'type' => 'numeric',   'label' => trans('form/imet/v2/context.SpecialStatus.fields.Area')],
            ['name' => 'DesignationCriteria',   'type' => 'text-area',   'label' => trans('form/imet/v2/context.SpecialStatus.fields.DesignationCriteria')],
            ['name' => 'upload',                'type' => 'upload',   'label' => trans('form/imet/v2/context.SpecialStatus.fields.upload')],
        ];

        $this->module_groups = [
            'conventions'   => trans('form/imet/v2/context.SpecialStatus.groups.conventions'),
            'networks'      => trans('form/imet/v2/context.SpecialStatus.groups.networks'),
            'conservation'  => trans('form/imet/v2/context.SpecialStatus.groups.conservation'),
            'marine_pa'     => trans('form/imet/v2/context.SpecialStatus.groups.marine_pa'),
        ];

        parent::__construct($attributes);

    }
}
