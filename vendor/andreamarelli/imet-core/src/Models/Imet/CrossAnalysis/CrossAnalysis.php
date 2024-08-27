<?php

namespace AndreaMarelli\ImetCore\Models\Imet\CrossAnalysis;

use AndreaMarelli\ImetCore\Helpers\ScalingUp\Common;
use AndreaMarelli\ImetCore\Services\Scores\ImetScores;
use Illuminate\Database\Eloquent\Model;

class CrossAnalysis extends Model
{
    private static $threshold = 34.0;

    private static array $indicators = [
        'context' => ['C12', 'C2', 'C14', 'C15'],
        'process' => ['PR2', 'PR4', 'PR5', 'PR6', 'PR7', 'PR8', 'PR11', 'PR17', 'PR18'],
        'inputs' => ['I2', 'I5'],
        'planning' => ['P1', 'P4'],
        'outcomes' => ['OC3'],
        'outputs' => ['OP3']
    ];

    private static array $compares = [
        ['C12', 'PR7'],
        ['C2', 'P1'],
        ['I2', 'PR2'],
        ['C14', 'PR17'],
        ['I5', 'PR6'],
        ['PR8', 'OP3'],
        ['P4', 'PR4', 'PR5'],
        ['PR11', 'OC3'],
        ['C15', 'PR18']
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
        foreach (static::$indicators as $step_key => $indicators) {

            $scores = ImetScores::get_step($item, $step_key);
            $filteredArray = array_merge($filteredArray,
                array_intersect_key($scores, array_flip(static::$indicators[$step_key]))
            );

            foreach ($item::modules()[$step_key] as $module) {
                $definitions = $module::getDefinitions($item->FormID);
                $code = strtolower(str_ireplace(['.', '/'], '', $definitions['module_code']));
                if (isset($filteredArray[$code])) {
                    if (is_array($definitions['module_info_EvaluationQuestion'])) {
                        $compareElements[$code] = [
                            'code' => $definitions['module_code'],
                            'value' => $filteredArray[$code],
                            'question' => $definitions['module_info_EvaluationQuestion'][0],
                            'step' => $step_key,
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
