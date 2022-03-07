<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;

class ManagementStaff extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_management_staff';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 3.1.1';
        $this->module_title = trans('imet-core::v1_context.ManagementStaff.title');
        $this->module_fields = [
            ['name' => 'Function',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.ManagementStaff.fields.Function')],
            ['name' => 'ExpectedPermanent',  'type' => 'integer',   'label' => trans('imet-core::v1_context.ManagementStaff.fields.ExpectedPermanent')],
            ['name' => 'ActualPermanent',  'type' => 'integer',   'label' => trans('imet-core::v1_context.ManagementStaff.fields.ActualPermanent')],
            ['name' => 'Observations',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.ManagementStaff.fields.Observations')],
        ];

        $this->module_common_fields = [
            ['name' => 'Source',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.ManagementStaff.fields.Source')],
        ];

        $this->max_rows = 14;

        $this->module_info = trans('imet-core::v1_context.ManagementStaff.module_info');

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
            'table' => 'ManagementStaff',
            'fields' => [
                'Function',  'ExpectedPermanent', 'ActualPermanent', 'Observations', 'Source'
            ]
        ];
    }
}
