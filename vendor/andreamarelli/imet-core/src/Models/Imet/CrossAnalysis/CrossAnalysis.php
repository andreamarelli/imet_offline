<?php

namespace AndreaMarelli\ImetCore\Models\Imet\CrossAnalysis;

use AndreaMarelli\ImetCore\Controllers\Imet\v2\EvalController;
use AndreaMarelli\ImetCore\Helpers\ScalingUp\Common;
use AndreaMarelli\ImetCore\Models\Imet\Imet;
use AndreaMarelli\ImetCore\Services\Statistics\V1ToV2StatisticsService;
use AndreaMarelli\ImetCore\Services\Statistics\V2StatisticsService;
use Illuminate\Database\Eloquent\Model;

class CrossAnalysis extends Model
{
    private static $threshold = 34.0;

    private static array $indicators = [
        'context' => ['c12', 'c2', 'c14', 'c15'],
        'process' => ['pr2', 'pr4', 'pr5', 'pr6', 'pr7', 'pr8', 'pr11', 'pr17', 'pr18'],
        'inputs' => ['i2', 'i5'],
        'planning' => ['p1', 'p4'],
        'outcomes' => ['oc3'],
        'outputs' => ['op3']
    ];

    private static array $compares = [
        ['c12', 'pr7'],
        ['c2', 'p1'],
        ['i2', 'pr2'],
        ['c14', 'pr17'],
        ['i5', 'pr6'],
        ['pr8', 'op3'],
        ['p4', 'pr4', 'pr5'],
        ['pr11', 'oc3'],
        ['c15', 'pr18']
    ];

    /**
     * retrieve all indicators data
     * @param $item
     * @return array
     */
    public static function getIndicators($item): array
    {
        $filteredArray = [];
        $compareElements = [];
        foreach (static::$indicators as $key => $indicators) {

            $results = $item->version==Imet::IMET_V1
                ? V1ToV2StatisticsService::get_assessment($item->FormID, $key)
                : V2StatisticsService::get_assessment($item->FormID, $key);

            $filteredArray = array_merge($filteredArray, array_intersect_key((array)$results, array_flip(static::$indicators[$key])));

            foreach ($item::modules()[$key] as $module) {
                $definitions = $module::getDefinitions($item->FormID);
                $code = strtolower(str_ireplace(['.', '/'], '', $definitions['module_code']));
                if (isset($filteredArray[$code])) {
                    if (is_array($definitions['module_info_EvaluationQuestion'])) {
                        $compareElements[$code] = [
                            'code' => $definitions['module_code'],
                            'value' => $filteredArray[$code],
                            'question' => $definitions['module_info_EvaluationQuestion'][0],
                            'step' => $key,
                            'key' => "module_" . $definitions['module_key']];
                    }
                }
            }
        }
        return static::compareValues($compareElements);
    }

    /**
     * compare values of indicators
     * @param $elements
     * @return array
     */
    private static function compareValues($elements): array
    {
        $error_indicators = [];
        $j = 0;
        foreach (static::$compares as $item) {
            $array_length = count($item);
            for ($i = 0; $i < $array_length; $i++) {
                for ($k = $i + 1; $k < $array_length; $k++) {
                    if(isset($elements[$item[$i]]) && isset($elements[$item[$k]])) {
                        $value_indi1 = Common::values_correction($item[$i] ,$elements[$item[$i]]['value']);
                        $value_indi2 = Common::values_correction($item[$k] ,$elements[$item[$k]]['value']);
                        $value = abs((double)$value_indi1 - (double)$value_indi2);
                        if (($value) > static::$threshold) {
                            $error_indicators[$j][$item[$i]] = $elements[$item[$i]];
                            $error_indicators[$j][$item[$k]] = $elements[$item[$k]];
                        }
                    }
                }
            }
            $j++;
        }

        return $error_indicators;
    }


}
