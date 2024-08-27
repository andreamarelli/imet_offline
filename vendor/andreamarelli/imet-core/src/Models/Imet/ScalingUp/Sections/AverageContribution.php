<?php

namespace AndreaMarelli\ImetCore\Models\Imet\ScalingUp\Sections;

use AndreaMarelli\ImetCore\Helpers\ScalingUp\Common;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;

class AverageContribution
{
    /**
     * @param array $form_ids
     * @param string $colors
     * @param array $options
     * @param string $label
     * @param string $type
     * @param int $scaling_id
     * @return array
     */
    public static function average_contribution_calculations_threat(array $form_ids, string $colors = "", array $options = [], string $label = "", string $type = "", int $scaling_id = 0): array
    {
        $indicators = [];
        $indicators_average_contribution = [];
        $protected_areas = [];
        $data = [];
        foreach ($form_ids as $j => $form_id) {
            $protected_areas[$j] = Modules\Context\MenacesPressions::getStats($form_id);
            if (count($indicators) === 0) {
                foreach ($protected_areas[$j]['category_stats'] as $c => $value) {
                    $name = trans('imet-core::v2_context.MenacesPressions.categories.title' . ($c + 1), []);
                    array_unshift($indicators, $name);
                    $indicators_average_contribution[] = $name;
                }
            }
            foreach ($protected_areas[$j]['category_stats'] as $k => $protected_area) {
                if ($protected_area === "") {
                    $value = "-";
                } else {
                    $value = Common::round_number((-1 * (double)$protected_area));
                }
                $data[$k][] = $valuesIndicators[$k][] = $value;
            }
        }

        $average_contribution = [];
        if (count(array_filter(array_keys($data), 'is_string')) === 0) {
            krsort($data);
        }

        $average_contribution = static::calculate_data_average_contribution($average_contribution, $data, $colors, $label, $type);

        $average_contribution['options'] = count($options) ? $options : null;
        $average_contribution['indicators'] = $indicators_average_contribution;

        if (array_key_exists('data', $average_contribution)) {
            usort($average_contribution['data']['Average'], function ($a, $b) {
                return -($a['value'] <=> $b['value']);
            });
        }

        $average_contribution['legends'] = [trans('imet-core::v2_common.steps.threats'), trans('imet-core::analysis_report.variability')];
        return ['average_contribution' => $average_contribution];
    }

    /**
     * @param array $form_ids
     * @param array $table_indicators
     * @param string $type
     * @param string $colors
     * @param array $options
     * @param string $label
     * @param string $origType
     * @return array|array[]
     */
    public static function average_contribution_calculations(array $form_ids, array $table_indicators, string $type = "", string $colors = "", array $options = [], string $label = "", string $origType = ''): array
    {
        $data = [$type => []];
        $radar_negative_indicators = ['C2', 'OC2', 'OC3'];
        $radar_zero_negative_indicators = ['C3'];
        $legends_match = [
            'PRA' => 'PRA',
            'PRB' => 'PRB',
            'PRC' => 'PRC',
            'PRD' => 'PRD',
            'PRE' => 'PRE',
            'PRF' => 'PRF'
        ];

        $filtered = Common::filtered_indicators_and_round_values($form_ids, $type, $table_indicators);

        foreach ($filtered as $id => $values) {
            unset($values['indicators_number']);
            foreach ($values as $v => $value) {
                if ($v !== "avg") {
                    if (in_array($v, $radar_negative_indicators)) {
                        $correction_value = Common::values_correction($v, (float)$value);
                    } else if (in_array($v, $radar_zero_negative_indicators)) {
                        $correction_value = Common::values_correction($v, (float)$value);
                    } else {
                        $correction_value = $value;
                    }
                    $data[$type][$v][] = $correction_value;
                }
            }
        }

        if (count(array_filter(array_keys($data), 'is_string')) === 0) {
            krsort($data[$type]);
        }
        $average_contribution = [];
        $average_contribution = static::calculate_data_average_contribution($average_contribution, $data[$type], $colors, $label, $type);
        $average_contribution['options'] = count($options) ? $options : null;
        if (strpos($origType, "_") !== false) {
            $name = explode("_", $origType);
            $legend_name = trans('imet-core::analysis_report.assessment.' . $legends_match[$name[1] . "_" . $name[2]]);

        } else {
            $legend_name = trans('imet-core::common.steps_eval.' . $origType);
        }

        $average_contribution['legends'] = [$legend_name, trans('imet-core::analysis_report.variability')];

        return ['average_contribution' => $average_contribution];
    }

    /**
     * @param array $average_contribution
     * @param array $data
     * @param string $colors
     * @param string $label
     * @param string $type
     * @return array|mixed
     */
    private static function calculate_data_average_contribution(array $average_contribution, array $data, string $colors, string $label, string $type): array
    {
        $i = 0;

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
                $average_contribution = self::getAverage_contribution($average_value, $percentile_10, $percentile_90, $v, $colors, $average_contribution, $i, $index, $label, $type);
            }
            $i++;
        }

        return $average_contribution;
    }

    /**
     * @param $average_value
     * @param $percentile_10
     * @param $percentile_90
     * @param $v
     * @param string $colors
     * @param array $average_contribution
     * @param int $i
     * @param $index
     * @param string $label
     * @param string $type
     * @return array
     */
    private static function getAverage_contribution($average_value, $percentile_10, $percentile_90, $v, string $colors, array $average_contribution, int $i, $index, string $label, string $type): array
    {
        $average_contribution['data']['Average'][$i] = [
            "value" => $average_value,
            "upper limit" => [$percentile_10, $percentile_90],
            "label" => trans('imet-core::v2_common.assessment.' . $v),
            "color" => "#000000",
            "itemStyle" => ["color" => $colors]
        ];

        if (is_numeric($index)) {
            $average_contribution['data']['Average'][$i]["indicator"] = trans($label . ($v), []);
        } else {
            if ($type === "process" && stripos($v, "_") === true) {
                $average_contribution['data']['Average'][$i]["indicator"] = Common::indicator_label($v, $label, 'imet-core::analysis_report.legends.');
            } else {
                $average_contribution['data']['Average'][$i]["indicator"] = Common::indicator_label($v, $label);
            }
        }
        return $average_contribution;
    }
}
