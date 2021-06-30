<?php
/** @var string $action */
/** @var \App\Models\Imet\v1\Imet $item */
/** @var array $assessment */
/** @var array $key_elements */
/** @var array $report */
/** @var array $wdpa_extent */
/** @var array $dopa_radar */
/** @var array $dopa_indicators */
/** @var array $general_info */
/** @var array $vision */
/** @var array $area */
/** @var bool $connection */

// Force Language
if ($item->language != App::getLocale()) {
    App::setLocale($item->language);
}

function score_class($value, $additional_classes=''){
    if($value===0){
        $class = 'score_danger';
    } elseif($value<34){
        $class = 'score_alert';
    } elseif($value<51){
        $class = 'score_warning';
    } else {
        $class = 'score_success';
    }
    return 'class="'.$class.' '.$additional_classes.'"';
}

function score_class_threats($value, $additional_classes=''){
    if($value<-51){
        $class = 'score_danger';
    } elseif($value<-34){
        $class = 'score_alert';
    } elseif($value<-1){
        $class = 'score_warning';
    } else {
        $class = 'score_success';
    }
    return 'class="'.$class.' '.$additional_classes.'"';
}
?>

@extends('layouts.admin')

@section('admin_breadcrumbs')
    @include('admin.components.breadcrumbs', ['links' => [
        action([\App\Http\Controllers\Imet\ImetController::class, 'index']) => trans('form/imet/common.imet_short')
    ]])
@endsection

@if(!is_imet_environment())
@section('admin_page_title')
    @lang('form/imet/common.imet')
@endsection
@endif


@section('content')

    <div id="imet_report">

        @include('admin.imet.components.heading', ['phase' => 'report'])

        <div class="module-container">
            <div class="module-header"><div class="module-title">@lang('form/imet/v2.report.general_elements')</div></div>
            <div class="module-body">
                <div id="map" v-if=connection></div>
                <div v-else class="dopa_not_available">@lang('entities.dopa_not_available')</div>
                <div style="display: flex;">
                    @if($connection)
                        <div id="radar">
                            <dopa_radar data='@json($dopa_radar)'></dopa_radar>
                            &copy;Dopa Services
                        </div>
                    @endif
                    <div>
                        <div><div class="strong">@lang('form/imet/v2.report.country'):</div>{{ $general_info['Country'] ?? '-' }}</div>
                        <div><div class="strong">@lang('form/imet/v2.report.name'):</div>{{ $general_info['CompleteName'] ?? '-' }}</div>
                        <div><div class="strong">@lang('form/imet/v2.report.category'):</div>{{ $general_info['NationalCategory'] ?? '-' }}</div>
                        <div><div class="strong">@lang('form/imet/v2.report.gazetting'):</div>{{ $general_info['CreationYear'] ?? '-' }}</div>
                        <div><div class="strong">@lang('form/imet/v2.report.surface'):</div>{{ $area }} [km2]</div>
                        <div><div class="strong">@lang('form/imet/v2.report.agency'):</div>{{ $general_info['Institution'] ?? '-' }}</div>
                        <div><div class="strong">@lang('form/imet/v2.report.biome'):</div>{{ $general_info['Biome']  }}</div>
                        <div><div class="strong">@lang('form/imet/v2.report.main_values_protected'):</div>{{ $general_info['ReferenceTextValues'] ?? '-' }}</div>
                        <div><div class="strong">@lang('form/imet/v2.report.vision'):</div>{{ $vision['LocalVision'] ?? '-' }}</div>
                        <div><div class="strong">@lang('form/imet/v2.report.mission'):</div>{{ $vision['LocalMission'] ?? '-' }}</div>
                        <div><div class="strong">@lang('form/imet/v2.report.objectives'):</div>{{ $vision['LocalObjective'] ?? '-' }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="module-container">
            <div class="module-header"><div class="module-title">@lang('form/imet/v2.report.evaluation_elements')</div></div>
            <div class="module-body">
                <imet_charts form_id={{ $item->getKey() }} :show_histogram="true"></imet_charts>
                <table id="global_scores">
                    <tr>
                        <th>@lang('form/imet/v1/common.steps_eval.context')</th>
                        <th>@lang('form/imet/v1/common.steps_eval.planning')</th>
                        <th>@lang('form/imet/v1/common.steps_eval.inputs')</th>
                        <th>@lang('form/imet/v1/common.steps_eval.process')</th>
                        <th>@lang('form/imet/v1/common.steps_eval.outputs')</th>
                        <th>@lang('form/imet/v1/common.steps_eval.outcomes')</th>
                        <th>@lang('form/imet/v1/common.indexes.imet')</th>
                    </tr>
                    <tr>
                        <td {!! score_class($assessment['global']['context']) !!} >{{ $assessment['global']['context'] }}</td>
                        <td {!! score_class($assessment['global']['planning']) !!} >{{ $assessment['global']['planning'] }}</td>
                        <td {!! score_class($assessment['global']['inputs']) !!} >{{ $assessment['global']['inputs'] }}</td>
                        <td {!! score_class($assessment['global']['process']) !!} >{{ $assessment['global']['process'] }}</td>
                        <td {!! score_class($assessment['global']['outputs']) !!} >{{ $assessment['global']['outputs'] }}</td>
                        <td {!! score_class($assessment['global']['outcomes']) !!} >{{ $assessment['global']['outcomes'] }}</td>
                        <td {!! score_class($assessment['global']['imet_index']) !!} >{{ $assessment['global']['imet_index'] }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="module-container">
            <div class="module-header"><div class="module-title">@lang('form/imet/v2/report.management_context')</div></div>
            <div class="module-body">
                <h5>@lang('form/imet/v2/report.key_species')</h5>
                <ul>
                    @foreach($key_elements['species'] as $elem)
                        <li>{{ $elem }}</li>
                    @endforeach
                </ul>
                @include('admin.imet.v1.report.components.editor', ['report' => $report, 'action' => $action, 'field' => 'key_species_comment'])
                <h5>@lang('form/imet/v2/report.terrestial_marine_habitats')</h5>
                <ul>
                    @foreach($key_elements['habitats'] as $elem)
                        <li>{{ $elem }}</li>
                    @endforeach
                </ul>
                @include('admin.imet.v1.report.components.editor', ['report' => $report, 'action' => $action, 'field' => 'habitats_comment'])
                <h5>@lang('form/imet/v2/report.climate_change')</h5>
                <ul>
                    @foreach($key_elements['climate_change'] as $elem)
                        <li>{{ $elem }}</li>
                    @endforeach
                </ul>
                @include('admin.imet.v1.report.components.editor', ['report' => $report, 'action' => $action, 'field' => 'climate_change_comment'])
                <h5>@lang('form/imet/v2/report.ecosystem_services')</h5>
                <ul>
                    @foreach($key_elements['ecosystem_services'] as $elem)
                        <li>{{ $elem }}</li>
                    @endforeach
                </ul>
                @include('admin.imet.v1.report.components.editor', ['report' => $report, 'action' => $action, 'field' => 'ecosystem_services_comment'])
                <h5>@lang('form/imet/v2/report.threats')</h5>
                <ul>
                    @foreach($key_elements['threats'] as $elem)
                        <li>{{ $elem }}</li>
                    @endforeach
                </ul>
                @include('admin.imet.v1.report.components.editor', ['report' => $report, 'action' => $action, 'field' => 'threats_comment'])
                @include('admin.imet.v1.report.components.table_evaluation', ['assessment' => $assessment])
            </div>
        </div>

        <div class="module-container">
            <div class="module-header"><div class="module-title">@lang('form/imet/v2/report.management_effectiveness')</div></div>
            <div class="module-body">
                @include('admin.imet.v1.report.components.editor', ['report' => $report, 'action' => $action, 'field' => 'analysis'])
                <h5>@lang('form/imet/v2/report.characteristics_elements')</h5>
                <div class="swot">
                    <div>
                        <b>@lang('form/imet/v2/report.strengths')</b>
                        @include('admin.imet.v1.report.components.editor', ['report' => $report, 'action' => $action, 'field' => 'strengths_swot'])
                    </div>
                    <div>
                        <b>@lang('form/imet/v2/report.weaknesses')</b>
                        @include('admin.imet.v1.report.components.editor', ['report' => $report, 'action' => $action, 'field' => 'weaknesses_swot'])
                    </div>
                    <div>
                        <b>@lang('form/imet/v2/report.opportunities')</b>
                        @include('admin.imet.v1.report.components.editor', ['report' => $report, 'action' => $action, 'field' => 'opportunities_swot'])
                    </div>
                    <div>
                        <b>@lang('form/imet/v2/report.threats')</b>
                        @include('admin.imet.v1.report.components.editor', ['report' => $report, 'action' => $action, 'field' => 'threats_swot'])
                    </div>
                </div>
            </div>
        </div>

        <div class="module-container">
            <div class="module-header"><div class="module-title">@lang('form/imet/v2/report.operation_recommendations')</div></div>
            <div class="module-body">
                @include('admin.imet.v1.report.components.editor', ['report' => $report, 'action' => $action, 'field' => 'recommendations'])
            </div>
        </div>

        <div class="module-container">
            <div class="module-header"><div class="module-title">@lang('form/imet/v2/report.key_questions')</div></div>
            <div class="module-body">
                <h5>@lang('form/imet/v2/report.management_priorities')</h5>
                @include('admin.imet.v1.report.components.editor', ['report' => $report, 'action' => $action, 'field' => 'priorities'])
                <h5>@lang('form/imet/v2/report.operating_budget')</h5>
                @include('admin.imet.v1.report.components.editor', ['report' => $report, 'action' => $action, 'field' => 'minimum_budget'])
                <h5>@lang('form/imet/v2/report.additional_funding')</h5>
                @include('admin.imet.v1.report.components.editor', ['report' => $report, 'action' => $action, 'field' => 'additional_funding'])
            </div>
        </div>

        <div class="module-container">
            <div class="module-header"><div class="module-title">Annexes (&copy;Dopa Services)</div></div>
            <div class="module-body">
                <div>
                    <div v-if=connection>

                        <b>@lang('form/imet/v2/report.forest_cover')</b>
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

                        <hr />

                        <b>@lang('form/imet/v2/report.total_carbon')</b>
                        <dopa_indicators_table
                            :title=dopa_indicators.total_carbon.title_table
                            :indicators=dopa_indicators.total_carbon.indicators
                            :api_data=api_data
                        ></dopa_indicators_table>


                        <b>@lang('form/imet/v2/report.agricultural_pressure')</b>
                        <dopa_indicators_table
                            :title=dopa_indicators.agricultural_pressure.title_table
                            :indicators=dopa_indicators.agricultural_pressure.indicators
                            :api_data=api_data
                        ></dopa_indicators_table>

                    </div>
                    <div v-else class="dopa_not_available">@lang('entities.dopa_not_available')</div>
                </div>
            </div>
        </div>

        @if($action==='edit')
            <div class="scrollButtons" v-cloak>
                {{-- Save --}}
                <div class="standalone" v-show=status==='changed'>
                    <form id="imet_report_form" method="post" action="{{ action([\App\Http\Controllers\Imet\ImetControllerV1::class, 'report_update'], [$item->getKey()]) }}" style="display: inline-block;">
                        @method('PATCH')
                        @csrf
                        <span @click="saveReport">{!! \App\Library\Utils\Template::icon('save') !!} {{ ucfirst(trans('common.save')) }}</span>
                    </form>
                </div>
                <div class="standalone" v-show=status==='loading' >
                    <i class="fa fa-spinner fa-spin green_dark"></i>
                    {{ ucfirst(trans('common.saving')) }}
                </div>
                <div v-show=status==='saved' class="standalone highlight">{{ ucfirst(trans('common.saved_successfully')) }}!</div>
                <div v-show=status==='error' class="standalone error">{{ ucfirst(trans('common.saved_error')) }}!</div>

                {{-- Print --}}
                <div class="standalone" @click="printReport">{!! \App\Library\Utils\Template::icon('print') !!} {{ ucfirst(trans('common.print')) }}</div>
            </div>
        @endif

    </div>

    <script>
        new Vue({
            el: '#imet_report',
            data: {
                report: JSON.parse('{!! App\Library\Utils\Type\JSON::toVue($report) !!}'),
                loading: false,
                error: false,
                status: 'idle',
                connection: {{ $connection ? 'true' : 'false' }},
                report_map: null,
                api_data: JSON.parse('{!! App\Library\Utils\Type\JSON::toVue($dopa_indicators) !!}'),
                dopa_indicators: {
                    forest_cover: {
                        title_table: '@lang("form/imet/v2/report.forest_cover")',
                        title_chart: '@lang("form/imet/v2/report.forest_cover_percent") (%)',
                        indicators: [
                            {
                                field: 'gfc_treecover_km2',
                                label: '@lang("form/imet/v2/report.forest_cover") [km2]',
                                color: '#5b5b5b'
                            },
                            {
                                field: 'gfc_treecover_perc',
                                label: '@lang("form/imet/v2/report.forest_cover") [%]',
                                color: '#5b5b5b'
                            },
                            {
                                field: 'gfc_loss_km2',
                                label: '@lang("form/imet/v2/report.forest_loss") [km2]',
                                color: '#D9534F'
                            },
                            {
                                field: 'gfc_loss_perc',
                                label: '@lang("form/imet/v2/report.forest_loss") [%]',
                                color: '#D9534F'
                            },
                            {
                                field: 'gfc_gain_km2',
                                label: '@lang("form/imet/v2/report.forest_gain") [km2]',
                                color: '#337AB7'
                            },
                            {
                                field: 'gfc_gain_perc',
                                label: '@lang("form/imet/v2/report.forest_gain") [%]',
                                color: '#337AB7'
                            },
                        ],
                        bar_indicators: [
                            {
                                field: 'gfc_loss_perc',
                                label: '@lang("form/imet/v2/report.forest_loss") [%]',
                                color: '#D9534F'
                            },
                            {
                                field: 'gfc_gain_perc',
                                label: '@lang("form/imet/v2/report.forest_gain") [%]',
                                color: '#337AB7'
                            },
                        ]
                    },
                    total_carbon: {
                        title_table : 'Total carbon',
                        indicators: [
                            {
                                field: 'carbon_min_c_mg',
                                label: '@lang("form/imet/v2/report.min") [Mg]'
                            },
                            {
                                field: 'carbon_mean_c_mg',
                                label: '@lang("form/imet/v2/report.mean") [Mg]'
                            },
                            {
                                field: 'carbon_max_c_mg',
                                label: '@lang("form/imet/v2/report.max") [Mg]'
                            },
                            {
                                field: 'carbon_stdev_c_mg',
                                label: '@lang("form/imet/v2/report.std_dev") [Mg]'
                            },
                            {
                                field: 'carbon_tot_c_mg',
                                label: '@lang("form/imet/v2/report.sum") [Pg]'
                            },
                        ]
                    },
                    agricultural_pressure: {
                        title_table : 'Agricultural pressure',
                        indicators: [
                            {
                                field: 'agri_ind_pa',
                                label: '@lang("form/imet/v2/report.protected_area") [%]'
                            },
                            {
                                field: 'agri_ind_bu',
                                label: '@lang("form/imet/v2/report.unprotected_buffer") [%]'
                            }
                        ]
                    }
                }
            },

            mounted(){
                if(this.connection){
                    this.loadMap();
                }
            },

            watch: {
                status(value){
                    let _this = this;
                    if(value==='saved'){
                        setTimeout(function(){
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

            methods:{
                saveReport(){
                    let _this = this;
                    this.status = 'loading';
                    this.loading = true;
                    this.error = false;
                    window.axios({
                        method: 'post',
                        url: '{{ action([\App\Http\Controllers\Imet\ImetControllerV1::class, 'report_update'], ['item' => $item->getKey()]) }}',
                        data: {
                            _token: window.Laravel.csrfToken,
                            _method: 'PATCH',
                            report: this.report
                        }
                    })
                        .then(function (response) {
                            if(!(response.data.hasOwnProperty('status') && response.data.status==='success')){
                                _this.status = 'error';
                            }
                            _this.status = 'saved';
                        })
                        .catch(function (error) {
                            _this.status = 'error';
                        })
                },

                printReport(){
                    window.print();
                },

                loadMap(){
                    let _this = this;
                    window.mapboxgl.accessToken = 'pk.eyJ1IjoiYmxpc2h0ZW4iLCJhIjoiMEZrNzFqRSJ9.0QBRA2HxTb8YHErUFRMPZg';
                    let biopamaBaseLayer = 'mapbox://styles/jamesdavy/cjw25laqe0y311dqulwkvnfoc';
                    let mapPolyHostURL = "https://tiles.biopama.org/BIOPAMA_poly_2";
                    let mapPaLayer = "WDPA2019MayPoly";

                    this.report_map = new window.mapboxgl.Map({
                        container: 'map',
                        style: biopamaBaseLayer,
                        center: [15, 0],
                        zoom: 3,
                        minZoom: 0,
                        maxZoom: 18
                    });

                    this.report_map.on('load', function(){
                        _this.report_map.addSource("BIOPAMA_Poly", {
                            "type": 'vector',
                            "tiles": [mapPolyHostURL+"/{z}/{x}/{y}.pbf"],
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
                        _this.report_map.setFilter("wdpaSelected", ['in','WDPAID', {{ $item->wdpa_id }}]);
                        _this.report_map.setLayoutProperty("wdpaSelected", 'visibility', 'visible');
                    });
                }
            }
        });

    </script>

@endsection
