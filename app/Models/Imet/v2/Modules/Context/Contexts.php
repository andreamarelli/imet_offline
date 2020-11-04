<?php

namespace App\Models\Imet\v2\Modules\Context;

use App\Models\Imet\v2\Modules;

class Contexts extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_contexts';
    protected $fixed_rows = true;

    public function __construct(array $attributes = []) {

        $this->module_type = 'ACCORDION';
        $this->module_code = 'CTX 1.6';
        $this->module_title = trans('form/imet/v2/context.Contexts.title');
        $this->module_fields = [
            ['name' => 'Context',  'type' => 'disabled',   'label' => trans('form/imet/v2/context.Contexts.fields.Context')],
            ['name' => 'file',  'type' => 'upload',   'label' => trans('form/imet/v2/context.Contexts.fields.file')],
            ['name' => 'Summary',  'type' => 'text-area',   'label' => trans('form/imet/v2/context.Contexts.fields.Summary')],
            ['name' => 'Source',  'type' => 'text-area',   'label' => trans('form/imet/v2/context.Contexts.fields.Source')],
            ['name' => 'Observations',  'type' => 'text-area',   'label' => trans('form/imet/v2/context.Contexts.fields.Observations')],
        ];

        $this->predefined_values = [
            'field' => 'Context',
            'values' => trans('form/imet/v2/context.Contexts.predefined_values')
        ];

        parent::__construct($attributes);

    }

    public static function upgradeModule($record, $v1_to_v2 = false, $imet_version = null, $db_version = null)
    {
        // ####  v1 -> v2  ####
        if($v1_to_v2) {
            $record = static::replacePredefinedValue(
                $record,
                'Context',
                'Political context (in country)',
                'Political context (country)'
            );
        }

        return $record;
    }
}