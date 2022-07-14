<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context;

class Objectives7 extends _Objectives
{
    protected $table = 'imet.context_objectives7';

    public function __construct(array $attributes = []) {

        $this->module_code = 'CTX 7.3';
        $this->module_info = trans('imet-core::v1_context.Objectives7.module_info');

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
            'table' => 'Objectives7',
            'fields' => [
                'Status', 'Benchmark1', 'Benchmark2', 'Benchmark3', 'Objective'
            ]
        ];
    }
}
