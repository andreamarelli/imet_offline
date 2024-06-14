<?php

namespace AndreaMarelli\ImetCore\Models\Imet\ScalingUp\Sections;

use AndreaMarelli\ImetCore\Helpers\ScalingUp\Common;

class DataTable
{
    /**
     * @param array $form_ids
     * @param array $table_indicators
     * @param string $type
     * @param ?int $scaling_id
     * @param bool $add_synthetic_indicator
     * @return array|array[]
     */
    public static function get_datatable_analysis_indicators(array $form_ids, array $table_indicators, string $type = "", ?int $scaling_id = 0, bool $add_synthetic_indicator = false): array
    {
        $tables = [$type => []];
        $radar_average =["wdpa_id" => trans('imet-core::analysis_report.average'), "name" => trans('imet-core::analysis_report.average')] + array_map(function ($val) {return 0;} ,$table_indicators);
        $filtered = Common::filtered_indicators_and_round_values($form_ids, $type, $table_indicators, $add_synthetic_indicator);

        foreach ($filtered as $id => $values) {
            $pa = Common::get_pa_name($id, $scaling_id);
            $items = array_merge([
                'wdpa_id' => $pa->wdpa_id,
                'name' => $pa->name
            ], array_map(
                    [Common::class, 'round_number'],
                    array_diff_key($values, ['indicators_number' => 0]))
            );

            foreach ($table_indicators as $v => $item) {
                $value_ind = $values[$v];
                if ((string)$value_ind === "-") {
                    $value_ind = 0;
                }
                $radar_average[$v] = array_key_exists($v, $radar_average) ? $radar_average[$v] + (float)$value_ind : (float)$value_ind;
            }
            $tables[$type][] = $items;
        }

        foreach ($table_indicators as $v => $item) {
            $radar_average[$v] = Common::round_number((float)$radar_average[$v] / count($filtered));
        }
        $tables[$type][] = $radar_average;


        return [
            'table' => $tables[$type]
        ];
    }

}
