<?php

use AndreaMarelli\ImetCore\Controllers\Imet\ApiController;
use AndreaMarelli\ImetCore\Controllers\Imet\v2\Controller;
use AndreaMarelli\ImetCore\Models\Imet\v2\Imet;
use AndreaMarelli\ImetCore\Services\Scores\Functions\_Scores;
use AndreaMarelli\ImetCore\Services\Scores\ImetScores;
use AndreaMarelli\ModularForms\Helpers\Template;
use Illuminate\Support\Facades\App;

/** @var string $action */
/** @var Imet $item */
/** @var array $scores */
/** @var array $labels */
/** @var array $key_elements */
/** @var array $report */
/** @var array $wdpa_extent */
/** @var array $dopa_radar */
/** @var array $dopa_indicators */
/** @var array $general_info */
/** @var array $vision */
/** @var array $area */
/** @var bool $connection */
/** @var bool $show_api */
/** @var bool $show_non_wdpa */
/** @var Array $non_wdpa */

// Force Language
if($item->language != App::getLocale()){
    App::setLocale($item->language);
}

?>

@extends('modular-forms::layouts.forms')

@section('content')

    {{--  Heading --}}
    @include('imet-core::components.heading', ['item' => $item])

    {{--  Phase  --}}
    @include('imet-core::components.phase', ['phase' => 'report'])

    <div id="imet_report">

        @if($show_api)
            <div class="module-container">
                <div class="module-header">
                    <div class="module-title">@lang('imet-core::v2_report.general_elements')</div>
                </div>
                <div class="module-body">
                    <div id="map" v-if=connection></div>
                    <div v-else class="dopa_not_available">@lang('imet-core::common.dopa_not_available')</div>
                    <div style="display: flex;">
                        @if($connection)
                            <div id="radar">
                                <dopa_radar data='@json($dopa_radar)'></dopa_radar>
                                &copy;Dopa Services
                            </div>
                        @endif
                        <div>
                            <div>
                                <div class="strong">@lang('imet-core::v2_report.country'):
                                </div>{{ $general_info['Country'] ?? '-' }}</div>
                            <div>
                                <div class="strong">@lang('imet-core::v2_report.name'):
                                </div>{{ $general_info['CompleteName'] ?? '-' }}</div>
                            <div>
                                <div class="strong">@lang('imet-core::v2_report.category'):
                                </div>{{ $general_info['NationalCategory'] ?? '-' }}</div>
                            <div>
                                <div class="strong">@lang('imet-core::v2_report.gazetting'):
                                </div>{{ $general_info['CreationYear'] ?? '-' }}</div>
                            <div>
                                <div class="strong">@lang('imet-core::v2_report.surface'):</div>{{ $area }} [km2]
                            </div>
                            <div>
                                <div class="strong">@lang('imet-core::v2_report.agency'):
                                </div>{{ $general_info['Institution'] ?? '-' }}</div>
                            <div>
                                <div class="strong">@lang('imet-core::v2_report.biome'):
                                </div>{{ $general_info['Biome'] ?? '-' }}</div>
                            <div>
                                <div class="strong">@lang('imet-core::v2_report.main_values_protected'):
                                </div>{{ $general_info['ReferenceTextValues'] ?? '-' }}</div>
                            <div>
                                <div class="strong">@lang('imet-core::v2_report.vision'):
                                </div>{{ $vision['LocalVision'] ?? '-' }}</div>
                            <div>
                                <div class="strong">@lang('imet-core::v2_report.mission'):
                                </div>{{ $vision['LocalMission'] ?? '-' }}</div>
                            <div>
                                <div class="strong">@lang('imet-core::v2_report.objectives'):
                                </div>{{ $vision['LocalObjective'] ?? '-' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @include('imet-core::v2.report.components.non_wdpa', [
            'show_non_wdpa' => $show_non_wdpa,
            'non_wdpa' =>  $non_wdpa
        ])

        <div class="module-container">
            <div class="module-header">
                <div class="module-title">@lang('imet-core::v2_report.evaluation_elements')</div>
            </div>
            <div class="module-body">

                @include('imet-core::components.scores', [
                    'item' => $item,
                    'step' => null,
                    'version' => \AndreaMarelli\ImetCore\Models\Imet\Imet::IMET_V2
                ])

                <table id="global_scores">
                    <tr>
                        <th>@lang('imet-core::common.steps_eval.context')</th>
                        <th>@lang('imet-core::common.steps_eval.planning')</th>
                        <th>@lang('imet-core::common.steps_eval.inputs')</th>
                        <th>@lang('imet-core::common.steps_eval.process')</th>
                        <th>@lang('imet-core::common.steps_eval.outputs')</th>
                        <th>@lang('imet-core::common.steps_eval.outcomes')</th>
                        <th>@lang('imet-core::common.indexes.imet')</th>
                    </tr>
                    <tr>
                        <td class="{!! ApiController::score_class($scores[_Scores::RADAR_SCORES]['context']) !!}" >{{ $scores[_Scores::RADAR_SCORES]['context'] }}</td>
                        <td class="{!! ApiController::score_class($scores[_Scores::RADAR_SCORES]['planning']) !!}" >{{ $scores[_Scores::RADAR_SCORES]['planning'] }}</td>
                        <td class="{!! ApiController::score_class($scores[_Scores::RADAR_SCORES]['inputs']) !!}" >{{ $scores[_Scores::RADAR_SCORES]['inputs'] }}</td>
                        <td class="{!! ApiController::score_class($scores[_Scores::RADAR_SCORES]['process']) !!}" >{{ $scores[_Scores::RADAR_SCORES]['process'] }}</td>
                        <td class="{!! ApiController::score_class($scores[_Scores::RADAR_SCORES]['outputs']) !!}" >{{ $scores[_Scores::RADAR_SCORES]['outputs'] }}</td>
                        <td class="{!! ApiController::score_class($scores[_Scores::RADAR_SCORES]['outcomes']) !!}" >{{ $scores[_Scores::RADAR_SCORES]['outcomes'] }}</td>
                        <td class="{!! ApiController::score_class($scores[_Scores::RADAR_SCORES]['imet_index']) !!}" >{{ $scores[_Scores::RADAR_SCORES]['imet_index'] }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="module-container">
            <div class="module-header">
                <div class="module-title">@lang('imet-core::v2_report.management_context')</div>
            </div>
            <div class="module-body">
                <h5>@lang('imet-core::v2_report.key_species')</h5>
                <ul>
                    @foreach($key_elements['species'] as $elem)
                        <li>{{ $elem }}</li>
                    @endforeach
                </ul>
                @include('imet-core::v2.report.components.editor', ['report' => $report, 'action' => $action, 'field' => 'key_species_comment'])
                <h5>@lang('imet-core::v2_report.terrestial_marine_habitats')</h5>
                <ul>
                    @foreach($key_elements['habitats'] as $elem)
                        <li>{{ $elem }}</li>
                    @endforeach
                </ul>
                @include('imet-core::v2.report.components.editor', ['report' => $report, 'action' => $action, 'field' => 'habitats_comment'])
                <h5>@lang('imet-core::v2_report.climate_change')</h5>
                <ul>
                    @foreach($key_elements['climate_change'] as $elem)
                        <li>{{ $elem }}</li>
                    @endforeach
                </ul>
                @include('imet-core::v2.report.components.editor', ['report' => $report, 'action' => $action, 'field' => 'climate_change_comment'])
                <h5>@lang('imet-core::v2_report.ecosystem_services')</h5>
                <ul>
                    @foreach($key_elements['ecosystem_services'] as $elem)
                        <li>{{ $elem }}</li>
                    @endforeach
                </ul>
                @include('imet-core::v2.report.components.editor', ['report' => $report, 'action' => $action, 'field' => 'ecosystem_services_comment'])
                <h5>@lang('imet-core::v2_report.threats')</h5>
                <ul>
                    @foreach($key_elements['threats'] as $elem)
                        <li>{{ $elem }}</li>
                    @endforeach
                </ul>
                @include('imet-core::v2.report.components.editor', ['report' => $report, 'action' => $action, 'field' => 'threats_comment'])
                @include('imet-core::v2.report.components.table_evaluation', ['scores' => $scores, 'labels' => $labels])
            </div>
        </div>

        <div class="module-container">
            <div class="module-header">
                <div class="module-title">@lang('imet-core::v2_report.management_effectiveness')</div>
            </div>
            <div class="module-body">
                @include('imet-core::v2.report.components.editor', ['report' => $report, 'action' => $action, 'field' => 'analysis'])
                <h5>@lang('imet-core::v2_report.characteristics_elements')</h5>
                <div class="swot">
                    <div>
                        <b>@lang('imet-core::v2_report.strengths')</b>
                        @include('imet-core::v2.report.components.editor', ['report' => $report, 'action' => $action, 'field' => 'strengths_swot'])
                    </div>
                    <div>
                        <b>@lang('imet-core::v2_report.weaknesses')</b>
                        @include('imet-core::v2.report.components.editor', ['report' => $report, 'action' => $action, 'field' => 'weaknesses_swot'])
                    </div>
                    <div>
                        <b>@lang('imet-core::v2_report.opportunities')</b>
                        @include('imet-core::v2.report.components.editor', ['report' => $report, 'action' => $action, 'field' => 'opportunities_swot'])
                    </div>
                    <div>
                        <b>@lang('imet-core::v2_report.threats')</b>
                        @include('imet-core::v2.report.components.editor', ['report' => $report, 'action' => $action, 'field' => 'threats_swot'])
                    </div>
                </div>
            </div>
        </div>

        <div class="module-container">
            <div class="module-header">
                <div class="module-title">@lang('imet-core::v2_report.operation_recommendations')</div>
            </div>
            <div class="module-body">
                @include('imet-core::v2.report.components.editor', ['report' => $report, 'action' => $action, 'field' => 'recommendations'])
            </div>
        </div>

        <div class="module-container">
            <div class="module-header">
                <div class="module-title">@lang('imet-core::v2_report.key_questions')</div>
            </div>
            <div class="module-body">
                <h5>@lang('imet-core::v2_report.management_priorities')</h5>
                @include('imet-core::v2.report.components.editor', ['report' => $report, 'action' => $action, 'field' => 'priorities'])
                <h5>@lang('imet-core::v2_report.operating_budget')</h5>
                @include('imet-core::v2.report.components.editor', ['report' => $report, 'action' => $action, 'field' => 'minimum_budget'])
                <h5>@lang('imet-core::v2_report.additional_funding')</h5>
                @include('imet-core::v2.report.components.editor', ['report' => $report, 'action' => $action, 'field' => 'additional_funding'])
            </div>
        </div>

        @if(true)
            <div class="module-container">
                <div class="module-header">
                    <div class="module-title">Annexes (&copy;Dopa Services)</div>
                </div>
                <div class="module-body">
                    <div>
                        <div v-if=connection>

                            <b>@lang('imet-core::v2_report.forest_cover')</b>
                            <dopa_indicators_table
                                    :title=dopa_indicators.forest_cover.title_table
                                    :indicators=dopa_indicators.forest_cover.indicators
                                    :api_data="api_data"
                            ></dopa_indicators_table>
                            <dopa_chart_bar
                                    :title=dopa_indicators.forest_cover.title_chart
                                    :indicators=dopa_indicators.forest_cover.bar_indicators
                                    :api_data=api_data
                            ></dopa_chart_bar>

                            <hr/>

                            <b>@lang('imet-core::v2_report.total_carbon')</b>
                            <dopa_indicators_table
                                    :title=dopa_indicators.total_carbon.title_table
                                    :indicators=dopa_indicators.total_carbon.indicators
                                    :api_data=api_data
                            ></dopa_indicators_table>


                            <b>@lang('imet-core::v2_report.agricultural_pressure')</b>
                            <dopa_indicators_table
                                    :title=dopa_indicators.agricultural_pressure.title_table
                                    :indicators=dopa_indicators.agricultural_pressure.indicators
                                    :api_data=api_data
                            ></dopa_indicators_table>

                        </div>
                        <div v-else class="dopa_not_available">@lang('imet-core::common.dopa_not_available')</div>
                    </div>
                </div>
            </div>
        @endif

        @if($action==='edit')
            <div class="scrollButtons" v-cloak>
                {{-- Save --}}
                <div class="standalone" v-show=status==='changed'>
                    <form id="imet_report_form" method="post"
                          action="{{ route(Controller::ROUTE_PREFIX . 'report_update', [$item->getKey()]) }}"
                          style="display: inline-block;">
                        @method('PATCH')
                        @csrf
                        <span @click="saveReport">{!! Template::icon('save') !!} {{ ucfirst(trans('modular-forms::common.save')) }}</span>
                    </form>
                </div>
                <div class="standalone" v-show=status==='loading'>
                    <i class="fa fa-spinner fa-spin text-primary-800"></i>
                    {{ ucfirst(trans('modular-forms::common.saving')) }}
                </div>
                <div v-show=status==='saved'
                     class="standalone highlight">{{ ucfirst(trans('modular-forms::common.saved_successfully')) }}!
                </div>
                <div v-show=status==='error'
                     class="standalone error">{{ ucfirst(trans('modular-forms::common.saved_error')) }}!
                </div>

                {{-- Print --}}
                <div class="standalone"
                     @click="printReport">{!! Template::icon('print') !!} {{ ucfirst(trans('modular-forms::common.print')) }}</div>
            </div>
        @endif

    </div>

@endsection

@push('scripts')
    <script>
        new Vue({
            el: '#imet_report',
            data: {
                report: @json($report),
                loading: false,
                error: false,
                status: 'idle',
                connection: {{ $connection ? 'true' : 'false' }},
                report_map: null,
                api_data: @json($dopa_indicators),
                dopa_indicators: {
                    forest_cover: {
                        title_table: "@lang('imet-core::v2_report.forest_cover')",
                        title_chart: '@lang("imet-core::v2_report.forest_cover_percent") (%)',
                        indicators: [
                            {
                                field: 'gfc_treecover_km2',
                                label: '@lang("imet-core::v2_report.forest_cover") [km2]',
                                color: '#5b5b5b'
                            },
                            {
                                field: 'gfc_treecover_perc',
                                label: '@lang("imet-core::v2_report.forest_cover") [%]',
                                color: '#5b5b5b'
                            },
                            {
                                field: 'gfc_loss_km2',
                                label: '@lang("imet-core::v2_report.forest_loss") [km2]',
                                color: '#D9534F'
                            },
                            {
                                field: 'gfc_loss_perc',
                                label: '@lang("imet-core::v2_report.forest_loss") [%]',
                                color: '#D9534F'
                            },
                            {
                                field: 'gfc_gain_km2',
                                label: '@lang("imet-core::v2_report.forest_gain") [km2]',
                                color: '#337AB7'
                            },
                            {
                                field: 'gfc_gain_perc',
                                label: '@lang("imet-core::v2_report.forest_gain") [%]',
                                color: '#337AB7'
                            },
                        ],
                        bar_indicators: [
                            {
                                field: 'gfc_loss_perc',
                                label: '@lang("imet-core::v2_report.forest_loss") [%]',
                                color: '#D9534F'
                            },
                            {
                                field: 'gfc_gain_perc',
                                label: '@lang("imet-core::v2_report.forest_gain") [%]',
                                color: '#337AB7'
                            },
                        ]
                    },
                    total_carbon: {
                        title_table: 'Total carbon',
                        indicators: [
                            {
                                field: 'carbon_min_c_mg',
                                label: '@lang("imet-core::v2_report.min") [Mg]'
                            },
                            {
                                field: 'carbon_mean_c_mg',
                                label: '@lang("imet-core::v2_report.mean") [Mg]'
                            },
                            {
                                field: 'carbon_max_c_mg',
                                label: '@lang("imet-core::v2_report.max") [Mg]'
                            },
                            {
                                field: 'carbon_stdev_c_mg',
                                label: '@lang("imet-core::v2_report.std_dev") [Mg]'
                            },
                            {
                                field: 'carbon_tot_c_mg',
                                label: '@lang("imet-core::v2_report.sum") [Pg]'
                            },
                        ]
                    },
                    agricultural_pressure: {
                        title_table: 'Agricultural pressure',
                        indicators: [
                            {
                                field: 'agri_ind_pa',
                                label: '@lang("imet-core::v2_report.protected_area") [%]'
                            },
                            {
                                field: 'agri_ind_bu',
                                label: '@lang("imet-core::v2_report.unprotected_buffer") [%]'
                            }
                        ]
                    }
                }
            },

            mounted() {
                if (this.connection) {
                    this.loadMap();
                }
            },

            watch: {
                status(value) {
                    let _this = this;
                    if (value === 'saved') {
                        setTimeout(function () {
                            _this.status = 'idle';
                        }, 4000);
                    }
                },
                'report': {
                    handler: function () {
                        this.status = 'changed';
                    },
                    deep: true
                }
            },

            methods: {
                saveReport() {
                    let _this = this;
                    this.status = 'loading';
                    this.loading = true;
                    this.error = false;

                    fetch('{{ route(Controller::ROUTE_PREFIX . 'report_update', ['item' => $item->getKey()]) }}', {
                        method: 'post',
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-Token": window.Laravel.csrfToken,
                        },
                        body: JSON.stringify({
                            _method: 'PATCH',
                            report: this.report
                        })
                    })
                        .then((response) => response.json())
                        .then(function(data){
                            if (!(data.hasOwnProperty('status') && data.status === 'success')) {
                                _this.status = 'error';
                            }
                            _this.status = 'saved';
                        })
                        .catch(function (error) {
                            _this.status = 'error';
                        })
                },

                printReport() {
                    window.print();
                },

                loadMap() {
                    let _this = this;

                    this.report_map = new window.mapboxgl.Map({
                        container: 'map',
                        style: window.BiopamaWDPA.base_layer,
                        center: [30, 0],
                        zoom: 4,
                        minZoom: 2,
                        maxZoom: 12
                    });

                    this.report_map.on('load', function () {
                        window.BiopamaWDPA.addWdpaLayer(_this.report_map, '{{ $item->wdpa_id }}');
                    });
                }
            }
        });

    </script>
@endpush