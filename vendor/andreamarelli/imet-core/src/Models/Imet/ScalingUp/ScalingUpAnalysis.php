<?php


namespace AndreaMarelli\ImetCore\Models\Imet\ScalingUp;

use AndreaMarelli\ImetCore\Helpers\API\DOPA\DOPA;
use AndreaMarelli\ImetCore\Models\Animal;
use AndreaMarelli\ImetCore\Models\Country;
use AndreaMarelli\ImetCore\Models\Imet\ScalingUp\Sections\AverageContribution;
use AndreaMarelli\ImetCore\Models\Imet\ScalingUp\Sections\DataTable;
use AndreaMarelli\ImetCore\Models\Imet\ScalingUp\Sections\Group;
use AndreaMarelli\ImetCore\Models\Imet\ScalingUp\Sections\Radar;
use AndreaMarelli\ImetCore\Models\Imet\ScalingUp\Sections\Ranking;
use AndreaMarelli\ImetCore\Models\Imet\ScalingUp\Sections\Scatter;
use AndreaMarelli\ImetCore\Models\Imet\v2\Imet;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use AndreaMarelli\ImetCore\Helpers\ScalingUp\Common;
use AndreaMarelli\ModularForms\Helpers\Locale;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;


class ScalingUpAnalysis extends Model
{
    protected static $ttl = 2;
    protected $table = 'imet.scaling_up';
    protected $fillable = ['wdpas'];
    public $timestamps = false;
    public static $scaling_id = null;
    public const UNDEFINED_VALUE = -99999999;

    /**
     * @param string $wdpas
     * @return mixed
     */
    public static function get_scaling_up_by_wdpas(string $wdpas)
    {
        return static::where('wdpas', $wdpas)->get();
    }

    /**
     * get the protected area country
     * @param array $form_ids
     * @return array
     * @throws Exception
     */
    public static function get_protected_area_with_countries(array $form_ids): array
    {
        $items = [];
        foreach ($form_ids as $k => $form_id) {
            $pa = ScalingUpWdpa::getCustomNames($form_id, static::$scaling_id);
            $items[$k] = $pa;
            $items[$k]['Country_name'] = Country::getByISO($pa['Country']);
        }

        uasort($items, function ($a, $b) {
            return strnatcmp($a['name'], $b['name']);
        });

        return ['status' => 'success', 'data' => $items];
    }

    /**
     * get protected area custom names with all the information
     * @param array $form_ids
     * @param bool $show_original_names
     * @return Imet[]|bool|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|mixed
     * @throws \ReflectionException
     */
    public static function get_protected_area(array $form_ids, bool $show_original_names = false): array
    {
        $protected_area = [];
        $categories = [];
        foreach ($form_ids as $form_id) {
            $protected_area[$form_id] = Common::protected_areas_duplicate_fixes($form_id, $show_original_names);
            $general_info = Modules\Context\GeneralInfo::getVueData($form_id);
            if ($general_info['records'][0]) {
                $categories[$form_id] = Common::get_category_of_protected_area($general_info['records'][0]);
            }
        }

        return ["models" => $protected_area, "categories" => $categories];
    }

    /**
     * get general info of protected areas by form ids
     * @param array $form_ids
     * @return \array[][]
     * @throws \ReflectionException
     */
    public static function general_info(array $form_ids): array
    {
        $generalElements = [
            'network' => [],
            'eco_regions' => [],
            'countries' => [],
            'total_surface_protected_areas' => 0,
            'local_mission' => [],
            'local_objective' => [],
            'local_vision' => []
        ];

        foreach ($form_ids as $form_id) {
            $general_info_data = Modules\Context\GeneralInfo::getVueData($form_id);
            $vision_data = Modules\Context\Missions::getModuleRecords($form_id);
            $generalElements['total_surface_protected_areas'] += Modules\Context\Areas::getArea($form_id);

            if ($general_info_data['records'][0]) {
                $general_info = $general_info_data['records'][0];
                $lang = Locale::lower();
                $name = "name_" . (trim($lang) === "" ? "en" : $lang);
                $country_name = Country::getByISO($general_info['Country'])->$name;

                //echo $general_info['Country']."-".$country_name."\n";
                if (!in_array($country_name, $generalElements['countries'])) {
                    $generalElements['countries'][] = $country_name;
                }

                if ($general_info['CompleteName']) {
                    $generalElements['network'][] = $general_info['CompleteName'];
                }

                if ($general_info['Ecoregions']) {
                    $generalElements['eco_regions'][] = $general_info['Ecoregions'];
                }
            }

            if ($vision_data['records'][0]) {
                $vision = $vision_data['records'][0];
                if ($vision['LocalMission']) {
                    $generalElements['local_mission'][] = $general_info_data['records'][0]['CompleteName'];
                }
                if ($vision['LocalObjective']) {
                    $generalElements['local_objective'][] = $general_info_data['records'][0]['CompleteName'];
                }
                if ($vision['LocalVision']) {
                    $generalElements['local_vision'][] = $general_info_data['records'][0]['CompleteName'];
                }
            }
        }

        $generalElements['total_surface_protected_areas'] = Common::round_number($generalElements['total_surface_protected_areas']);
        $generalElements['network'] = array_flip(array_flip($generalElements['network']));
        return ['status' => 'success', 'data' => ['general_info' => $generalElements]];
    }

    /**
     * get management context for protected areas by form ids
     * @param array $form_ids
     * @return \array[][]
     */
    public static function get_management_context(array $form_ids): array
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
            if (static::$scaling_id !== null) {
                $protected_area = ScalingUpWdpa::getCustomNames($form_id, static::$scaling_id);
            } else {
                $protected_area = Imet::where(['FormID' => $form_id])->first();
            }

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
     * get the threats categories for the protected areas by form ids
     * @param array $form_ids
     * @return array
     */
    public static function get_threats_categories_per_protected_area(array $form_ids): array
    {
        $averages = AverageContribution::average_contribution_calculations_threat($form_ids, '#C23531', ['height' => '850px'], 'imet-core::v2_context.MenacesPressions.categories.title', "", static::$scaling_id);
        $ranking = Ranking::ranking_threats_indicators($form_ids, static::$scaling_id);
        $radar = Radar::get_threats_radar_indicators($form_ids, static::$scaling_id);

        return ['status' => 'success', 'data' => ["values" => $radar['total_categories'], 'average_contribution' => $averages['average_contribution'], 'ranking' => $ranking, 'radar' => $radar['radar']]];
    }

    /**
     * get all management effectiveness scores for the protected areas by form ids
     * @param array $form_ids
     * @return array
     */
    public static function get_overall_management_effectiveness_scores(array $form_ids): array
    {
        $time_start = microtime(true);
        $assessments = [];
        $synthetic_indicators_table = Common::get_assessments($form_ids, static::$scaling_id);
        $assessments['data'] = $synthetic_indicators_table['data'];
        $index_ranking = Ranking::get_overall_ranking($form_ids, $assessments);
        $radars = static::get_protected_areas_diagram_compare($form_ids, $assessments, true);
        $averages_six_elements = static::get_averages_of_each_indicator_of_six_elements($form_ids, $assessments, true);
        Common::reset_areas_ids();
        $scatter_plots = static::get_scatter_grouping_analysis(array_map(function (int $value): array {
            $pa = ScalingUpWdpa::getCustomNames($value, static::$scaling_id);
            return ['id' => $value, 'group' => $value, 'name' => $pa['name'], 'color' => $pa['color']];
        }, $form_ids), $assessments, true);

        $time_end = microtime(true);
        $execution_time = ($time_end - $time_start);

        return [
            'status' => 'success',
            'execution_time' => $execution_time,
            'data' => [
                'ranking' => $index_ranking['data']['values'],
                'averages_six_elements' => $averages_six_elements['data'],
                'radar' => $radars['data']['diagrams'],
                'scatter' => $scatter_plots['data']['scatter'],
                'assessments' => $assessments['data']['assessments']
            ]
        ];
    }

    /**
     * @param array $form_ids
     * @return array
     */
    public static function analysis_per_element_of_the_management_cycle(array $form_ids): array
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
                    'op3' => [],
                    'op4' => []
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
        $extra_type_words = '';
        if (str_contains($type, "process")) {
            $name = explode("_", $type);
            if (count($name) > 1) {
                $extra_type_words = $name[1] . "_" . $name[2] ?? '';
            }
            $origType = $name[0];
        }

        $data = [$type => []];
        $time_start = microtime(true);
        foreach ($table_indicators[$type] as $t => $array) {
            Common::reset_areas_ids();
            $data[$type][$t] = static::analysis_diagram_protected_areas($form_ids, $origType, $array, $options[$origType], $type, $extra_type_words);
        }
        $time_end = microtime(true);
        $execution_time = ($time_end - $time_start);
        return ['status' => 'success', 'data' => $data, 'execution_time' => $execution_time];
    }


    /**
     * @param array $form_ids
     * @param string $type
     * @param array $table_indicators
     * @param array $options
     * @param string $custom_type
     * @return array|array[]
     */
    private static function analysis_diagram_protected_areas(array $form_ids, string $type, array $table_indicators, array $options, string $custom_type, string $extra_type_words = ''): array
    {
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

        //radar data
        $radar = Radar::get_radar_analysis_indicators($form_ids, $table_indicators, $type, $colors[$type], $options, "", static::$scaling_id);

        //table data
        $tables = DataTable::get_datatable_analysis_indicators($form_ids, $table_indicators, $type, static::$scaling_id, true);

        //radar data
        $ranking = Ranking::ranking_indicators($form_ids, $type, $table_indicators, static::$scaling_id);
        //average data
        $averages = AverageContribution::average_contribution_calculations($form_ids, $table_indicators, $type, $colors[$type], $options, 'imet-core::analysis_report.assessment.', $custom_type);

        return [
            'table' => $tables['table'],
            'ranking' => $ranking,
            'average_contribution' => $averages['average_contribution'],
            'radar' => $radar
        ];
    }

    /**
     * @param array $form_ids
     * @param array $assessments
     * @param bool $overall
     * @return array
     */
    public static function get_protected_areas_diagram_compare(array $form_ids, array $assessments = [], bool $overall = false): array
    {
        $data = Radar::get_radar_indicators($form_ids, false, $assessments, $overall, static::$scaling_id);
        unset($data['diagrams']['upper limit']);
        unset($data['diagrams']['lower limit']);

        return $data;
    }

    /**
     * @param array $form_ids
     * @param array $assessments
     * @param bool $overall
     * @param int $scaling_id
     * @return array[]
     */
    public static function get_averages_of_each_indicator_of_six_elements(array $form_ids, array $assessments = [], bool $overall = false, int $scaling_id = 0): array
    {
        $id = $scaling_id;
        if (static::$scaling_id) {
            $id = static::$scaling_id;
        }
        $locale = App::getLocale();
        $data = Radar::get_radar_indicators($form_ids, false, $assessments, $overall, $id);
        $response = ['Average' => []];

        $average = $data['data']['diagrams']['Average'];
        $upperLimit = $data['data']['diagrams']['upper limit'];
        $lowerLimit = $data['data']['diagrams']['lower limit'];

        App::setLocale($locale);
        $response['Average'] = [
            ['value' => $average['outcomes'], 'upper limit' => [$lowerLimit['outcomes'], $upperLimit['outcomes']], 'indicator_raw' => 'outcomes', 'indicator' => trans('imet-core::common.steps_eval.outcomes'), "itemStyle" => ["color" => '#00B050']],
            ['value' => $average['outputs'], 'upper limit' => [$lowerLimit['outputs'], $upperLimit['outputs']], 'indicator_raw' => 'outputs', 'indicator' => trans('imet-core::common.steps_eval.outputs'), "itemStyle" => ["color" => '#92D050']],
            ['value' => $average['process'], 'upper limit' => [$lowerLimit['process'], $upperLimit['process']], 'indicator_raw' => 'process', 'indicator' => trans('imet-core::common.steps_eval.process'), "itemStyle" => ["color" => '#0099CC']],
            ['value' => $average['inputs'], 'upper limit' => [$lowerLimit['inputs'], $upperLimit['inputs']], 'indicator_raw' => 'inputs', 'indicator' => trans('imet-core::common.steps_eval.inputs'), "itemStyle" => ["color" => '#ffc000']],
            ['value' => $average['planning'], 'upper limit' => [$lowerLimit['planning'], $upperLimit['planning']], 'indicator_raw' => 'planning', 'indicator' => trans('imet-core::common.steps_eval.planning'), "itemStyle" => ["color" => '#bfbfbf']],
            ['value' => $average['context'], 'upper limit' => [$lowerLimit['context'], $upperLimit['context']], 'indicator_raw' => 'context', 'indicator' => trans('imet-core::common.steps_eval.context'), "itemStyle" => ["color" => '#ffff00']]];

        $response['legends'] = [
            'Synthetic indicators',
            'Variability',
        ];
        return ['status' => 'success', 'data' => $response];
    }

    /**
     * @param array $form_ids
     * @param bool $width
     * @param array $assessments
     * @param bool $overall
     * @return array
     */
    public static function get_upper_lower_protected_areas_diagram_compare(array $form_ids, bool $width = true, array $assessments = [], bool $overall = true): array
    {
        $start_time = microtime(true);

        $radar = Radar::get_radar_indicators($form_ids, $width, $assessments, $overall, static::$scaling_id);
        $end_time = microtime(true);
        $execution_time = $end_time - $start_time;
        return array_merge(
            $radar, ['execution_time' => $execution_time]
        );
    }

    /**
     * @param array $form_ids
     * @return array
     */
    public static function get_total_carbon(array $form_ids): array
    {
        $dopa_stats['diagram'] = ['values' => [],
            'keys' => []];
        $dopa_stats = static::get_dopa_pa_all_indicators($form_ids, false);

        foreach ($form_ids as $key => $form_id) {
            $custom = ScalingUpWdpa::getCustomNames($form_id, static::$scaling_id);
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
     * @param array $form_ids
     * @param bool $sorting
     * @return array
     */
    public static function get_dopa_pa_all_indicators(array $form_ids, bool $sorting = true): array
    {
        $dopa_stats = [];
        $api_available = DOPA::apiAvailable();
        if ($api_available) {
            foreach ($form_ids as $key => $form_id) {
                $protected_area = ScalingUpWdpa::getCustomNames($form_id, static::$scaling_id);
                $wdpa_id = $protected_area['wdpa_id'];
                $dopa_stats[$form_id] = [$protected_area['name'] => static::get_all_indicators_without_nulls($wdpa_id)];
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
     * @param array $parameters
     * @param array $assessments
     * @return array
     */
    public static function get_grouping_analysis(array $parameters, array $assessments = []): array
    {
        $average = Group::get_calculation_grouping_analysis($parameters, $assessments, static::$scaling_id);

        foreach ($average as $key => $value) {
            $average[$key]['legend_selected'] = true;
        }

        return ['status' => 'success', 'data' => ['radar' => $average]];
    }


    /**
     * @param array $parameters
     * @param array $assessments
     * @param bool $not_grouped
     * @return array|array[]
     */
    public static function get_scatter_grouping_analysis(array $parameters, array $assessments = [], bool $not_grouped = false): array
    {
        return Scatter::get_scatter_grouping_analysis($parameters, $assessments, $not_grouped, static::$scaling_id);
    }


    /**
     * @param array $form_ids
     * @return array
     */
    public static function get_dopa_pa_ecoregions_terrestial_stats(array $form_ids): array
    {
        $dopa_pa_ecoregions_stats = [];
        $api_available = DOPA::apiAvailable();
        if ($api_available) {
            foreach ($form_ids as $key => $form_id) {
                $protected_area = ScalingUpWdpa::getCustomNames($form_id, static::$scaling_id);
                $areas = DOPA::get_wdpa_ecoregions($protected_area['wdpa_id']);
                $dopa_pa_ecoregions_stats[$protected_area['name']] = array_filter($areas, function ($value) {
                    return !$value->marine;
                });
            }
        } else {
            return ['status' => false];
        }

        ksort($dopa_pa_ecoregions_stats);

        return ['status' => 'success', 'data' => $dopa_pa_ecoregions_stats];
    }

    /**
     * @param array $form_ids
     * @return array
     */
    public static function get_dopa_pa_ecoregions_marine_stats(array $form_ids): array
    {
        $dopa_pa_ecoregions_stats = [];
        $api_available = DOPA::apiAvailable();
        if ($api_available) {
            foreach ($form_ids as $key => $form_id) {
                $protected_area = ScalingUpWdpa::getCustomNames($form_id, static::$scaling_id);
                $area = DOPA::get_wdpa_ecoregions($protected_area['wdpa_id']);
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
     * @param array $form_ids
     * @return array
     */
    public static function get_dopa_copernicus_land_cover_stats(array $form_ids): array
    {
        $dopa_stats = [];
        $api_available = DOPA::apiAvailable();

        if ($api_available) {
            foreach ($form_ids as $key => $form_id) {
                $protected_area = ScalingUpWdpa::getCustomNames($form_id, static::$scaling_id);
                $dopa_stats[$protected_area['name']] = DOPA::get_wdpa_copernicus($protected_area['wdpa_id']);
            }
        } else {
            return ['status' => false];
        }

        ksort($dopa_stats);

        return ['status' => 'success', 'data' => $dopa_stats];
    }

    /**
     * @param array $form_ids
     * @return array
     */
    public static function get_dopa_wdpa_indicators(array $form_ids): array
    {
        $dopa_stats = [];
        $api_available = DOPA::apiAvailable();
        if ($api_available) {
            foreach ($form_ids as $key => $form_id) {
                $protected_area = ScalingUpWdpa::getCustomNames($form_id, static::$scaling_id);
                $dopa_stats[$protected_area['name']] = static::get_all_indicators_without_nulls($protected_area['wdpa_id']);
            }
        } else {
            return ['status' => false];
        }

        ksort($dopa_stats);

        return ['status' => 'success', 'data' => $dopa_stats];
    }

    /**
     * @param array $form_ids
     * @return array
     * @throws Exception
     */
    public static function get_dopa_country_indicators(array $form_ids): array
    {
        $dopa_stats = [];
        $api_available = DOPA::apiAvailable();
        if ($api_available) {
            foreach ($form_ids as $key => $form_id) {
                $protected_area = ScalingUpWdpa::getCustomNames($form_id, static::$scaling_id);
                $country = Country::getByISO($protected_area['Country']);
                $country_name = $country->name_en;
                if (!isset($dopa_stats[$country_name])) {
                    $dopa_stats[$country_name] = DOPA::get_country_all_inds($protected_area['Country']);
                }
            }
        } else {
            return ['status' => false];
        }

        return ['status' => 'success', 'data' => $dopa_stats];
    }


    /**
     * @param array $form_ids
     * @return array
     */
    public static function get_array_of_custom_names(array $form_ids): array
    {
        $protected_area = [];
        foreach ($form_ids as $k => $form_id) {
            $protected_area[$k] = ScalingUpWdpa::getByFormID(static::$scaling_id, $form_id);
        }
        return $protected_area;
    }

    /**
     * @param int $wdpa_id
     * @return array
     */
    private static function get_all_indicators_without_nulls(int $wdpa_id): array
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
     * @param array $form_ids
     * @return array|array[]
     */
    public static function get_assessments(array $form_ids): array
    {
        return Common::get_assessments($form_ids, static::$scaling_id);
    }
}
