<?php

namespace App\Models\Imet\v1\Modules\Context;

use App\Models\Imet\v1\Modules;

class SpecialStatus extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_special_status';

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_ACCORDION';
        $this->module_code = 'CTX 1.3';
        $this->module_title = trans('form/imet/v1/context.SpecialStatus.title');
        $this->module_fields = [
            ['name' => 'Designation',           'type' => 'suggestion-ImetV1_Designation',   'label' => trans('form/imet/v1/context.SpecialStatus.fields.Designation')],
            ['name' => 'RegistrationDate',      'type' => 'date',   'label' => trans('form/imet/v1/context.SpecialStatus.fields.RegistrationDate')],
            ['name' => 'Code',                  'type' => 'text-area',   'label' => trans('form/imet/v1/context.SpecialStatus.fields.Code')],
            ['name' => 'Area',                  'type' => 'integer',   'label' => trans('form/imet/v1/context.SpecialStatus.fields.Area')],
            ['name' => 'DesignationCriteria',   'type' => 'text-area',   'label' => trans('form/imet/v1/context.SpecialStatus.fields.DesignationCriteria')],
            ['name' => 'upload',                'type' => 'upload',   'label' => trans('form/imet/v1/context.SpecialStatus.fields.upload')],
        ];

        $this->module_groups = [
            'conventions'   => trans('form/imet/v1/context.SpecialStatus.groups.conventions'),
            'networks'      => trans('form/imet/v1/context.SpecialStatus.groups.networks'),
            'conservation'  => trans('form/imet/v1/context.SpecialStatus.groups.conservation'),
            'marine_pa'     => trans('form/imet/v1/context.SpecialStatus.groups.marine_pa'),
        ];

        $this->module_info = trans('form/imet/v1/context.SpecialStatus.module_info');


        parent::__construct($attributes);

    }
}
