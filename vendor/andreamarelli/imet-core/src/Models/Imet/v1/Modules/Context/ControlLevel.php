<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class ControlLevel extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_control_level';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = []) {

        $this->module_type = 'SIMPLE';
        $this->module_code = 'CTX 2.3';
        $this->module_title = trans('imet-core::v1_context.ControlLevel.title');
        $this->module_fields = [
            ['name' => 'UnderControlArea',              'type' => 'integer',   'label' => trans('imet-core::v1_context.ControlLevel.fields.UnderControlArea')],
            ['name' => 'UnderControlPatrolManDay',      'type' => 'integer',   'label' => trans('imet-core::v1_context.ControlLevel.fields.UnderControlPatrolManDay')],
            ['name' => 'UnderControlPatrolKm',          'type' => 'integer',   'label' => trans('imet-core::v1_context.ControlLevel.fields.UnderControlPatrolKm')],
            ['name' => 'EcologicalMonitoringPatrolKm',  'type' => 'integer',   'label' => trans('imet-core::v1_context.ControlLevel.fields.EcologicalMonitoringPatrolKm')],
            ['name' => 'Source',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.ControlLevel.fields.Source')],
            ['name' => 'Observations',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.ControlLevel.fields.Observations')],
        ];

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
            'table' => 'ControlLevel',
            'fields' => [
                'UnderControlArea', 'UnderControlPatrolManDay', 'UnderControlPatrolKm', 'EcologicalMonitoringPatrolKm',
                'Source','Observations'
            ]
        ];
    }


    /**
     * @param $record
     * @param $area
     * @return float|null
     */
    public static function areaPercentage($record, $area): ?float
    {

        $result = null;
        $value = $record['UnderControlArea'];
        $value2 = $area;
        if (static::isValid($value2) && static::isValid($value) && $value > 0) {
            $result = (float)($value) / (float)($value2) * 100;
            $result = round($result, 2);
        }
        return $result;
    }

    /**
     * @param $record
     * @param $area
     * @return float|null
     */
    public static function averageTime($record, $area): ?float
    {
        $result = null;
        $value = $record['UnderControlPatrolManDay'];
        $value2 = $area;
        if (static::isValid($value2) && static::isValid($value) && $value > 0) {
            $result = (float)($value) / (float)($value2);
            $result = round($result, 2);
        }
        return $result;
    }

    /**
     * @param $record
     * @param $area
     * @return float|null
     */
    public static function areaPercentageConversion($record, $area): ?float
    {
        $result = null;
        $value = $record['UnderControlPatrolKm'];
        $value2 = $area;
        if (static::isValid($value2) && static::isValid($value) && $value > 0) {
            $result = (float)($value) / (float)($value2) * 10;
            $result = round($result, 2);
        }
        return $result;
    }

    /**
     * @param $record
     * @param $area
     * @return float|null
     */
    public static function averageTimeControlled($record, $area): ?float
    {
        $result = null;
        $value = $record['UnderControlPatrolKm'];
        $value2 = $record['UnderControlArea'];
        if (static::isValid($area) && static::isValid($value) && $value > 0) {
            $result = (float)($value) / (float)($value2);
            $result = round($result, 2);
        }
        return $result;
    }

    /**
     * @param $record
     * @param $area
     * @return float|null
     */
    public static function ecologicalMonitoringPatrolKmPercentage($record, $area): ?float
    {
        $result = null;
        $value = $record['EcologicalMonitoringPatrolKm'];
        $value2 = $area;
        if (static::isValid($value2) && static::isValid($value) && $value > 0) {
            $result = (float)($value) / (float)($value2) * 10;
            $result = round($result, 2);
        }
        return $result;
    }

    /**
     * @param $value
     * @return bool
     */
    private static function isValid($value): bool
    {
        if (!is_infinite($value) && $value > 0) {
            return true;
        }

        return false;
    }
}
