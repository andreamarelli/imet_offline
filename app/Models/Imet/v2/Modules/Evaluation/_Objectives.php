<?php

namespace App\Models\Imet\v2\Modules\Evaluation;

use App\Models\Imet\v2\Modules;

class _Objectives extends Modules\Component\ImetModule
{

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_title = trans('form/imet/v2/evaluation._Objectives.title');
        $this->module_fields = [
            ['name' => 'Element',  'type' => 'text-area',   'label' => trans('form/imet/v2/evaluation._Objectives.fields.Element')],
            ['name' => 'Status',  'type' => 'text-area',   'label' => trans('form/imet/v2/evaluation._Objectives.fields.Status')],
            ['name' => 'Objective',  'type' => 'text-area',   'label' => trans('form/imet/v2/evaluation._Objectives.fields.Objective')],
        ];

        $this->module_common_fields = [
            ['name' => 'comments',  'type' => 'text-area',   'label' => trans('form/imet/v2/evaluation._Objectives.fields.comments')],
        ];

        parent::__construct($attributes);
    }

    public static function upgradeModule($record, $v1_to_v2 = false, $imet_version = null)
    {
        // ####  v1 -> v2  ####
        if($v1_to_v2) {
            $record = static::addField($record, 'Element');
            $record = static::dropField($record, 'Benchmark1');
            $record = static::dropField($record, 'Benchmark2');
            $record = static::dropField($record, 'Benchmark3');
        }

        return $record;
    }
}
