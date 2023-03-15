<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;

class _Objectives extends Modules\Component\ImetModule
{

    public static $rules = [
        'ShortOrLongTerm'       => 'required'
    ];

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_title = trans('imet-core::oecm_context.Objectives.title');
        $this->module_fields = [
            ['name' => 'Element',  'type' => 'text-area',   'label' => trans('imet-core::oecm_context.Objectives.fields.Element')],
            ['name' => 'ShortOrLongTerm',  'type' => 'toggle-ImetOECM_ShortOrLongTerm',   'label' => trans('imet-core::oecm_context.Objectives.fields.ShortOrLongTerm')],
        ];

        $this->module_common_fields = [
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::oecm_context.Objectives.fields.Comments')],
        ];

        parent::__construct($attributes);
    }

}
