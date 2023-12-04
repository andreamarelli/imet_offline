<?php

use AndreaMarelli\ImetCore\Controllers\Imet\ApiController;
use AndreaMarelli\ImetCore\Controllers\Imet\v2\Controller;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Imet;
use AndreaMarelli\ImetCore\Services\Scores\Functions\_Scores;
use AndreaMarelli\ImetCore\Services\Scores\ImetScores;
use AndreaMarelli\ModularForms\Helpers\Template;
use Illuminate\Support\Facades\App;
use AndreaMarelli\ImetCore\Controllers\Imet\oecm;

/** @var string $action */
/** @var Imet $item */
/** @var array $assessment */
/** @var array $key_elements */
/** @var array $main_threats */
/** @var array $report */
/** @var array $report_schema */
/** @var bool $show_non_wdpa */
/** @var Array $non_wdpa */
/** @var Array $governance */
/** @var Array $stake_analysis */

const REPORT_PREFIX = oecm\Controller::ROUTE_PREFIX;

// Force Language
if ($item->language != App::getLocale()) {
    App::setLocale($item->language);
}
?>

@extends('layouts.admin')

@include('imet-core::components.breadcrumbs_and_page_title')

@section('content')
    <div id="imet_report">
        @include('imet-core::components.heading', ['item' => $item])
        @include('imet-core::components.phase', ['phase' => 'report'])
        @include('imet-core::oecm.report.components.non_wdpa', [
            'show_non_wdpa' => $show_non_wdpa,
            'non_wdpa' =>  $non_wdpa
        ])
        <div class="module-container">
            <div class="module-header">
                <div class="module-title" id="ar2">AR.2 @lang('imet-core::oecm_report.key_elements')</div>
            </div>
            <div class="module-body">
                @include('imet-core::oecm.report.components.governance_management', [
                    'governance' => $governance
                ])
                @include('imet-core::oecm.report.components.stakeholders_user_managing', ['stake_holders' => $stake_holders])
                @include('imet-core::oecm.report.components.ecosystem_services_biodiversity', ['stake_analysis' => $stake_analysis])
                @include('imet-core::oecm.report.components.key_biodiversity_elements', ['key_elements_impacts' => $key_elements_impacts])
                @include('imet-core::oecm.report.components.key_ecosystem_elements', ['key_elements_impacts' => $key_elements_impacts])
                @include('imet-core::oecm.report.components.editor', ['report' => $report[0], 'action' => $action, 'field' => 'key_elements_comment'])
            </div>
        </div>
        <div class="module-container">
            <div class="module-header">
                <div class="module-title" id="ar3">
                    AR.3 @lang('imet-core::oecm_report.management_effectiveness.title')</div>
            </div>
            <div class="module-body">
                <h4>@lang('imet-core::oecm_report.management_effectiveness.evaluation_elements')</h4>
                <imet_charts
                    form_id={{ $item->getKey() }}  :labels='@json(ImetScores::labels())'
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
                        <td {!! ApiController::score_class($assessment[_Scores::RADAR_SCORES]['context']) !!} >{{ $assessment[_Scores::RADAR_SCORES]['context'] }}</td>
                        <td {!! ApiController::score_class($assessment[_Scores::RADAR_SCORES]['planning']) !!} >{{ $assessment[_Scores::RADAR_SCORES]['planning'] }}</td>
                        <td {!! ApiController::score_class($assessment[_Scores::RADAR_SCORES]['inputs']) !!} >{{ $assessment[_Scores::RADAR_SCORES]['inputs'] }}</td>
                        <td {!! ApiController::score_class($assessment[_Scores::RADAR_SCORES]['process']) !!} >{{ $assessment[_Scores::RADAR_SCORES]['process'] }}</td>
                        <td {!! ApiController::score_class($assessment[_Scores::RADAR_SCORES]['outputs']) !!} >{{ $assessment[_Scores::RADAR_SCORES]['outputs'] }}</td>
                        <td {!! ApiController::score_class($assessment[_Scores::RADAR_SCORES]['outcomes']) !!} >{{ $assessment[_Scores::RADAR_SCORES]['outcomes'] }}</td>
                        <td {!! ApiController::score_class($assessment[_Scores::RADAR_SCORES]['imet_index']) !!} >{{ $assessment[_Scores::RADAR_SCORES]['imet_index'] }}</td>
                    </tr>
                </table>
                @include('imet-core::oecm.report.components.table_evaluation', ['assessment' => $assessment])
            </div>
        </div>
        @include('imet-core::oecm.report.components.objectives', ['report' => $report[0]])
        <div class="module-container">
            <div class="module-header">
                <div class="module-title">@lang('imet-core::oecm_report.management_effectiveness.swot_analysis')</div>
            </div>
            <div class="module-body">
                @include('imet-core::oecm.report.components.editor', ['report' => $report[0], 'action' => $action, 'field' => 'analysis'])
                <h5>@lang('imet-core::oecm_report.management_effectiveness.characteristics_elements')</h5>
                <div class="swot">
                    <div>
                        <b>@lang('imet-core::oecm_report.management_effectiveness.strengths')</b>
                        @include('imet-core::oecm.report.components.editor', ['report' => $report[0], 'action' => $action, 'field' => 'strengths_swot'])
                    </div>
                    <div>
                        <b>@lang('imet-core::oecm_report.management_effectiveness.weaknesses')</b>
                        @include('imet-core::oecm.report.components.editor', ['report' => $report[0], 'action' => $action, 'field' => 'weaknesses_swot'])
                    </div>
                    <div>
                        <b>@lang('imet-core::oecm_report.management_effectiveness.opportunities')</b>
                        @include('imet-core::oecm.report.components.editor', ['report' => $report[0], 'action' => $action, 'field' => 'opportunities_swot'])
                    </div>
                    <div>
                        <b>@lang('imet-core::oecm_report.management_effectiveness.threats')</b>
                        @include('imet-core::oecm.report.components.editor', ['report' => $report[0], 'action' => $action, 'field' => 'threats_swot'])
                    </div>
                </div>
            </div>
        </div>


        @include('imet-core::oecm.report.components.general_planning', [
                'report' => $report,
                'action' => $action,
                'key_elements_biodiversity' => $key_elements_biodiversity,
                'key_elements_ecosystem' => $key_elements_ecosystem,
                'main_threats' => $main_threats])

        <div class="item">
            @include('imet-core::oecm.report.components.planning_roadmap', ['report' => $report[0], 'action' => $action])
            <div class="row">
                <div class="col">
                    <span class="btn medium" v-if="reportLength < 10">
                        <button type="button"
                                class="btn-nav medium " v-on:click="addItem">
                                    {!! AndreaMarelli\ModularForms\Helpers\Template::icon('plus-circle', 'white') !!} {!! ucfirst(trans('modular-forms::common.add_item')) !!}
                        </button>
                    </span>
                    <span v-if="reportLength > 1">
                        <button type="button"
                                class="btn-nav medium red" v-on:click="deleteItem">
                            {!! AndreaMarelli\ModularForms\Helpers\Template::icon('trash', 'white') !!}
                        </button>
                    </span>
                </div>
            </div>
        </div>
        <div class="module-container mt-5">
            <div class="module-header">
                <div class="module-title" id="ar6">AR.6 @lang('imet-core::oecm_report.key_questions.title')</div>
            </div>
            <div class="module-body">
                <h5>@lang('imet-core::oecm_report.key_questions.operating_budget')</h5>
                @include('imet-core::oecm.report.components.editor', ['report' => $report[0], 'action' => $action, 'field' => 'minimum_budget'])
                <h5>@lang('imet-core::oecm_report.key_questions.additional_funding')</h5>
                @include('imet-core::oecm.report.components.editor', ['report' => $report[0], 'action' => $action, 'field' => 'additional_funding'])
            </div>
        </div>
        @if($action==='edit')
            <div class="scrollButtons" v-cloak>
                {{-- Save --}}
                <div class="standalone" v-show=status==='changed'>
                    <form id="imet_report_form" method="post"
                          action="{{ route(Controller::ROUTE_PREFIX . 'report_update', [$item->getKey()]) }}"
                          style="display: inline-block;">
                        @method('PATCH')
                        @csrf
                        <span
                            @click="saveReport">{!! Template::icon('save') !!} {{ ucfirst(trans('modular-forms::common.save')) }}</span>
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
                     @click="printReport">{!! Template::icon('print') !!} {{ ucfirst(trans('modular-forms::common.print')) }}</div>
            </div>
        @endif
        @include('imet-core::oecm.report.components.navigation_menu')
    </div>
    <script>
        new Vue({
            el: '#imet_report',
            data: {
                report: @json($report),
                default_schema: @json($report_schema),
                loading: false,
                loading_objectives: false,
                error_objectives: false,
                error: false,
                status: 'idle',
                table_input_elems: [0],
                short_long_objectives: {}
            },
            mounted() {
                if (this.report.length > 0) {
                    for (const items in this.report) {
                        for (const item in this.report[items]) {
                            if (this.report[items][item] === null) {
                                this.report[items][item] = "";
                            }
                        }
                    }
                    this.table_input_elems = this.report.map((elem, index) => index);
                }
                this.getObjectives();
            },
            computed: {
                reportLength: function () {
                    return this.report.length;
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
                    handler: function (val, oldVal) {
                        this.status = 'changed';
                    },
                    deep: true
                }
            },
            methods: {
                async saveReport() {
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
                            _this.error_objectives = false;
                        })
                        .catch(function (error) {
                            _this.status = 'error';
                        }).finally(async function () {
                        _this.getObjectives()
                    })
                },
                printReport() {
                    window.print();
                },
                addItem() {
                    if (this.table_input_elems.length < 10) {
                        const id = this.table_input_elems.length;
                        this.table_input_elems.push(id);

                        const new_schema = JSON.parse(JSON.stringify(this.default_schema));

                        for (const item in new_schema) {
                            if (new_schema[item] === null) {
                                new_schema[item] = "";
                            }
                        }
                        this.report.push(new_schema);
                    }
                },
                deleteItem(index) {
                    const key = this.table_input_elems.pop();
                    this.report.splice(key, 1);
                },
                getObjectives() {
                    this.loading_objectives = true;
                    window.axios({
                        method: 'get',
                        url: '{{ route(REPORT_PREFIX.'report_objectives', ['form_id' => $form_id]) }}',
                        data: {
                            _token: window.Laravel.csrfToken
                        }
                    }).then((response) => {
                            this.error_objectives = false;
                            this.short_long_objectives = response.data;
                        }).catch( (error) => {
                        this.error_objectives = true;
                    }).finally(() => {
                            this.loading_objectives = false;
                    });
                }
            }
        });
    </script>
@endsection
