<?php

namespace App\Models\Imet\ScalingUp;

use App\Http\Controllers\Imet\Assessment;
use App\Http\Controllers\Imet\ImetEvalControllerV2;
use App\Library\API\DOPA\DOPA;
use App\Models\Cache;
use App\Models\Country;
use App\Models\Species\Animal;
use App\Models\Imet\v2\Imet;
use App\Models\Imet\v2\Modules;
use Illuminate\Database\Eloquent\Model;

class ScalingUpAnalysis extends Model
{
    private static $protected_areas_ids = [];
    protected static $ttl = 2;
    protected $table = 'imet.scaling_up';
    protected $fillable = ['wdpas'];
    public $timestamps = false;

    public static function get_scaling_up_by_wdpas($wdpas)
    {
        return static::where('wdpas', $wdpas)->get();
    }

    /**
     * if names are duplicate add the year
     * @param $form_id
     * @param bool $retrieve_area
     * @return Imet|\Illuminate\Database\Eloquent\Builder|mixed
     */
    public static function protected_areas_duplicate_fixes($form_id, $retrieve_area = true)
    {
        $area = static::get_protected_area_data($form_id)[0];
        $area->name = static::add_the_indicator_to_the_field($area->wdpa_id, $area->name, $area->Year);

        return $area;
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
        if (in_array($search_with, static::$protected_areas_ids)) {
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
        $pdas = static::get_protected_area($form_ids);
        foreach ($pdas as $k => $pda) {
            $pdas[$k]['Country_name'] = Country::getByISO($pda['Country']);
        }

        return ['status' => 'success', 'data' => $pdas];
    }

    /**
     * @param $form_ids
     * @return Imet[]|bool|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|mixed
     */
    public static function get_protected_area($form_ids)
    {

        $protected_area = [];
        foreach ($form_ids as $form_id) {
            $protected_area[$form_id] = static::protected_areas_duplicate_fixes($form_id);
        }

        return $protected_area;
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
            $protected_area = static::protected_areas_duplicate_fixes($form_id);
            $name = $protected_area['name'];
            $country = $protected_area['Country'];
            $indicators = DOPA::get_wdpa_all_inds($protected_area['wdpa_id']);
            $protected_areas[] = $protected_area['wdpa_id'];
            if (!isset($country_indicators[$country])) {
                $country_indicators[$country] = DOPA::get_country_all_inds($country);
                foreach ($country_stats as $key => $value) {
                    $country_stats[$key] += $country_indicators[$country][0]->$key ?? 0;
                }
            }
            if (isset($indicators[0])) {
                if ($indicators[0]->is_marine) {
                    $dopa_stats['area_prot_mar_km2'] += $indicators[0]->area_tot_km2;
                } else {
                    $dopa_stats['area_prot_terr_km2'] += $indicators[0]->area_tot_km2;
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
                        //dd($general_info_data);
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
            //dd($networks);
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

        $generalElements['total_surface_protected_areas'] = round($generalElements['total_surface_protected_areas'], 2);
        $generalElements['total_surface_area_of_landscape_protected_areas'] = round($generalElements['total_surface_area_of_landscape_protected_areas'], 2);

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
            $protected_area = static::protected_areas_duplicate_fixes($form_id);

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
        $key_elements['threats_statistics'] = array_slice($array_elements_count['threats_count'],0,5);
        $key_elements['ecosystem_services'] = array_slice($key_elements['ecosystem_services'], 0,10);
        $key_elements['threats'] = array_slice($key_elements['threats'], 0,5);
        return ['status' => 'success', 'data' => ['key_elements' => $key_elements]];
    }

    /**
     * @param $form_ids
     * @return array
     */
    public static function get_threats_categories_per_protected_area($form_ids): array
    {
        $total_categories = [];
        $protected_areas = [];
        $protected_areas_names = [];
        foreach ($form_ids as $j => $form_id) {
            $protected_areas_names[$form_id] = static::protected_areas_duplicate_fixes($form_id)->name;
        }


        foreach ($form_ids as $j => $form_id) {
            $protected_areas[$j] = Modules\Context\MenacesPressions::getStats($form_id);
            foreach ($protected_areas[$j]['category_stats'] as $k => $protected_area) {
                $total_categories[$k][] = ["name" => $protected_areas_names[$form_id], "value" => (-1 * (double)$protected_area)];
            }
        }
        foreach ($total_categories as $k => $cat) {
            usort($cat, function ($a, $b) {
                return $a['value'] < $b['value'];
            });
            $total_categories[$k] = $cat;
        }

        return ['status' => 'success', 'data' => ["values" => $total_categories]];
    }

    /**
     * @param $form_ids
     * @return array|array[]
     */
    public static function get_assessments($form_ids)
    {
        $assessments = [];
        foreach ($form_ids as $k => $form_id) {

            $assessments[$k] = (array)ImetEvalControllerV2::assessment($form_id, 'global', true)->getData();
            $assessments[$k]['name'] = static::add_the_indicator_to_the_field($assessments[$k]['wdpa_id'], $assessments[$k]['name'], $assessments[$k]['year']);
        }

        return ['status' => 'success', 'data' => ['assessments' => $assessments]];
    }

    /**
     * @param $form_ids
     * @return array|array[]
     */
    public static function analysis_diagram_protected_areas($form_ids): array
    {
        $assessments = static::get_assessments($form_ids);
        $analysis_diagrams_protected_areas = $indicator = [
            'context' => [],
            'planning' => [],
            'inputs' => [],
            'process' => [],
            'outputs' => [],
            'outcomes' => []
        ];
        foreach ($indicator as $indi => $value) {
            foreach ($form_ids as $key => $form_id) {
                $assess = $assessments['data']['assessments'][$key];
                $name = $assess['name'];

                $analysis_diagrams_protected_areas[$indi][$name] = $assess[$indi];
            }
            arsort($analysis_diagrams_protected_areas[$indi]);
        }

        return ['status' => 'success', 'data' => $analysis_diagrams_protected_areas];
    }

    /**
     * @param $form_ids
     * @return array
     */
    public static function get_protected_areas_diagram_compare($form_ids): array
    {
        $data = static::get_upper_lower_protected_areas_diagram_compare($form_ids);
        unset($data['diagrams']['upper limit']);
        unset($data['diagrams']['lower limit']);

        return $data;
    }

    /**
     * @param $form_ids
     * @return array[]
     */
    public static function get_averages_of_each_indicator_of_six_elements($form_ids): array

    {
        $data = static::get_upper_lower_protected_areas_diagram_compare($form_ids);
        $response = ['Average' => [],
            'upper limit' => []];

        $average = $data['data']['diagrams']['Average'];
        $upperLimit = $data['data']['diagrams']['upper limit'];
        $lowerLimit = $data['data']['diagrams']['lower limit'];
        $response['Average'] = [$average[0], $average[5], $average[4], $average[3], $average[2], $average[1]];
        $response['upper limit'] = [
            [5, $lowerLimit['outcomes'], $upperLimit['outcomes']],
            [4, $lowerLimit['outputs'], $upperLimit['outputs']],
            [3, $lowerLimit['process'], $upperLimit['process']],
            [2, $lowerLimit['inputs'], $upperLimit['inputs']],
            [1, $lowerLimit['planning'], $upperLimit['planning']],
            [0, $lowerLimit['context'], $upperLimit['context']]
        ];

        return ['status' => 'success', 'data' => $response];
    }

    /**
     * @param $form_ids
     * @return array|\array[][]
     */
    public static function get_average_contribution_by_six_indicators_to_value_and_importance($form_ids): array
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

        $indicators = [
            'context_sub_indicators' => [
                'c14' => [],
                'c15' => [],
                'c12' => [],
                'c13' => [],
                'c11' => []
            ],
            'context' => [
                'c3' => [],
                'c2' => [],
                'c1' => []
            ],
            'planning' => [
                'p6' => [],
                'p5' => [],
                'p4' => [],
                'p3' => [],
                'p2' => [],
                'p1' => []
            ],
            'inputs' => [
                'i2' => [],
                'i1' => [],
                'i5' => [],
                'i3' => [],
                'i4' => []
            ],
            'process' => [
                'pr18' => [],
                'pr17' => [],
                'pr16' => [],
                'pr15' => [],
                'pr14' => [],
                'pr13' => [],
                'pr12' => [],
                'pr11' => [],
                'pr10' => [],
                'pr9' => [],
                'pr8' => [],
                'pr7' => [],
                'pr6' => [],
                'pr5' => [],
                'pr4' => [],
                'pr3' => [],
                'pr2' => [],
                'pr1' => []
            ],
            'process_sub_indicators' => [
                'pr15_16' => [],
                'pr10_12' => [],
                'pr13_14' => [],
                'pr17_18' => [],
                'pr1_6' => [],
                'pr7_9' => [],
            ],
            'outputs' => [
                'op3' => [],
                'op2' => [],
                'op1' => []
            ],
            'outcomes' => [
                'oc3' => [],
                'oc2' => [],
                'oc1' => []
            ]
        ];
        $options = [
            'context' => ['height' => '500px'],
            'planning' => ['height' => '500px'],
            'inputs' => ['height' => '500px'],
            'process' => ['height' => '1700px'],
            'outputs' => ['height' => '500px'],
            'outcomes' => ['height' => '500px'],
            'context_sub_indicators' => ['height' => '500px'],
            'process_sub_indicators' => ['height' => '500px']

        ];
        foreach ($form_ids as $form_id) {
            $all_indicators = [
                'context' => (array)ImetEvalControllerV2::assessment($form_id, 'context')->getData(),
                'planning' => (array)ImetEvalControllerV2::assessment($form_id, 'planning')->getData(),
                'inputs' => (array)ImetEvalControllerV2::assessment($form_id, 'inputs')->getData(),
                'process' => (array)ImetEvalControllerV2::assessment($form_id, 'process')->getData(),
                'outputs' => (array)ImetEvalControllerV2::assessment($form_id, 'outputs')->getData(),
                'outcomes' => (array)ImetEvalControllerV2::assessment($form_id, 'outcomes')->getData()
            ];

            foreach ($indicators as $key => $values) {
                foreach ($values as $index => $value) {
                    $name = $key;
                    if ($key === 'context_sub_indicators') {
                        $name = 'context';
                    } else if ($key === 'process_sub_indicators') {
                        $name = 'process';
                    }

                    if (isset($all_indicators[$name][$index])) {
                        $indicators[$key][$index][] = $all_indicators[$name][$index];
                    }
                }
            }
        }

        $pa = count($form_ids);
        foreach ($indicators as $key => $values) {
            $i = 0;
            foreach ($values as $index => $value) {
                $percentile_10[$index] = static::get_percentile(array_values($value), 10);
                $percentile_90[$index] = static::get_percentile(array_values($value), 90);
                $average = round(array_sum(array_values($value)) / $pa, 2);
                $indicators[$key]['data']['upper limit'][] = [$i, $percentile_10[$index], $percentile_90[$index]];
                $indicators[$key]['data']['Average'][$i] = ["value" => $average, "itemStyle" => ["color" => $colors[$key]]];
                $indicators[$key]['labels'][$index] = trans('form/imet/v2/common.assessment.' . $index)[1];
                $indicators[$key]['options'] = $options[$key] ?? null;
                $i++;
            }
        }

        //return $indicators;
        return ['status' => 'success', 'data' => $indicators];
    }

    /**
     * @param $form_ids
     * @return array|array[]|\array[][]
     */
    public static function get_imet_ranking($form_ids): array
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
        $assessments = static::get_assessments($form_ids);

        $totalValue = [];
        foreach ($assessments['data']['assessments'] as $key => $assessment) {

            $total = 0;
            foreach ($indicators as $ind => $indicator) {
                $total += $assessment[$ind];
                $indicators[$ind] = $assessment[$ind];
            }
            $totalValue[$assessment['name']] = round($total, 2);
            $percent['xAxis'][] = $assessment['name'];
            foreach ($indicators as $ind => $indicator) {
                $label = trans('form/imet/v2/common.steps_eval.' . $ind);
                $percent['legends'][$ind] = $label;
                $percent['values'][$label][] = $totalValue[$assessment['name']] ? round((((($indicator / $totalValue[$assessment['name']]) * 100) / 100) * $assessment['imet_index']), 2) : 0;
            }
        }

        return ['status' => 'success', 'data' => ['values' => $percent]];
    }

    /**
     * @param $form_ids
     * @return array
     */
    public static function get_upper_lower_protected_areas_diagram_compare($form_ids): array
    {
        $assessments = static::get_assessments($form_ids);

        $indicator = [
            'context' => [],
            'outcomes' => [],
            'outputs' => [],
            'process' => [],
            'inputs' => [],
            'planning' => [],

        ];
        $analysis_diagrams_protected_areas = [];
        $average = ['color' => 'red', 'legend_selected' => true];

        $form_ids = array_reverse($form_ids, true);
        $totalProtectedAreas = count($form_ids);

        foreach ($indicator as $indi => $value) {
            foreach ($form_ids as $key => $form_id) {
                $assess = $assessments['data']['assessments'][$key];
                $name = $assess['name'];

                $indicator[$indi][] = $assess[$indi] ?? 0;
                $analysis_diagrams_protected_areas[$name][] = $assess[$indi];
            }
            $average[] = round(array_sum($indicator[$indi]) / $totalProtectedAreas, 2);
        }

        //get max level for each category
        $upperLimit = Assessment::getUpperLimit($indicator);
        $upperLimit['lineStyle'] = 'dashed';
        $upperLimit['color'] = 'green';

        //get min level for each category
        $lowerLimit = Assessment::getLowerLimit($indicator);
        $lowerLimit['lineStyle'] = 'dashed';
        $lowerLimit['color'] = 'yellow';

        return ['status' => 'success', 'data' => ['diagrams' => array_merge($analysis_diagrams_protected_areas, [
            'Average' => $average, 'upper limit' => $upperLimit, 'lower limit' => $lowerLimit])]];
    }

    /**
     * @param $form_ids
     * @return array
     */
    public static function get_dopa_pa_all_indicators($form_ids): array
    {
        $dopa_stats = [];
        $api_available = DOPA::apiAvailable();
        if ($api_available) {
            foreach ($form_ids as $key => $form_id) {
                $protected_area = static::protected_areas_duplicate_fixes($form_id);
                $dopa_stats[$form_id] = [$protected_area['name'] => DOPA::get_wdpa_all_inds($protected_area['wdpa_id'])];
            }
        } else {
            return ['status' => false];
        }

        return ['status' => 'success', 'data' => $dopa_stats];
    }

    /**
     * @param $parameters
     * @return array
     */
    public static function get_grouping_analysis($parameters): array
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

        $assessments = static::get_assessments($form_ids);

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
                $average[$group[1]][] = round(array_sum($indicator[$indi][$key]) / count($indicator[$indi][$key]), 2);
                $average[$group[1]]['color'] = $colors[$group[0] - 1];
                $average[$group[1]]['legend_selected'] = true;
            }
        }
        krsort($average);

        return ['status' => 'success', 'data' => ['radar' => $average]];
    }

    /**
     * @param $parameters
     * @return array|array[]
     */
    public static function get_scatter_grouping_analysis($parameters): array
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

        $assessments = static::get_assessments($form_ids);

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
                $average[$group[1]][$indi] = round(array_sum($indicator[$indi][$key]) / count($indicator[$indi][$key]), 2);
                $average[$group[1]]['color'] = $colors[$group[0] - 1];
                $average[$group[1]]['legend_selected'] = true;

            }
        }

        $final_average = [];
        $i = 0;
        foreach ($average as $key => $value) {

            $final_average[$i]['value'][] = round(($value['context'] + $value['planning'] + $value['inputs']) / 3, 2);
            $final_average[$i]['value'][] = round($value['process'], 2);
            $final_average[$i]['value'][] = round(($value['outcomes'] + $value['outputs']) / 2, 2);
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

        krsort($average);

        return ['status' => 'success', 'data' => ['scatter' => $final_average]];
    }


    /**
     * @param $form_ids
     * @return array
     */
    public static function get_dopa_pa_ecoregions_terrestial_stats($form_ids): array
    {
        $dopa_pa_ecoregions_stats = [];
        $api_available = DOPA::apiAvailable();
        if ($api_available) {
            foreach ($form_ids as $key => $form_id) {
                $protected_area = static::protected_areas_duplicate_fixes($form_id);
                $areas = DOPA::get_wdpa_ecoregions($protected_area['wdpa_id']);//DOPA::get_country_ecoregions_stats($protected_area['Country']);//DOPA::get_wdpa_all_inds($protected_area['wdpa_id']);//
                $dopa_pa_ecoregions_stats[$protected_area['name']] = array_filter($areas, function ($value) {
                    return !$value->marine;
                });
            }
        } else {
            return ['status' => false];
        }

        return ['status' => 'success', 'data' => $dopa_pa_ecoregions_stats];

    }

    /**
     * @param $form_ids
     * @return array
     */
    public static function get_dopa_pa_ecoregions_marine_stats($form_ids): array
    {
        $dopa_pa_ecoregions_stats = [];
        $api_available = DOPA::apiAvailable();
        if ($api_available) {
            foreach ($form_ids as $key => $form_id) {
                $protected_area = static::protected_areas_duplicate_fixes($form_id);
                $area = DOPA::get_wdpa_ecoregions($protected_area['wdpa_id']);//;
                $dopa_pa_ecoregions_stats[$protected_area['name']] = array_filter($area, function ($value) {
                    return $value->marine;
                });
            }
        } else {
            return ['status' => false];
        }

        return ['status' => 'success', 'data' => $dopa_pa_ecoregions_stats];
    }

    /**
     * @param $form_ids
     * @return array
     */
    public static function get_dopa_copernicus_land_cover_stats($form_ids): array
    {
        $dopa_stats = [];
        $api_available = DOPA::apiAvailable();
        if ($api_available) {
            foreach ($form_ids as $key => $form_id) {
                $protected_area = static::protected_areas_duplicate_fixes($form_id);

                $country = Country::getByISO($protected_area['Country']);
                if (!isset($dopa_stats[$country->name_en])) {
                    $dopa_stats[$country->name_en] = DOPA::get_country_lc_copernicus($protected_area['Country']);
                }
            }
        } else {
            return ['status' => false];
        }

        return ['status' => 'success', 'data' => $dopa_stats];
    }

    /**
     * @param $form_ids
     * @return array
     */
    public static function get_dopa_protected_area_associated_pressures($form_ids): array
    {
        $dopa_stats = [];
        $api_available = DOPA::apiAvailable();
        if ($api_available) {
            foreach ($form_ids as $key => $form_id) {
                $protected_area = static::protected_areas_duplicate_fixes($form_id);
                $country = Country::getByISO($protected_area['Country']);
                if (!isset($dopa_stats[$country->name_en])) {
                    $areas = DOPA::get_country_pa_stats($protected_area['Country']);
                    foreach ($areas as $area) {
                        if ($area->wdpaid === $protected_area['wdpa_id']) {
                            if ($area->nature === 'MA') {
                                $area->nature = 'Coastal';
                                $area->color = '#F4B083';

                            } else {
                                $area->nature = 'Terestial';
                                $area->color = '#91ad41';
                            }
                            $dopa_stats[$country->name_en][] = $area;
                        }
                    }

                }
            }
        } else {
            return ['status' => false];
        }

        return ['status' => 'success', 'data' => $dopa_stats];
    }


    /**
     * @param $form_ids
     * @return array
     */
    public static function get_dopa_country_indicators($form_ids): array
    {
        $dopa_stats = [];
        $api_available = DOPA::apiAvailable();
        if ($api_available) {
            foreach ($form_ids as $key => $form_id) {
                $protected_area = static::protected_areas_duplicate_fixes($form_id);
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
    private static function get_percentile($array, $percentile)
    {
        sort($array);
        $index = ($percentile / 100) * count($array);
        if (floor($index) == $index) {
            $result = ($array[$index - 1] + $array[$index]) / 2;
        } else {
            $result = $array[floor($index)];
        }
        return $result;
    }

    /**
     * @param $form_id
     * @return Imet[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function get_protected_area_data($form_id)
    {
        $action = 'get_protected_area_data';
        $cache_key = Cache::buildKey($action, ['form_id' => $form_id]);

        if (($cache_value = Cache::get($cache_key)) !== false) {
            return $cache_value;
        }

        $protected_area = Imet::where('FormID', $form_id)->get();
        Cache::put($cache_key, $protected_area, static::$ttl);

        return $protected_area;
    }
}