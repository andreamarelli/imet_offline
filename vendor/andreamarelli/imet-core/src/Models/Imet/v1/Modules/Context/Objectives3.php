<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context;

class Objectives3 extends _Objectives
{
    protected $table = 'imet.context_objectives3';

    public function __construct(array $attributes = []) {

        $this->module_code = 'CTX 3.4';
        $this->module_info = trans('imet-core::v1_context.Objectives3.module_info');

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
            'table' => 'Objectives3',
            'fields' => [
                'Status', 'Benchmark1', 'Benchmark2', 'Benchmark3', 'Objective'
            ]
        ];
    }
}
