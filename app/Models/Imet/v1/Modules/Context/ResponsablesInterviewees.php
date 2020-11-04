<?php

namespace App\Models\Imet\v1\Modules\Context;

use App\Models\Imet\v1\Modules;

class ResponsablesInterviewees extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_encoding_responsables_interviewees';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 1.0.2';
        $this->module_title = trans('form/imet/v1/context.ResponsablesInterviewees.title');
        $this->module_fields = [
            ['name' => 'Name',              'type' => 'text-area',       'label' => trans('form/imet/v1/context.ResponsablesInterviewees.fields.Name'),         'class' => 'width300px'],
            ['name' => 'Institution',       'type' => 'text-area',       'label' => trans('form/imet/v1/context.ResponsablesInterviewees.fields.Institution'),  'class' => 'width300px'],
            ['name' => 'Function',          'type' => 'text-area',       'label' => trans('form/imet/v1/context.ResponsablesInterviewees.fields.Function')],
            ['name' => 'Contacts',          'type' => 'text-area',       'label' => trans('form/imet/v1/context.ResponsablesInterviewees.fields.Contacts')]
        ];

        $this->module_common_fields = [
            ['name' => 'EncodingDate',      'type' => 'date',       'label' => trans('form/imet/v1/context.ResponsablesInterviewees.fields.EncodingDate')],
            ['name' => 'EncodingDuration',  'type' => 'text-area',       'label' => trans('form/imet/v1/context.ResponsablesInterviewees.fields.EncodingDuration')]
        ];

        parent::__construct($attributes);
    }

    public static function getNames($form_id)
    {
        return static::getModule($form_id)
            ->map->only(['Name', 'Institution', 'Function'])
            ->toArray();
    }
}