<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class SpecialStatus extends Modules\Component\ImetModule
{
    protected $table = 'context_special_status';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_LOW;

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_ACCORDION';
        $this->module_code = 'CTX 1.3';
        $this->module_title = trans('imet-core::v1_context.SpecialStatus.title');
        $this->module_fields = [
            ['name' => 'Designation',           'type' => 'suggestion-ImetV1_Designation',   'label' => trans('imet-core::v1_context.SpecialStatus.fields.Designation')],
            ['name' => 'RegistrationDate',      'type' => 'date',   'label' => trans('imet-core::v1_context.SpecialStatus.fields.RegistrationDate')],
            ['name' => 'Code',                  'type' => 'text-area',   'label' => trans('imet-core::v1_context.SpecialStatus.fields.Code')],
            ['name' => 'Area',                  'type' => 'integer',   'label' => trans('imet-core::v1_context.SpecialStatus.fields.Area')],
            ['name' => 'DesignationCriteria',   'type' => 'text-area',   'label' => trans('imet-core::v1_context.SpecialStatus.fields.DesignationCriteria')],
            ['name' => 'upload',                'type' => 'upload',   'label' => trans('imet-core::v1_context.SpecialStatus.fields.upload')],
        ];

        $this->module_groups = [
            'conventions'   => trans('imet-core::v1_context.SpecialStatus.groups.conventions'),
            'networks'      => trans('imet-core::v1_context.SpecialStatus.groups.networks'),
            'conservation'  => trans('imet-core::v1_context.SpecialStatus.groups.conservation'),
            'marine_pa'     => trans('imet-core::v1_context.SpecialStatus.groups.marine_pa'),
        ];

        $this->module_info = trans('imet-core::v1_context.SpecialStatus.module_info');


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
            'table' => 'SpecialStatus',
            'fields' => [
                'Designation', 'RegistrationDate', 'Code', 'Area', 'DesignationCriteria', 'upload', 'DesignationGroup'
            ]
        ];
    }

    /**
     * Review data from SQLITE
     *
     * @param $record
     * @param $sqlite_connection
     * @return array
     */
    protected static function conversionDataReview($record, $sqlite_connection): array
    {
        return static::convertGroupLabelToKey($record, 'DesignationGroup');
    }

}
