<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;

class ManagementStaffCommunities extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_management_staff_communities';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 3.1.3';
        $this->module_title = trans('imet-core::v2_context.ManagementStaffCommunities.title');
        $this->module_fields = [
            ['name' => 'Community',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.ManagementStaffCommunities.fields.Community')],
            ['name' => 'Role1',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.ManagementStaffCommunities.fields.Role1')],
            ['name' => 'StaffNUmberRole1',  'type' => 'integer',   'label' => trans('imet-core::v2_context.ManagementStaffCommunities.fields.StaffNUmberRole1')],
        ];

        parent::__construct($attributes);
    }

//    public static function convert_v1_to_v2($record)
//    {
//        // ####  v1 -> v2  ####
//        $upgraded_records = [];
//
//        foreach ($records as $i => $record) {
//            $upgraded_records[] = [
//                'Community' => $record['Community'],
//                'Role1' => $record['Role1'],
//                'StaffNUmberRole1' => $record['StaffNUmberRole1'],
//                'UpdateDate' => $record['UpdateDate'],
//                'UpdateBy' => $record['UpdateBy'],
//            ];
//            $upgraded_records[] = [
//                'Community' => $record['Community'],
//                'Role1' => $record['Role2'],
//                'StaffNUmberRole1' => $record['StaffNUmberRole2'],
//                'UpdateDate' => $record['UpdateDate'],
//                'UpdateBy' => $record['UpdateBy'],
//            ];
//            $upgraded_records[] = [
//                'Community' => $record['Community'],
//                'Role1' => $record['Role3'],
//                'StaffNUmberRole1' => $record['StaffNUmberRole3'],
//                'UpdateDate' => $record['UpdateDate'],
//                'UpdateBy' => $record['UpdateBy'],
//            ];
//        }
//
//        return $upgraded_records;
//    }

}
