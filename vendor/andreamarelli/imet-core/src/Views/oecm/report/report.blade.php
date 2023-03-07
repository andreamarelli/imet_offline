<?php
/** @var string $action */

/** @var \AndreaMarelli\ImetCore\Models\Imet\oecm\Imet $item */
/** @var array $assessment */
/** @var array $key_elements */
/** @var array $report */
/** @var array $dopa_radar */
/** @var array $general_info */
/** @var array $vision */
/** @var array $area */
/** @var bool $connection */
/** @var bool $show_api */
/** @var bool $show_non_wdpa */
/** @var Array $non_wdpa */

// Force Language
use Illuminate\Support\Facades\App;

if ($item->language != App::getLocale()) {
    App::setLocale($item->language);
}

?>

@extends('layouts.admin')

@include('imet-core::components.breadcrumbs_and_page_title')

@section('content')

    <div id="imet_report">

        @include('imet-core::components.heading', ['phase' => 'report'])

        @if($show_api)
            <div class="module-container">
                <div class="module-header">
                    <div class="module-title">@lang('imet-core::oecm_report.general_elements')</div>
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
                                <div class="strong">@lang('imet-core::oecm_report.country'):</div>
                                {{ $general_info['Country'] ?? '-' }}
                            </div>
                            <div>
                                <div class="strong">@lang('imet-core::oecm_report.name'):</div>
                                {{ $general_info['CompleteName'] ?? '-' }}
                            </div>
                            <div>
                                <div class="strong">@lang('imet-core::oecm_report.gazetting'):</div>
                                {{ $general_info['CreationYear'] ?? '-' }}
                            </div>
                            <div>
                                <div class="strong">@lang('imet-core::oecm_report.surface'):</div>
                                {{ $area }} [km2]
                            </div>
                            <div>
                                <div class="strong">@lang('imet-core::oecm_report.agency'):</div>
                                {{ $general_info['Institution'] ?? '-' }}
                            </div>
                            <div>
                                <div class="strong">@lang('imet-core::oecm_report.main_values_protected'):</div>
                                {{ $general_info['ReferenceTextValues'] ?? '-' }}
                            </div>
                            <div>
                                <div class="strong">@lang('imet-core::oecm_report.vision'):</div>
                                {{ $vision['LocalVision'] ?? '-' }}
                            </div>
                            <div>
                                <div class="strong">@lang('imet-core::oecm_report.mission'):</div>
                                {{ $vision['LocalMission'] ?? '-' }}
                            </div>
                            <div>
                                <div class="strong">@lang('imet-core::oecm_report.objectives'):</div>
                                {{ $vision['LocalObjective'] ?? '-' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @include('imet-core::oecm.report.components.non_wdpa', [
            'show_non_wdpa' => $show_non_wdpa,
            'non_wdpa' =>  $non_wdpa
        ])

        <div class="module-container">
            <div class="module-header">
                <div class="module-title">@lang('imet-core::oecm_report.management_context')</div>
            </div>
            <div class="module-body">
                <h5>@lang('imet-core::oecm_report.key_elements')</h5>
                <ul>
                    @foreach($key_elements as $elem)
                        <li>{{ $elem }}</li>
                    @endforeach
                </ul>

                @include('imet-core::oecm.report.components.editor', ['report' => $report, 'action' => $action, 'field' => 'key_elements_comment'])

            </div>
        </div>
        <div class="module-container">
            <div class="module-header">
                <div class="module-title">@lang('imet-core::oecm_report.evaluation_elements')</div>
            </div>

            <div class="module-body">
                <imet_charts
                    form_id={{ $item->getKey() }}  :labels='@json(\AndreaMarelli\ImetCore\Services\Statistics\OEMCStatisticsService::steps_labels())'
                    :show_histogram="true" :version="'oecm'"></imet_charts>
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
                        <td {!! \AndreaMarelli\ImetCore\Controllers\Imet\Traits\Assessment::score_class($assessment['global']['context']) !!} >{{ $assessment['global']['context'] }}</td>
                        <td {!! \AndreaMarelli\ImetCore\Controllers\Imet\Traits\Assessment::score_class($assessment['global']['planning']) !!} >{{ $assessment['global']['planning'] }}</td>
                        <td {!! \AndreaMarelli\ImetCore\Controllers\Imet\Traits\Assessment::score_class($assessment['global']['inputs']) !!} >{{ $assessment['global']['inputs'] }}</td>
                        <td {!! \AndreaMarelli\ImetCore\Controllers\Imet\Traits\Assessment::score_class($assessment['global']['process']) !!} >{{ $assessment['global']['process'] }}</td>
                        <td {!! \AndreaMarelli\ImetCore\Controllers\Imet\Traits\Assessment::score_class($assessment['global']['outputs']) !!} >{{ $assessment['global']['outputs'] }}</td>
                        <td {!! \AndreaMarelli\ImetCore\Controllers\Imet\Traits\Assessment::score_class($assessment['global']['outcomes']) !!} >{{ $assessment['global']['outcomes'] }}</td>
                        <td {!! \AndreaMarelli\ImetCore\Controllers\Imet\Traits\Assessment::score_class($assessment['global']['imet_index']) !!} >{{ $assessment['global']['imet_index'] }}</td>
                    </tr>
                </table>
                @include('imet-core::oecm.report.components.table_evaluation', ['assessment' => $assessment])
            </div>
        </div>
        <div class="module-container">
            <div class="module-header">
                <div class="module-title">@lang('imet-core::oecm_report.management_effectiveness')</div>
            </div>
            <div class="module-body">
                @include('imet-core::v2.report.components.editor', ['report' => $report, 'action' => $action, 'field' => 'analysis'])
                <h5>@lang('imet-core::oecm_report.characteristics_elements')</h5>
                <div class="swot">
                    <div>
                        <b>@lang('imet-core::oecm_report.strengths')</b>
                        @include('imet-core::oecm.report.components.editor', ['report' => $report, 'action' => $action, 'field' => 'strengths_swot'])
                    </div>
                    <div>
                        <b>@lang('imet-core::oecm_report.weaknesses')</b>
                        @include('imet-core::oecm.report.components.editor', ['report' => $report, 'action' => $action, 'field' => 'weaknesses_swot'])
                    </div>
                    <div>
                        <b>@lang('imet-core::oecm_report.opportunities')</b>
                        @include('imet-core::oecm.report.components.editor', ['report' => $report, 'action' => $action, 'field' => 'opportunities_swot'])
                    </div>
                    <div>
                        <b>@lang('imet-core::oecm_report.threats')</b>
                        @include('imet-core::oecm.report.components.editor', ['report' => $report, 'action' => $action, 'field' => 'threats_swot'])
                    </div>
                </div>
            </div>
        </div>
        <div class="module-container">
            <div class="module-header">
                <div class="module-title">@lang('imet-core::oecm_report.key_questions')</div>
            </div>
            <div class="module-body">
                <h5>@lang('imet-core::oecm_report.management_priorities')</h5>
                @include('imet-core::oecm.report.components.editor', ['report' => $report, 'action' => $action, 'field' => 'priorities'])
                <h5>@lang('imet-core::oecm_report.operating_budget')</h5>
                @include('imet-core::oecm.report.components.editor', ['report' => $report, 'action' => $action, 'field' => 'minimum_budget'])
                <h5>@lang('imet-core::oecm_report.additional_funding')</h5>
                @include('imet-core::oecm.report.components.editor', ['report' => $report, 'action' => $action, 'field' => 'additional_funding'])
            </div>
        </div>
        <div class="module-container">
            <div class="module-header">
                <div class="module-title">@lang('imet-core::oecm_report.table_of_planning')</div>
            </div>
            <div class="module-body">
                <h5>@lang('imet-core::oecm_report.previous_state')</h5>
                @include('imet-core::oecm.report.components.editor', ['report' => $report, 'action' => $action, 'field' => 'previous_state'])
                <h5>@lang('imet-core::oecm_report.driving_forces')</h5>
                <ul>
                    @foreach($main_threats as $elem)
                        <li>{{ $elem }}</li>
                    @endforeach
                    @foreach($climate_change as $elem)
                        <li>{{ $elem }}</li>
                    @endforeach
                </ul>
                <h5>@lang('imet-core::oecm_report.impacts')</h5>
                @include('imet-core::oecm.report.components.editor', ['report' => $report, 'action' => $action, 'field' => 'impacts'])
                <h5>@lang('imet-core::oecm_report.current_state')</h5>
                <ul>
                    @foreach($status as $elem)
                        <li>{{ $elem }}</li>
                    @endforeach
                </ul>
                @include('imet-core::oecm.report.components.editor', ['report' => $report, 'action' => $action, 'field' => 'current_state'])
                <h5>@lang('imet-core::oecm_report.responses')</h5>
                @include('imet-core::oecm.report.components.editor', ['report' => $report, 'action' => $action, 'field' => 'responses'])
                <h5>@lang('imet-core::oecm_report.expected_conditions')</h5>
                <ul>
                    @foreach($status as $elem)
                        <li>{{ $elem }}</li>
                    @endforeach
                </ul>
                @include('imet-core::oecm.report.components.editor', ['report' => $report, 'action' => $action, 'field' => 'expected_conditions'])
            </div>
        </div>

        <div class="module-container">
            <div class="module-header">
                <div class="module-title">@lang('imet-core::oecm_report.possible_roadmap')</div>
            </div>
            <div class="module-body">
                <div class="row">
                    <div class="col-6">
                        <h3>@lang('imet-core::oecm_report.long_term_objectives')</h3>
                    </div>
                    <div class="col"><h5>@lang('imet-core::oecm_report.year') 1</h5></div>
                    <div class="col"><h5>@lang('imet-core::oecm_report.year') 2</h5></div>
                    <div class="col"><h5>@lang('imet-core::oecm_report.year') 3</h5></div>
                    <div class="col"><h5>@lang('imet-core::oecm_report.year') 4</h5></div>
                    <div class="col"><h5>@lang('imet-core::oecm_report.year') 5</h5></div>
                </div>
                <div class="row">
                    <div class="col-6">
                        @include('imet-core::oecm.report.components.editor', ['report' => $report, 'action' => $action, 'field' => 'long_term'])
                    </div>
                    @foreach([1,2,3,4,5] as $year)
                        <div class="col">
                            <checkbox-boolean v-model="report.long_term_year{{$year}}"
                                              :id="'long_term_year{{$year}}'"></checkbox-boolean>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col">
                        <h5>@lang('imet-core::oecm_report.outcome')</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        @include('imet-core::oecm.report.components.editor', ['report' => $report, 'action' => $action, 'field' => 'outcome'])
                    </div>
                    @foreach([1,2,3,4,5] as $year)
                        <div class="col">
                            <checkbox-boolean v-model="report.outcome_year{{$year}}"
                                              :id="'outcome_year{{$year}}'"></checkbox-boolean>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col">
                        <h3>@lang('imet-core::oecm_report.annual_multi_annual_targets')</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        @include('imet-core::oecm.report.components.editor', ['report' => $report, 'action' => $action, 'field' => 'annual_targets'])
                    </div>
                    @foreach([1,2,3,4,5] as $year)
                        <div class="col">
                            <checkbox-boolean v-model="report.annual_targets_year{{$year}}"
                                              :id="'annual_targets_year{{$year}}'"></checkbox-boolean>
                        </div>
                    @endforeach
                </div>
                @foreach([1,2] as $intervention)
                    <div class="row">
                        <div class="col">
                            <h4>@lang('imet-core::oecm_report.intervention') {{$intervention}}</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            @include('imet-core::oecm.report.components.editor', ['report' => $report, 'action' => $action, 'field' => 'intervention'.$intervention])
                        </div>
                        @foreach([1,2,3,4,5] as $year)
                            <div class="col">
                                <checkbox-boolean v-model="report.intervention{{$intervention}}_year{{$year}}"
                                                  :id="'intervention{{$intervention}}_year{{$year}}'"></checkbox-boolean>
                            </div>
                        @endforeach
                    </div>
                    @foreach([1,2] as $activity)
                        <div class="row">
                            <div class="col-5">
                                <h5>@lang('imet-core::oecm_report.activity') {{$activity}}</h5>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                @include('imet-core::oecm.report.components.editor', ['report' => $report, 'action' => $action, 'field' => 'intervention'.$intervention.'_activity'.$activity])
                            </div>
                            @foreach([1,2,3,4,5] as $year)
                                <div class="col">
                                    <checkbox-boolean
                                        v-model="report.intervention{{$intervention}}_activity{{$activity}}_year{{$year}}"
                                        :id="'intervention{{$intervention}}_activity{{$activity}}_year{{$year}}'"></checkbox-boolean>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                    <div class="row">
                        <div class="col">
                            <h5>@lang('imet-core::oecm_report.other') </h5>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            @include('imet-core::oecm.report.components.editor', ['report' => $report, 'action' => $action, 'field' => 'intervention'.$intervention.'_other'])
                        </div>

                        @foreach([1,2,3,4,5] as $year)
                            <div class="col">
                                <checkbox-boolean class="field-edit" v-model="report.intervention{{$intervention}}_other_year{{$year}}"
                                                  v-bind:id="'intervention{{$intervention}}_other_year{{$year}}'"></checkbox-boolean>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>

        @if($action==='edit')
            <div class="scrollButtons" v-cloak>
                {{-- Save --}}
                <div class="standalone" v-show=status==='changed'>
                    <form id="imet_report_form" method="post"
                          action="{{ route(\AndreaMarelli\ImetCore\Controllers\Imet\v2\Controller::ROUTE_PREFIX . 'report_update', [$item->getKey()]) }}"
                          style="display: inline-block;">
                        @method('PATCH')
                        @csrf
                        <span
                            @click="saveReport">{!! \AndreaMarelli\ModularForms\Helpers\Template::icon('save') !!} {{ ucfirst(trans('modular-forms::common.save')) }}</span>
                    </form>
                </div>
                <div class="standalone" v-show=status==='loading'>
                    <i class="fa fa-spinner fa-spin green_dark"></i>
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
                     @click="printReport">{!! \AndreaMarelli\ModularForms\Helpers\Template::icon('print') !!} {{ ucfirst(trans('modular-forms::common.print')) }}</div>
            </div>
        @endif

    </div>



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
                    window.axios({
                        method: 'post',
                        url: '{{ route(\AndreaMarelli\ImetCore\Controllers\Imet\oecm\Controller::ROUTE_PREFIX . 'report_update', ['item' => $item->getKey()]) }}',
                        data: {
                            _token: window.Laravel.csrfToken,
                            _method: 'PATCH',
                            report: this.report
                        }
                    })
                        .then(function (response) {
                            if (!(response.data.hasOwnProperty('status') && response.data.status === 'success')) {
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
                    let biopamaBaseLayer = 'mapbox://styles/jamesdavy/cjw25laqe0y311dqulwkvnfoc';
                    let mapPolyHostURL = "https://tiles.biopama.org/BIOPAMA_poly";
                    let mapPaLayer = "2021_July_ACP";

                    this.report_map = new window.mapboxgl.Map({
                        container: 'map',
                        style: biopamaBaseLayer,
                        center: [15, 0],
                        zoom: 3,
                        minZoom: 0,
                        maxZoom: 18
                    });

                    this.report_map.on('load', function () {
                        _this.report_map.addSource("BIOPAMA_Poly", {
                            "type": 'vector',
                            "tiles": [mapPolyHostURL + "/{z}/{x}/{y}.pbf"],
                            "minZoom": 0,
                            "maxZoom": 12,
                        });

                        _this.report_map.addLayer({
                            "id": "wdpaBase",
                            "type": "fill",
                            "source": "BIOPAMA_Poly",
                            "source-layer": mapPaLayer,
                            "minzoom": 1,
                            "paint": {
                                "fill-color": [
                                    "match",
                                    ["get", "MARINE"],
                                    ["1"],
                                    "hsla(173, 21%, 51%, 0.1)",
                                    "hsla(87, 47%, 53%, 0.1)"
                                ],
                            }
                        });

                        _this.report_map.addLayer({
                            "id": "wdpaSelected",
                            "type": "line",
                            "source": "BIOPAMA_Poly",
                            "source-layer": mapPaLayer,
                            "layout": {"visibility": "none"},
                            "paint": {
                                "line-color": "#679b95",
                                "line-width": 2,
                            },
                            "transition": {
                                "duration": 300,
                                "delay": 0
                            }
                        });
                        _this.report_map.setFilter("wdpaSelected", ['in', 'WDPAID', {{ $item->wdpa_id }}]);
                        _this.report_map.setLayoutProperty("wdpaSelected", 'visibility', 'visible');
                    });
                }
            }
        });

    </script>

@endsection
