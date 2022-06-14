<?php

namespace AndreaMarelli\ImetCore\Models\Imet\ScalingUp\Sections;

use AndreaMarelli\ImetCore\Helpers\ScalingUp\Common;

class AverageContribution
{
    /**
     * @param array $data
     * @param string $colors
     * @param array $options
     * @param string $label
     * @param string $type
     * @return array
     */
    public static function average_contribution_calculations(array $data, string $colors, array $options = [], string $label, string $type = ""): array
    {
        $average = [];
        $average_contribution = [];
        $i = 0;
        if (count(array_filter(array_keys($data), 'is_string')) === 0) {
            krsort($data);
        }
        foreach ($data as $index => $value) {
            if ($value !== "-") {
                $v = $index;

                if (is_numeric($index)) {
                    $v = (int)$index + 1;
                }
                $values = array_filter(array_values($value), function ($v) {
                    return is_numeric($v);
                });
                $percentile_10 = Common::round_number(Common::get_percentile($values, 10));
                $percentile_90 = Common::round_number(Common::get_percentile($values, 90));
                $average_value = count($values) ? Common::round_number(array_sum($values) / count($values)) : 0;//check
                $average[] = $average_value;
                $average_contribution['data']['Average'][$i] = ["value" => $average_value, "upper limit" => [$percentile_10, $percentile_90],
                    "label" => trans('imet-core::v2_common.assessment.' . $v), "color" => "#000000", "itemStyle" => ["color" => $colors],
                ];
                if (is_numeric($index)) {
                    $average_contribution['data']['Average'][$i]["indicator"] = trans($label . ($v), []);
                } else {
                    if ($type === "process") {
                        $average_contribution['data']['Average'][$i]["indicator"] = Common::indicator_label($v, $label, 'imet-core::analysis_report.legends.');
                    } else {
                        $average_contribution['data']['Average'][$i]["indicator"] = Common::indicator_label($v, $label);
                    }
                }
                $i++;
            }

        }

        $average_contribution['options'] = count($options) ? $options : null;

        return ['average_contribution' => $average_contribution, 'average' => $average];
    }
}
