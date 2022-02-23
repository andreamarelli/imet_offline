<?php

namespace AndreaMarelli\ImetCore\Models\Imet\ScalingUp;

use AndreaMarelli\ImetCore\Controllers\Imet\EvalControllerV2;
use AndreaMarelli\ImetCore\Helpers\API\DOPA\DOPA;
use AndreaMarelli\ImetCore\Models\Animal;
use AndreaMarelli\ImetCore\Models\Country;
use AndreaMarelli\ImetCore\Models\Imet\v2\Imet;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class ScalingUpAnalysis extends Model
{
    private static $protected_areas_ids = [];
    protected static $ttl = 2;
    protected $table = 'imet.scaling_up';
    protected $fillable = ['wdpas'];
    public $timestamps = false;
    public static $scaling_id = null;

    public static function get_scaling_up_by_wdpas($wdpas)
    {
        return static::where('wdpas', $wdpas)->get();
    }

    /**
     * if names are duplicate add the year
     * @param $form_id
     * @param bool $retrieve_area
     * @return \AndreaMarelli\ImetCore\Models\Imet\v2\Imet[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|null
     */
    public static function protected_areas_duplicate_fixes($form_id, $retrieve_area = true, $show_original_names = false)
    {

        $area = static::get_protected_area_data($form_id, $show_original_names);
        if ($area !== null) {
            $area->name = static::add_the_indicator_to_the_field($area->wdpa_id, $area->name, $area->Year);

            return $area;
        }
        return null;
    }

    public static function reset_areas_ids()
    {
        static::$protected_areas_ids = [];
    }

    /**
     *
     * @param $search_with
     * @param $in_value
     * @param $add_value
     * @return mixed|string
     */
    private static function add_the_indicator_to_the_field($search_with, $in_value, $add_value)
    {

        if ($search_with !== null && in_array($search_with, static::$protected_areas_ids)) {
            $in_value .= " ($add_value)";
        }
        static::$protected_areas_ids[] = $search_with;

        return $in_value;
    }

    /**
     * get the protected area country
     * @param $form_ids
     * @return Imet[]|array|bool|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|mixed
     */
    public static function get_protected_area_with_countries($form_ids)
    {
        $items = [];
        foreach ($form_ids as $k => $form_id) {

            $pa = static::getCustomNames($form_id);
            $items[$k] = $pa;
            $items[$k]['Country_name'] = Country::getByISO($pa['Country']);
        }

        uasort($items, function ($a, $b) {
            return strnatcmp($a['name'], $b['name']);
        });

        return ['status' => 'success', 'data' => $items];
    }

    /**
     * @param $form_ids
     * @return Imet[]|bool|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|mixed
     */
    public static function get_protected_area($form_ids, $show_original_names = false)
    {
        $protected_area = [];
        foreach ($form_ids as $form_id) {
            $protected_area[$form_id] = static::protected_areas_duplicate_fixes($form_id, true, $show_original_names);
        }

        return $protected_area;
    }

    /**
     * @param $wdpa_id
     * @return array
     */
    private static function get_all_indicators_without_nulls($wdpa_id): array
    {
        return array_map(function ($i) {
            foreach ($i as $key => $item) {
                if ($i->$key === null) {
                    $i->$key = 0;
                }
            }

            return $i;
        }, DOPA::get_de_wdpa_all_inds($wdpa_id));
    }

    /**
     * get all the data for map view
     * @param $form_ids
     * @return array
     */
    public static function get_maps_stats($form_ids)
    {
        $country_indicators = [];
        $dopa_stats = ['all_data' => [],
            'area_prot_terr_km2' => 0,
            'area_prot_mar_km2' => 0,
            'countries' => ['area_tot_km2' => 0,
                'area_prot_terr_km2' => 0,
                'area_prot_mar_km2' => 0,
                'area_prot_terr_perc' => 0,
                'area_prot_mar_perc' => 0,
                'area_mar_km2' => 0,
                'area_terr_km2' => 0,
                'protconn' => 0
            ]];

        $country_stats = $dopa_stats['countries'];


        $protected_areas = [];
        foreach ($form_ids as $key => $form_id) {
            $protected_area = static::getCustomNames($form_id);
            $name = $protected_area['name'];
            $country = $protected_area['Country'];
            $indicators = static::get_all_indicators_without_nulls($protected_area['wdpa_id']);

            $protected_areas[] = $protected_area['wdpa_id'];
            if (!isset($country_indicators[$country])) {
                $country_indicators[$country] = DOPA::get_country_all_inds($country);
                foreach ($country_stats as $key => $value) {
                    $country_stats[$key] += $country_indicators[$country][0]->$key ?? 0;
                }
            }
            if (isset($indicators[0])) {
                $value = null;
                if (property_exists($indicators[0], 'area_tot_km2')) {
                    $value = $indicators[0]->area_tot_km2;
                }
                if ($indicators[0]->marine) {
                    $dopa_stats['area_prot_mar_km2'] += $value;
                } else {
                    $dopa_stats['area_prot_terr_km2'] += $value;
                }

                $dopa_stats['all_data'][$name] = $indicators[0];
            } else {
                // return array( $protected_area, $indicators);
            }
        }

        $total_coverage_of_protected_areas = $dopa_stats['area_prot_mar_km2'] + $dopa_stats['area_prot_terr_km2'];

        $country_stats['area_terr_perc'] = $total_coverage_of_protected_areas > 0 ? ($dopa_stats['area_prot_terr_km2'] / $total_coverage_of_protected_areas) * 100 : 0;
        $country_stats['area_mar_perc'] = $total_coverage_of_protected_areas > 0 ? ($dopa_stats['area_prot_mar_km2'] / $total_coverage_of_protected_areas) * 100 : 0;
        $country_stats['area_prot_mar_km2'] = $dopa_stats['area_prot_mar_km2'];
        $country_stats['area_prot_terr_km2'] = $dopa_stats['area_prot_terr_km2'];

        return ['status' => 'success', 'data' => [$protected_areas, $country_stats]];
    }


    /**
     * @param $network
     * @param $form_id
     * @return array
     */
    private static function transboundary_areas($network, $form_id)
    {
        $wdpa_name = [];
        $main_values = [];
        foreach ($network as $trabs) {
            if ($trabs['group_key'] === 'group0') {
                $ids = explode(',', $trabs['ProtectedAreas']);
                foreach ($ids as $id) {

                    $wdpa_id = explode('_', $id);
                    if (count($wdpa_id) > 1) {
                        $pa = IMET::getProtectedArea($wdpa_id[1]);
                        $general_info_data = Modules\Context\GeneralInfo::select('ReferenceTextValues')->where('FormID', $form_id)->get()->pluck('ReferenceTextValues');
                        $wdpa_name[] = $pa->name;

                        if ($general_info_data[0] !== '') {
                            $main_values[] = $general_info_data[0];
                        }
                    }
                }
            }
        }

        return [implode(', ', $wdpa_name), implode(', ', $main_values)];
    }

    /**
     * @param $form_ids
     * @return \array[][]
     * @throws \ReflectionException
     */
    public static function general_info($form_ids): array
    {
        $generalElements = [
            'network' => [],
            'landscapes' => [],
            'categories' => [],
            'values_network' => [],
            'surface_landscape' => [],
            'agencies' => [],
            'eco_regions' => [],
            'countries' => [],
            'total_surface_area_of_landscape_protected_areas' => 0,
            'total_surface_protected_areas' => 0
        ];

        foreach ($form_ids as $form_id) {
            $general_info_data = Modules\Context\GeneralInfo::getVueData($form_id);

            $networks = Modules\Context\Networks::getModuleRecords($form_id);

            $vision_data = Modules\Context\Missions::getModuleRecords($form_id);
            $generalElements['total_surface_protected_areas'] += Modules\Context\Areas::getArea($form_id);
            if ($general_info_data['records'][0]) {

                $general_info = $general_info_data['records'][0];
                $indicators = DOPA::get_wdpa_all_inds($general_info['WDPA']);

                if (isset($indicators[0])) {
                    $generalElements['total_surface_area_of_landscape_protected_areas'] += $indicators[0]->area_tot_km2;
                }
                $country_name = Country::getByISO($general_info['Country'])->name;
                if (!in_array($country_name, $generalElements['countries'])) {
                    $generalElements['countries'][] = $country_name;
                }
                $generalElements['network'][] = $general_info['CompleteName'];

                $iucn_category = $general_info['IUCNCategory1'] === 'Not Reported' ? '' : "(" . $general_info['IUCNCategory1'] . ")";
                $generalElements['categories'][] = $general_info['NationalCategory'] . $iucn_category;
                if ($networks['records'][0]['id'] !== null) {
                    $result = static::transboundary_areas($networks['records'], $form_id);
                    $generalElements['values_network'][] = $result[1];
                    $generalElements['landscapes'][] = $result[0];

                }
                $generalElements['surface_landscape'][] = '';
                $generalElements['agencies'][] = $general_info['Institution'];
                $generalElements['eco_regions'][] = $general_info['Ecoregions'];
            }

            if ($vision_data['records'][0]) {
                $vision = $vision_data['records'][0];
                $generalElements['LocalMission'][] = $vision['LocalMission'] ? $general_info_data['records'][0]['CompleteName'] : null;
                $generalElements['LocalObjective'][] = $vision['LocalObjective'] ? $general_info_data['records'][0]['CompleteName'] : null;
                $generalElements['LocalVision'][] = $vision['LocalVision'] ? $general_info_data['records'][0]['CompleteName'] : null;
            }
        }

        $generalElements['total_surface_protected_areas'] = static::round_number($generalElements['total_surface_protected_areas']);
        $generalElements['total_surface_area_of_landscape_protected_areas'] = static::round_number($generalElements['total_surface_area_of_landscape_protected_areas']);

        return ['status' => 'success', 'data' => ['general_info' => $generalElements]];
    }

    /**
     * @param $form_ids
     * @return \array[][]
     * @throws \ReflectionException
     */
    public static function management_context($form_ids)
    {

        $key_elements = [
            'species' => ['group0' => [], 'group1' => []],
            'habitats' => [],
            'climate_change' => [],
            'ecosystem_services' => [],
            'threats' => [],
            'species_statistics' => []
        ];
        $array_elements = ['habitats' => [],
            'climate_change' => [],
            'ecosystem_services' => [],
            'threats' => []];
        $array_elements_count = ['habitats_count' => [],
            'climate_change_count' => [],
            'ecosystem_services_count' => [],
            'threats_count' => [],
        ];
        $species_count = ['group0' => [], 'group1' => []];

        foreach ($form_ids as $form_id) {
            $protected_area = static::getCustomNames($form_id);

            $name = $protected_area['name'];
            $retrieve_key_elements = [
                'species' => Modules\Evaluation\ImportanceSpecies::getModule($form_id)->filter(function ($item) {
                    return $item['IncludeInStatistics'];
                })->map(function ($item) {
                    return [$item['group_key'] => Animal::getPlainNameByTaxonomy($item['Aspect'])];
                })->toArray(),
                'habitats' => Modules\Evaluation\ImportanceHabitats::getModule($form_id)->filter(function ($item) {
                    return $item['IncludeInStatistics'];
                })->pluck('Aspect')->toArray(),
                'climate_change' => Modules\Evaluation\ImportanceClimateChange::getModule($form_id)->filter(function ($item) {
                    return $item['IncludeInStatistics'];
                })->pluck('Aspect')->toArray(),
                'ecosystem_services' => Modules\Evaluation\ImportanceEcosystemServices::getModule($form_id)->filter(function ($item) {
                    return $item['IncludeInStatistics'];
                })->pluck('Aspect')->toArray(),
                'threats' => Modules\Evaluation\Menaces::getModule($form_id)->filter(function ($item) {
                    return $item['IncludeInStatistics'];
                })->pluck('Aspect')->toArray()
            ];

            if (count($retrieve_key_elements['species'])) {
                foreach ($retrieve_key_elements['species'] as $key => $array_species) {
                    foreach ($array_species as $group => $species) {

                        if (isset($species_count[$group][$species])) {
                            $species_count[$group][$species] += 1;
                        } else {
                            $species_count[$group][$species] = 1;
                        }

                        $key_elements['species'][$group][$species][0][] = $name;
                    }
                }
            }


            foreach ($array_elements as $keys => $element) {
                if (count($retrieve_key_elements[$keys])) {
                    foreach ($retrieve_key_elements[$keys] as $key => $item) {
                        if (isset($array_elements_count[$keys . '_count'][$item])) {
                            $array_elements_count[$keys . '_count'][$item] += 1;
                        } else {
                            $array_elements_count[$keys . '_count'][$item] = 1;
                        }
                        $key_elements[$keys][$item][0][] = $name;
                    }
                }
            }
        }

        foreach ($array_elements as $keys => $element) {
            foreach ($array_elements_count[$keys . '_count'] as $k => $value) {
                $key_elements[$keys] = array_filter($key_elements[$keys], function ($v) {
                    return count($v[0]) > 1;
                });

                uasort($key_elements[$keys], function ($a, $b) {
                    return count($b[0]) <=> count($a[0]);
                });

                $array_elements_count[$keys . '_count'] = array_filter($array_elements_count[$keys . '_count'], function ($v) {
                    return ($v) > 1;
                });

                uasort($array_elements_count[$keys . '_count'], function ($a, $b) {
                    return $b <=> $a;
                });
            }

        }

        foreach ($species_count as $k => $group) {
            $key_elements['species'][$k] = array_filter($key_elements['species'][$k], function ($v) {
                return count($v[0]) > 1;
            });

            uasort($key_elements['species'][$k], function ($a, $b) {
                return count($b[0]) <=> count($a[0]);
            });

            $species_count[$k] = array_filter($group, function ($v) {
                return ($v) > 1;
            });

            uasort($species_count[$k], function ($a, $b) {
                return $b <=> $a;
            });
        }

        $key_elements['species_statistics'] = $species_count;
        $key_elements['habitats_statistics'] = $array_elements_count['habitats_count'];
        $key_elements['climate_change_statistics'] = $array_elements_count['climate_change_count'];
        $key_elements['ecosystem_services_statistics'] = array_slice($array_elements_count['ecosystem_services_count'], 0, 10);
        $key_elements['threats_statistics'] = array_slice($array_elements_count['threats_count'], 0, 5);
        $key_elements['ecosystem_services'] = array_slice($key_elements['ecosystem_services'], 0, 10);
        $key_elements['threats'] = array_slice($key_elements['threats'], 0, 5);
        return ['status' => 'success', 'data' => ['key_elements' => $key_elements]];
    }

    /**
     * @param $form_ids
     * @return array
     */
    public static function get_threats_categories_per_protected_area($form_ids): array
    {
        $pa = count($form_ids);
        $data = [];

        //average contribution
        $average_contribution = [];
        $valuesIndicators = [];

        $total_categories = [];
        $protected_areas = [];

        $protected_areas_names = [];
        $ranking = ['values' => [], 'legends' => [], 'xAxis' => []];

        $radar = ['values' => [], 'indicators' => []];
        $indicators = [];
        $indicators_average_contribution = [];

        $ranking_raw_values = [];
        $keep_locale = App::getLocale();
        foreach ($form_ids as $j => $form_id) {
            $pa = static::getCustomNames($form_id);
            $protected_areas_names[$form_id] = $pa->name;
            $protected_areas[$j] = Modules\Context\MenacesPressions::getStats($form_id);
            if (count($indicators) === 0) {
                foreach ($protected_areas[$j]['category_stats'] as $c => $value) {
                    $name = trans('imet-core::v2_context.MenacesPressions.categories.title' . ($c + 1), [], $keep_locale);
                    array_unshift($indicators, $name);
                    $indicators_average_contribution[] = $name;
                }
            }
            foreach ($protected_areas[$j]['category_stats'] as $k => $protected_area) {
                $value = static::round_number((-1 * (double)$protected_area));
                $total_categories[$k][] = ["name" => $protected_areas_names[$form_id], "value" => $value, 'color' => $pa->color];
                $ranking_raw_values[$form_id][] = $value;
                $ranking_raw_values[$form_id]['avg'] = abs($ranking_raw_values[$form_id]['avg'] ?? 0) + abs($value);

                $data[$k][] = $valuesIndicators[$k][] = $value;
            }
        }

        static::average_contribution_calculations($data, $average, $average_contribution, $pa, '#C23531', ['height' => '850px'], $keep_locale, 'imet-core::v2_context.MenacesPressions.categories.title');
        usort($average_contribution['data']['Average'], function ($a, $b) {
            return -($a['value'] <=> $b['value']);
        });

        //sort the threats per avg value
        uasort($ranking_raw_values, function ($a, $b) {
            return $b['avg'] - $a['avg'];
        });

        foreach ($ranking_raw_values as $id => $values) {
            foreach ($values as $v => $value) {
                if ($v != "avg") {
                    $name = trans('imet-core::v2_context.MenacesPressions.categories.title' . ($v + 1), [], $keep_locale);
                    $ranking['values'][$name][] = $value;
                    $ranking['legends'][$v] = $name;

                }
            }
            $ranking['xAxis'][] = $protected_areas_names[$id];
        }

        foreach ($total_categories as $k => $cat) {

            usort($cat, function ($a, $b) {
                return $a['value'] < $b['value'];
            });
            $total_categories[$k] = $cat;
            foreach ($cat as $c => $v) {
                if (isset($radar['values'][$v['name']])) {
                    array_unshift($radar['values'][$v['name']], $v['value']);
                } else {
                    $radar['values'][$v['name']][] = $v['value'];
                    $radar['values'][$v['name']]['color'] = $v['color'];
                }
            }
        }

        $radar['indicators'] = $indicators;
        $average_contribution['indicators'] = $indicators_average_contribution;

        return ['status' => 'success', 'data' => ["values" => $total_categories, 'average_contribution' => $average_contribution, 'ranking' => $ranking, 'radar' => $radar]];
    }

    /**
     * @param $form_ids
     * @return array
     */
    public static function get_overall_management_effectiveness_scores($form_ids): array
    {
        $time_start = microtime(true);
        $assessments = [];
        $synthetic_indicators_table = static::get_assessments($form_ids);
        $assessments['data'] = $synthetic_indicators_table['data'];
        $index_ranking = static::get_imet_ranking($form_ids, $assessments);
        $radars = static::get_protected_areas_diagram_compare($form_ids, $assessments, true);
        $averages_six_elements = static::get_averages_of_each_indicator_of_six_elements($form_ids, $assessments, true);
        static::reset_areas_ids();
        $scatter_plots = static::get_scatter_grouping_analysis(array_map(function (int $value): array {
            $pa = static::getCustomNames($value);
            return ['id' => $value, 'group' => $value, 'name' => $pa['name'], 'color' => $pa['color']];
        }, $form_ids), $assessments, true);

        $time_end = microtime(true);
        $execution_time = ($time_end - $time_start);

        return ['status' => 'success', 'execition_time' => $execution_time, 'data' => [
            'values' => $index_ranking['data']['values'],
            'radar' => $radars['data']['diagrams'],
            'scatter' => $scatter_plots['data']['scatter'],
            'averages_six_elements' => $averages_six_elements['data'],
            'assessments' => $assessments['data']['assessments']
        ]];
    }

    /**
     * @param $form_ids
     * @return array|array[]
     */
    public static function get_assessments($form_ids): array
    {

        $indicators = [
            'context',
            'planning',
            'inputs',
            'process',
            'outputs',
            'outcomes'
        ];

        $assessments = [];
        foreach ($form_ids as $k => $form_id) {

            $assessments[$k] = (array)EvalControllerV2::assessment($form_id, 'global', true)->getData();
            $name = static::getCustomNames($form_id);
            $assessments[$k]['name'] = $name->name;
            $assessments[$k]['color'] = $name->color;
            foreach ($indicators as $key => $indicator) {
                $assessments[$k][$indicator] = static::round_number($assessments[$k][$indicator]);
            }
        }

        uasort($assessments, function ($a, $b) {
            return $b['name'] <=> $a['name'];
        });

        $assessments = array_map(function ($value) {
            if ($value['imet_index']) {
                $value['imet_index'] = static::round_number($value['imet_index']);
            }
            return $value;
        }, $assessments);

        return ['status' => 'success', 'data' => ['assessments' => $assessments]];
    }

    /**
     * @param $form_id
     * @return array|array[]
     */
    public static function get_sub_indicators_by_context($form_id, $type = ''): array
    {
        return (array)EvalControllerV2::assessment($form_id, $type)->getData();

    }

    /**
     * @param $form_ids
     * @return array
     */
    public static function analysis_per_element_of_the_management_cycle($form_ids): array
    {
        $type = array_pop($form_ids);


        $options = [
            'context' => ['height' => '500px'],
            'planning' => ['height' => '500px'],
            'inputs' => ['height' => '500px'],
            'process' => ['height' => '500px'],
            'outputs' => ['height' => '500px'],
            'outcomes' => ['height' => '500px'],
            'context_sub_indicators' => ['height' => '500px'],
            'process_sub_indicators' => ['height' => '500px']
        ];

        $table_indicators = [
            'context' => [
                'main' => [
                    'c1' => [],
                    'c2' => [],
                    'c3' => []
                ],
                'context_value_and_importance' => [
                    'c11' => [],
                    'c12' => [],
                    'c13' => [],
                    'c14' => [],
                    'c15' => []
                ]
            ],
            'planning' => [
                'main' => [
                    'p1' => [],
                    'p2' => [],
                    'p3' => [],
                    'p4' => [],
                    'p5' => [],
                    'p6' => []
                ]
            ],
            'inputs' => [
                'main' => [
                    'i1' => [],
                    'i2' => [],
                    'i3' => [],
                    'i4' => [],
                    'i5' => []
                ]
            ],
            'process' => [
                'process_sub_indicators' => [
                    'pr15_16' => [],
                    'pr10_12' => [],
                    'pr13_14' => [],
                    'pr17_18' => [],
                    'pr1_6' => [],
                    'pr7_9' => [],
                ]
            ],
            'process_pr1_pr6' => [
                'process_internal_management' => [
                    'pr1' => [],
                    'pr2' => [],
                    'pr3' => [],
                    'pr4' => [],
                    'pr5' => [],
                    'pr6' => [],
                ]
            ],
            'process_pr7_pr9' => [
                'process_management_protection_values' => [
                    'pr7' => [],
                    'pr8' => [],
                    'pr9' => []
                ]
            ],
            'process_pr10_pr12' => [
                'process_stakeholders_relationships' => [
                    'pr10' => [],
                    'pr11' => [],
                    'pr12' => []
                ]
            ],
            'process_pr13_pr14' => [
                'process_tourism_management' => [
                    'pr13' => [],
                    'pr14' => []
                ]
            ],
            'process_pr15_pr16' => [
                'process_monitoring_and_research' => [
                    'pr15' => [],
                    'pr16' => []
                ]
            ],
            'process_pr17_pr18' => [
                'process_effects_of_climate_change' => [
                    'pr17' => [],
                    'pr18' => []
                ]
            ],

            'outputs' => [
                'main' => [
                    'op1' => [],
                    'op2' => [],
                    'op3' => []
                ]
            ],
            'outcomes' => [
                'main' => [
                    'oc1' => [],
                    'oc2' => [],
                    'oc3' => []
                ]
            ]
        ];

        $origType = $type;
        if (str_contains($type, "process")) {
            $origType = explode("_", $type)[0];
        }

        $data = [$type => []];
        $time_start = microtime(true);
        foreach ($table_indicators[$type] as $t => $array) {
            static::reset_areas_ids();
            $data[$type][$t] = static::analysis_diagram_protected_areas($form_ids, $origType, $array, $options[$origType], $type);
        }
        $time_end = microtime(true);
        $execution_time = ($time_end - $time_start);
        return ['status' => 'success', 'data' => $data, 'execution_time' => $execution_time];
    }

    /**
     * @param $indicator
     * @param $value
     * @return float|int
     */
    public static function values_correction($indicator, $value)
    {
        if ($indicator === "c3") {
            return static::round_number((100 + $value) / 3);
        } else if (in_array($indicator, ["c2", "oc2"])) {
            return static::round_number(50 + ((float)$value / 2));
        }
        return static::round_number($value);
    }

    /**
     * @param $data
     * @param $average
     * @param $average_contribution
     * @param $pa
     * @param $colors
     * @param null $options
     * @return array
     */
    public static function average_contribution_calculations($data, &$average, &$average_contribution, $pa, $colors, $options = null, $keep_locale, $label): array
    {
        $average = [];
        $i = 0;
        if (count(array_filter(array_keys($data), 'is_string')) === 0) {
            krsort($data);
        }
        foreach ($data as $index => $value) {
            $v = $index;

            if (is_numeric($index)) {
                $v = (int)$index + 1;
            }
            $values = array_filter(array_values($value), function ($v) {
                return is_numeric($v);
            });
            $percentile_10 = static::round_number(static::get_percentile($values, 10));
            $percentile_90 = static::round_number(static::get_percentile($values, 90));
            $average_value = static::round_number(array_sum($values) / count($values));
            $average[] = $average_value;
            $average_contribution['data']['Average'][$i] = ["value" => $average_value, "upper limit" => [$percentile_10, $percentile_90],
                "label" => trans('imet-core::v2_common.assessment.' . $v), "itemStyle" => ["color" => $colors],
            ];
            if (is_numeric($index)) {
                $average_contribution['data']['Average'][$i]["indicator"] = trans($label . ($v), [], $keep_locale);
            } else {
                $average_contribution['data']['Average'][$i]["indicator"] = static::indicator_label($v, $label);
            }

            $i++;
        }

        $average_contribution['options'] = $options ?? null;

        return $average;
    }

    /**
     * @param $id
     * @param $label
     * @return string
     */
    public static function indicator_label($id, $label): string
    {
        return strtoupper(trans('imet-core::v2_common.assessment.' . $id)[0]) . " " . trans($label . $id);
    }

    private static function get_average(array $array)
    {
        return static::round_number(array_sum($array) / count($array));
    }

    /**
     * @param $form_ids
     * @return array|array[]
     */
    public static function analysis_diagram_protected_areas($form_ids, string $type, array $table_indicators, array $options, $custom_type): array
    {
        $tables = [
            $type => []
        ];

        $colors = [
            'context' => '#ffff00',
            'planning' => '#bfbfbf',
            'inputs' => '#ffc000',
            'process' => '#0099CC',
            'outputs' => '#92D050',
            'outcomes' => '#00B050',
            'context_sub_indicators' => '#ffff00',
            'process_sub_indicators' => '#0099CC'
        ];
        //ranking index vars
        $ranking_values = [];
        $ranking = ['values' => [], 'legends' => [], 'xAxis' => []];

        //average contribution
        $average_contribution = [];
        $data = [$type => []];
        $valuesIndicators = [];

        // radar
        $analysis_diagrams_protected_areas = ['values' => [], 'indicators' => []];
        $indicators = [];

        // generic use
        $results = [];
        $pa = count($form_ids);
        $radar_negative_indicators = ["c2", "c3", "oc2", "oc3"];
        $radar_indicators_for_negative = [];

        //get sub indicators for all imets and filtered them with the sub we want to use in each case
        foreach ($form_ids as $key => $form_id) {
            $results[$form_id] = static::get_sub_indicators_by_context($form_id, $custom_type);
            $filteredArray[$form_id] = array_intersect_key($results[$form_id], $table_indicators);
            array_walk($filteredArray[$form_id], function (&$item, $key) {
                $item = static::round_number($item);
                //echo static::round_number($item)."<br/>";
            });

            //loop through imet sub indicators to create an average value in order to sort in the ranking
            //and pass the correct value where needed
            $filteredArray[$form_id]['avg'] = static::get_average($filteredArray[$form_id]);
//                foreach ($filteredArray[$form_id] as $v => $value) {
//                    $new_value = static::values_correction($v, $value);
//                    $filteredArray[$form_id]['avg'] = ($filteredArray[$form_id]['avg'] ?? 0) + ($new_value ?? 0);
//                }

        }
        //sort the imets per avg value
        uasort($filteredArray, function ($a, $b) {
            return $b['avg'] - $a['avg'];
        });

        $idx = 0;

        //loop the each imet record sorted and get pa name
        //and merge it with the table
        foreach ($filteredArray as $id => $values) {
            $pa = static::getCustomNames($id);
            $protected_area = $pa->name;
            $color = $pa->color;
            $tables[$type][$idx] = [];//array_merge($values, ["name" => $protected_area]);
            $tables[$type][$idx]['name'] = $protected_area;
            $i = 0;
            foreach ($values as $v => $value) {
                if ($v !== "avg") {


                    $name = static::indicator_label($v, 'imet-core::analysis_report.assessment.');
                    $indicators[$i] = $name;
                    $ranking['legends'][$v] = $name;
                    $correction_value = $value;

                    if (in_array($v, $radar_negative_indicators)) {
                        $radar_indicators_for_negative[] = $i;
                        $correction_value = static::values_correction($v, (float)$value);
                    }

                    $ranking_values[$name][] = $correction_value;
                    $tables[$type][$idx][$v] = $value;

                    $data[$type][$v][] = $valuesIndicators[$v][] = $correction_value;
                    $analysis_diagrams_protected_areas['values'][$protected_area][] = $value;
                    $analysis_diagrams_protected_areas['values'][$protected_area]['color'] = $color;
                    $i++;
                }
            }
            $ranking['xAxis'][] = $protected_area;
            $idx++;
        }
        $ranking['values'] = $ranking_values;
        $average = [];
        $keep_locale = App::getLocale();
        static::average_contribution_calculations($data[$type], $average, $average_contribution, $pa, $colors[$type], $options, $keep_locale, 'imet-core::analysis_report.assessment.');

        foreach ($valuesIndicators as $k => $v) {
            $upperLimit[$k] = max($v);
            $lowerLimit[$k] = min($v);
        }

        $upperLimit['lineStyle'] = 'dashed';
        $upperLimit['color'] = 'green';
        $lowerLimit['lineStyle'] = 'dashed';
        $lowerLimit['color'] = 'yellow';
        // end average indicator

        $analysis_diagrams_protected_areas['indicators'] = $indicators;

        return ['table' => $tables[$type], 'ranking' => $ranking,
            'average_contribution' => $average_contribution,
            'radar' => [
                'radar_indicators_for_negative' => $radar_indicators_for_negative,
                'values' => array_merge($analysis_diagrams_protected_areas['values'], [
                    'Average' => array_merge($average, ['color' => 'red', 'legend_selected' => true]),
                    'upper limit' => $upperLimit,
                    'lower limit' => $lowerLimit]), 'indicators' => $analysis_diagrams_protected_areas['indicators']
            ],
        ];
    }


    /**
     * @param $form_ids
     * @param array $assessments
     * @return array
     */
    public
    static function get_protected_areas_diagram_compare($form_ids, array $assessments = [], bool $overall = false): array
    {
        $data = static::get_upper_lower_protected_areas_diagram_compare($form_ids, false, $assessments, $overall);
        unset($data['diagrams']['upper limit']);
        unset($data['diagrams']['lower limit']);

        return $data;
    }

    /**
     * @param $form_ids
     * @param array $assessments
     * @return array[]
     */
    public
    static function get_averages_of_each_indicator_of_six_elements($form_ids, array $assessments = [], $overall = false): array
    {
        $data = static::get_upper_lower_protected_areas_diagram_compare($form_ids, false, $assessments, $overall);
        $response = ['Average' => []];

        $average = $data['data']['diagrams']['Average'];
        $upperLimit = $data['data']['diagrams']['upper limit'];
        $lowerLimit = $data['data']['diagrams']['lower limit'];
        //["value" => $average_value, "upper limit" => [$percentile_10, $percentile_90],
        $response['Average'] = [
            ['value' => $average['outcomes'], 'upper limit' => [$lowerLimit['outcomes'], $upperLimit['outcomes']], 'indicator' => trans('imet-core::v2_common.steps_eval.outcomes'), "itemStyle" => ["color" => '#00B050']],
            ['value' => $average['outputs'], 'upper limit' => [$lowerLimit['outputs'], $upperLimit['outputs']], 'indicator' => trans('imet-core::v2_common.steps_eval.outputs'), "itemStyle" => ["color" => '#92D050']],
            ['value' => $average['process'], 'upper limit' => [$lowerLimit['process'], $upperLimit['process']], 'indicator' => trans('imet-core::v2_common.steps_eval.process'), "itemStyle" => ["color" => '#0099CC']],
            ['value' => $average['inputs'], 'upper limit' => [$lowerLimit['inputs'], $upperLimit['inputs']], 'indicator' => trans('imet-core::v2_common.steps_eval.inputs'), "itemStyle" => ["color" => '#ffc000']],
            ['value' => $average['planning'], 'upper limit' => [$lowerLimit['planning'], $upperLimit['planning']], 'indicator' => trans('imet-core::v2_common.steps_eval.planning'), "itemStyle" => ["color" => '#bfbfbf']],
            ['value' => $average['context'], 'upper limit' => [$lowerLimit['context'], $upperLimit['context']], 'indicator' => trans('imet-core::v2_common.steps_eval.context'), "itemStyle" => ["color" => '#ffff00']]];

        return ['status' => 'success', 'data' => $response];
    }


    /**
     * @param $form_ids
     * @param array $assessment
     * @return array|array[]|\array[][]
     */
    public
    static function get_imet_ranking($form_ids, array $assessment = []): array
    {
        $indicators = [
            'context' => 0,
            'planning' => 0,
            'inputs' => 0,
            'process' => 0,
            'outputs' => 0,
            'outcomes' => 0
        ];

        $colors = [
            'context' => '#ffff00',
            'planning' => '#bfbfbf',
            'inputs' => '#ffc000',
            'process' => '#0099CC',
            'outputs' => '#92D050',
            'outcomes' => '#00B050'
        ];

        $percent = ['values' => [], 'legends' => [], 'xAxis' => []];
        $assessments = count($assessment) ? $assessment : static::get_assessments($form_ids);

        $totalValue = [];

        usort($assessments['data']['assessments'], function ($a, $b) {
            return $b['imet_index'] - $a['imet_index'];
        });

        foreach ($assessments['data']['assessments'] as $key => $assessment) {
            $total = 0;
            foreach ($indicators as $ind => $indicator) {
                $total += static::round_number($assessment[$ind]);

                $indicators[$ind] = static::round_number($assessment[$ind]);
            }
            $totalValue[$assessment['name']] = $total;
            $percent['xAxis'][] = $assessment['name'];
            foreach ($indicators as $ind => $indicator) {
                $label = trans('imet-core::v2_common.steps_eval.' . $ind);
                $percent['legends'][$ind] = $label;

                $percent['values'][$label][] = $totalValue[$assessment['name']] ? static::round_number((((($indicator / $totalValue[$assessment['name']]) * 100) / 100) * $assessment['imet_index'])) : 0;

            }
        }

        return ['status' => 'success', 'data' => ['values' => $percent]];
    }

    /**
     * @param $val
     * @param int $round
     * @return float
     */
    private
    static function round_number($val, int $round = 1)
    {
        if ($val == 100 || $val == 0) {
            return $val;
        }
        if ($val == "0.0") {
            return 0;
        }

        return number_format($val, $round);
    }

    /**
     * @param $form_ids
     * @param bool $width
     * @param array $assessments
     * @return array
     */
    public static function get_upper_lower_protected_areas_diagram_compare($form_ids, bool $width = true, array $assessments = [], $overall = true): array
    {
        $start_time = microtime(true);
        $assessments = count($assessments) ? $assessments : static::get_assessments($form_ids);

        $indicator = [
            'context' => [],
            'outcomes' => [],
            'outputs' => [],
            'process' => [],
            'inputs' => [],
            'planning' => [],
            'imet_index' => []
        ];

        $analysis_diagrams_protected_areas = [];
        $average = ['color' => 'red', 'legend_selected' => true, 'width' => 4];

        $form_ids = array_reverse($form_ids, true);
        $totalProtectedAreas = count($form_ids);

        foreach ($indicator as $indi => $value) {

            foreach ($form_ids as $key => $form_id) {
                $assess = $assessments['data']['assessments'][$key];
                $assess['width'] = '';
                $name = $assess['name'];

                $val = ($assess[$indi]);
                $indicator[$indi][] = $val;

                if ($overall) {
                    $analysis_diagrams_protected_areas[$name][$indi] = $val;
                } else {
                    $analysis_diagrams_protected_areas[$name][] = $val;
                }

                $analysis_diagrams_protected_areas[$name]['color'] = $assess['color'];

                if ($width) {
                    $analysis_diagrams_protected_areas[$name]['width'] = 4;
                }
            }

            if ($overall) {
                $average[$indi] = static::round_number(array_sum($indicator[$indi]) / $totalProtectedAreas);
            } else {
                $average[] = static::round_number(array_sum($indicator[$indi]) / $totalProtectedAreas);
            }
        }

        //get min and max level for each category
        foreach ($indicator as $k => $v) {
            $upperLimit[$k] = max($v);
            $lowerLimit[$k] = min($v);
        }
        $upperLimit['lineStyle'] = 'dashed';
        $upperLimit['width'] = 4;
        $upperLimit['color'] = 'green';

        $lowerLimit['lineStyle'] = 'dashed';
        $lowerLimit['width'] = 4;
        $lowerLimit['color'] = 'black';

        krsort($analysis_diagrams_protected_areas);

        $end_time = microtime(true);
        $execution_time = $end_time - $start_time;

        return ['status' => 'success', 'execution_time' => $execution_time, 'data' => ['diagrams' => array_merge($analysis_diagrams_protected_areas, [
            'Average' => $average, 'upper limit' => $upperLimit, 'lower limit' => $lowerLimit])]];
    }

    /**
     * @param $form_ids
     * @return array
     */
    public
    static function getTotalCarbon($form_ids): array
    {
        $dopa_stats['diagram'] = ['values' => [],
            'keys' => []];
        $dopa_stats = static::get_dopa_pa_all_indicators($form_ids, false);

        foreach ($form_ids as $key => $form_id) {
            $custom = static::getCustomNames($form_id);
            $name = array_key_first($dopa_stats['data'][$form_id]);
            $dopa_stats['diagram']['labels'][] = $custom->name;
            $dopa_stats['diagram']['keys'][] = $custom->name;
            $dopa_stats['diagram']['values'][$custom->name] = count($dopa_stats['data'][$form_id][$name]) > 0 ? $dopa_stats['data'][$form_id][$name][0]->carbon_tot_c_mg : 0;
        }

        uasort($dopa_stats['diagram']['values'], function ($a, $b) {
            return $b - $a;
        });

        usort($dopa_stats['data'], function ($a, $b) {
            $key1 = array_key_first($a);
            $key2 = array_key_first($b);
            return $key1 > $key2;
        });

        return ['status' => 'success', 'data' => $dopa_stats];
    }

    /**
     * @param $form_ids
     * @return array
     */
    public
    static function get_dopa_pa_all_indicators($form_ids, $sorting = true): array
    {
        $dopa_stats = [];
        $api_available = DOPA::apiAvailable();
        if ($api_available) {
            foreach ($form_ids as $key => $form_id) {
                $protected_area = static::getCustomNames($form_id);
                $dopa_stats[$form_id] = [$protected_area['name'] => static::get_all_indicators_without_nulls($protected_area['wdpa_id'])];
            }
        } else {
            return ['status' => false];
        }

        if ($sorting) {
            usort($dopa_stats, function ($a, $b) {
                $key1 = array_key_first($a);
                $key2 = array_key_first($b);
                return $key1 > $key2;
            });
        }

        return ['status' => 'success', 'data' => $dopa_stats];
    }

    /**
     * @param $parameters
     * @param array $assessments
     * @return array
     */
    public
    static function get_grouping_analysis($parameters, array $assessments = []): array
    {
        $groups = [];
        $form_ids = [];
        $colors = ['#5470c6', '#91cc75', '#fac858', '#ee6666', '#73c0de', '#3ba272', '#fc8452', '#9a60b4', '#ea7ccc', '#f8f9fa'];
        $indicator = [
            'context' => [],
            'planning' => [],
            'inputs' => [],
            'process' => [],
            'outputs' => [],
            'outcomes' => []
        ];
        foreach ($parameters as $form) {
            $form_ids[] = $form['id'];
            $groups[$form['group']] = [$form['group'], $form['name']];
        }

        $assessments = count($assessments) ? $assessments : static::get_assessments($form_ids);

        foreach ($indicator as $indi => $value) {
            foreach ($assessments['data']['assessments'] as $assessment) {
                foreach ($parameters as $form) {
                    if ($form['id'] === $assessment['formid']) {
                        $indicator[$indi][$form['group']][] = $assessment[$indi];
                    }
                }
            }
        }
        krsort($groups);

        foreach ($indicator as $indi => $value) {
            foreach ($groups as $key => $group) {
                $average[$group[1]][$indi] = static::round_number(array_sum($indicator[$indi][$key]) / count($indicator[$indi][$key]));
                $average[$group[1]]['color'] = $colors[$group[0] - 1];
                $average[$group[1]]['legend_selected'] = true;
            }
        }
        krsort($average);

        return ['status' => 'success', 'data' => ['radar' => $average]];
    }

    /**
     * @param $parameters
     * @param array $assessments
     * @return array|array[]
     */
    public
    static function get_scatter_grouping_analysis($parameters, array $assessments = [], bool $not_group = false): array
    {
        $groups = [];
        $form_ids = [];
        $colors = ['#5470c6', '#91cc75', '#fac858', '#ee6666', '#73c0de', '#3ba272', '#fc8452', '#9a60b4', '#ea7ccc', '#f8f9fa'];
        $indicator = [
            'context' => [],
            'planning' => [],
            'inputs' => [],
            'process' => [],
            'outputs' => [],
            'outcomes' => []
        ];

        foreach ($parameters as $form) {
            $form_ids[] = $form['id'];
            $groups[$form['group']] = [$form['group'], $form['name'], $form['color'] ?? null];
        }

        $assessments = count($assessments) ? $assessments : static::get_assessments($form_ids);

        foreach ($indicator as $indi => $value) {
            foreach ($assessments['data']['assessments'] as $assessment) {
                foreach ($parameters as $form) {
                    if ($form['id'] === $assessment['formid']) {
                        $indicator[$indi][$form['group']][] = $assessment[$indi];

                    }
                }
            }
        }
        krsort($groups);
        $average = [];

        foreach ($indicator as $indi => $value) {
            $i = 0;

            foreach ($groups as $key => $group) {
                $result = static::round_number(array_sum($value[$key]) / count($value[$key]));
                $average[$group[1]][$indi] = $result;
                if ($not_group) {

                    $group_color = $i;
                    $average[$group[1]]['color'] = $group[2];
                } else {
//                    $average[$group[1]][$indi] = $result;
                    $group_color = $group[0] - 1;
                    $average[$group[1]]['color'] = $colors[$group_color] ?? $colors[9];
                }

                // $average[$group[1]]['color'] = $colors[$group_color] ?? $colors[9];
                $average[$group[1]]['legend_selected'] = true;
                $i++;
            }
        }
        $final_average = [];
        $i = 0;
        foreach ($average as $key => $value) {
            $final_average[$i]['value'][] = static::round_number($value['process']);
            $final_average[$i]['value'][] = static::round_number(($value['context'] + $value['planning'] + $value['inputs']) / 3);
            $final_average[$i]['value'][] = static::round_number(($value['outcomes'] + $value['outputs']) / 2);
            $final_average[$i]['name'] = $key;
            $final_average[$i]['itemStyle']['borderColor'] = $value['color'];
            $final_average[$i]['itemStyle']['color'] = 'transparent';
            $final_average[$i]['itemStyle']['borderWidth'] = '4';
            $final_average[$i]['label'] = ["position" => "inside",
                "color" => $value['color'],
                "backgroundColor" => "transparent",
                "show" => true
            ];
            $i++;
        }

        return ['status' => 'success', 'data' => ['scatter' => $final_average]];
    }


    /**
     * @param $form_ids
     * @return array
     */
    public
    static function get_dopa_pa_ecoregions_terrestial_stats($form_ids): array
    {
        $dopa_pa_ecoregions_stats = [];
        $api_available = DOPA::apiAvailable();
        if ($api_available) {
            foreach ($form_ids as $key => $form_id) {
                $protected_area = static::getCustomNames($form_id);
                $areas = DOPA::get_wdpa_ecoregions($protected_area['wdpa_id']);//DOPA::get_country_ecoregions_stats($protected_area['Country']);//DOPA::get_wdpa_all_inds($protected_area['wdpa_id']);//
                $dopa_pa_ecoregions_stats[$protected_area['name']] = array_filter($areas, function ($value) {
                    return !$value->marine;
                });
                // echo $key;
            }
        } else {
            return ['status' => false];
        }

        ksort($dopa_pa_ecoregions_stats);

        return ['status' => 'success', 'data' => $dopa_pa_ecoregions_stats];

    }

    /**
     * @param $form_ids
     * @return array
     */
    public
    static function get_dopa_pa_ecoregions_marine_stats($form_ids): array
    {
        $dopa_pa_ecoregions_stats = [];
        $api_available = DOPA::apiAvailable();
        if ($api_available) {
            foreach ($form_ids as $key => $form_id) {
                $protected_area = static::getCustomNames($form_id);
                $area = DOPA::get_wdpa_ecoregions($protected_area['wdpa_id']);//;
                $dopa_pa_ecoregions_stats[$protected_area['name']] = array_filter($area, function ($value) {
                    return $value->marine;
                });
            }
        } else {
            return ['status' => false];
        }

        ksort($dopa_pa_ecoregions_stats);

        return ['status' => 'success', 'data' => $dopa_pa_ecoregions_stats];
    }

    /**
     * @param $form_ids
     * @return array
     */
    public
    static function get_dopa_copernicus_land_cover_stats($form_ids): array
    {
        $dopa_stats = [];
        $api_available = DOPA::apiAvailable();
        if ($api_available) {
            foreach ($form_ids as $key => $form_id) {
                $protected_area = static::getCustomNames($form_id);
                $dopa_stats[$protected_area['name']] = DOPA::get_wdpa_copernicus($protected_area['wdpa_id']);
            }
        } else {
            return ['status' => false];
        }

        ksort($dopa_stats);

        return ['status' => 'success', 'data' => $dopa_stats];
    }

    /**
     * @param $form_ids
     * @return array
     */
    public
    static function get_dopa_wdpa_indicators($form_ids): array
    {
        $dopa_stats = [];
        $api_available = DOPA::apiAvailable();
        if ($api_available) {
            foreach ($form_ids as $key => $form_id) {
                $protected_area = static::getCustomNames($form_id);
                $dopa_stats[$protected_area['name']] = static::get_all_indicators_without_nulls($protected_area['wdpa_id']);
            }
        } else {
            return ['status' => false];
        }

        ksort($dopa_stats);

        return ['status' => 'success', 'data' => $dopa_stats];
    }

    /**
     * @param $form_ids
     * @return array
     * @throws \Exception
     */
    public
    static function get_dopa_country_indicators($form_ids): array
    {
        $dopa_stats = [];
        $api_available = DOPA::apiAvailable();
        if ($api_available) {
            foreach ($form_ids as $key => $form_id) {
                $protected_area = static::getCustomNames($form_id);
                $country = Country::getByISO($protected_area['Country']);
                if (!isset($dopa_stats[$country->name_en])) {
                    $dopa_stats[$country->name_en] = DOPA::get_country_all_inds($protected_area['Country']);
                }
            }
        } else {
            return ['status' => false];
        }

        return ['status' => 'success', 'data' => $dopa_stats];
    }


    /**
     * @param $array
     * @param $percentile
     * @return float|int|mixed
     */
    private
    static function get_percentile($array, $percentile)
    {
        sort($array);
        $index = ($percentile / 100) * count($array);
        if (floor($index) == $index) {
            if (isset($array[$index - 1])) {
                $result = ($array[$index - 1] + $array[$index]) / 2;
            } else {
                //todo maybe is wrong i have to discuss it
                //$result = 0;
            }
        } else {
            $result = $array[floor($index)];
        }
        return $result;
    }

    /**
     * @param $form_id
     * @return Imet[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public
    static function get_protected_area_data($form_id, $show_original_names = false)
    {

        if ($show_original_names) {
            $protected_area = Imet::where('FormID', $form_id)->get();
            if (count($protected_area)) {
                return $protected_area[0];
            }
        } else {
            $protected_area = ScalingUpWdpa::getByFormID(static::$scaling_id, $form_id);
            if (($protected_area)) {
                return $protected_area;
            }
        }


        return null;
    }

    public
    static function get_array_of_custom_names($form_ids)
    {
        $protected_area = [];
        foreach ($form_ids as $k => $form_id) {

            $protected_area[$k] = ScalingUpWdpa::getByFormID(static::$scaling_id, $form_id);
        }
        return $protected_area;
    }

    public
    static function getCustomNames($form_id)
    {
        $protected_area = ScalingUpWdpa::getByFormID(static::$scaling_id, $form_id);
        if (($protected_area)) {
            return $protected_area;
        }

        return null;
    }
}
