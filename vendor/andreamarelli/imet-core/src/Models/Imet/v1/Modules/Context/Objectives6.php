<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context;

class Objectives6 extends _Objectives
{
    protected $table = 'imet.context_objectives6';

    public function __construct(array $attributes = []) {

        $this->module_code = 'CTX 6.3';
        $this->module_info = trans('imet-core::v1_context.Objectives6.module_info');

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
            'table' => 'Objectives6',
            'fields' => [
                'Status', 'Benchmark1', 'Benchmark2', 'Benchmark3', 'Objective'
            ]
        ];
    }
}
