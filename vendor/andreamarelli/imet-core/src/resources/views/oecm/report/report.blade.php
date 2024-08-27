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
/** @var array $scores */
/** @var array $labels */
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

//dd($assessment);

?>

@extends('modular-forms::layouts.forms')

@section('content')

    {{--  Heading --}}
    @include('imet-core::components.heading', ['item' => $item])

    {{--  Phase  --}}
    @include('imet-core::components.phase', ['phase' => 'report'])

    <div id="imet_report">

        {{-- AR.1 --}}
        @include('imet-core::oecm.report.components.non_wdpa', [
            'show_non_wdpa' => $show_non_wdpa,
            'non_wdpa' =>  $non_wdpa
        ])

        {{-- AR.2 --}}
        <div class="module-container">
            <div class="module-header">
                <div class="module-title" id="ar2">AR.2 @lang('imet-core::oecm_report.key_elements')</div>
            </div>
            <div class="module-body">
                @include('imet-core::oecm.report.components.governance_management', ['governance' => $governance])
                @include('imet-core::oecm.report.components.stakeholders_user_managing', ['stake_holders' => $stake_holders])
                @include('imet-core::oecm.report.components.ecosystem_services_biodiversity', ['stake_analysis' => $stake_analysis])
                @include('imet-core::oecm.report.components.key_biodiversity_elements', ['key_elements_impacts' => $key_elements_impacts])
                @include('imet-core::oecm.report.components.key_ecosystem_elements', ['key_elements_impacts' => $key_elements_impacts])
                @include('imet-core::oecm.report.components.editor', ['report' => $report[0], 'action' => $action, 'field' => 'key_elements_comment'])
            </div>
        </div>

        {{-- AR.3 --}}
        <div class="module-container">
            <div class="module-header">
                <div class="module-title" id="ar3">
                    AR.3 @lang('imet-core::oecm_report.management_effectiveness.title')</div>
            </div>
            <div class="module-body">
                <h4>@lang('imet-core::oecm_report.management_effectiveness.evaluation_elements')</h4>

                @include('imet-core::components.scores', [
                    'item' => $item,
                    'step' => null,
                    'version' => \AndreaMarelli\ImetCore\Models\Imet\Imet::IMET_OECM
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
                @include('imet-core::oecm.report.components.table_evaluation', ['scores' => $scores, 'labels' => $labels])
            </div>
        </div>

        {{-- objectives --}}
        @include('imet-core::oecm.report.components.objectives', ['objectives' => $objectives])

        {{-- SWOT analysis --}}
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

        {{-- AR.4 --}}
        @include('imet-core::oecm.report.components.general_planning', [
                'report' => $report,
                'action' => $action,
                'key_elements_biodiversity' => $key_elements_biodiversity,
                'key_elements_ecosystem' => $key_elements_ecosystem,
                'main_threats' => $main_threats])

        {{-- AR.5 --}}
        <div class="item">
            @include('imet-core::oecm.report.components.planning_roadmap', ['report' => $report[0], 'action' => $action])
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

        {{-- AR.6 --}}
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
            <div class="scrollButtons report" v-cloak>

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
                <div class="standalone" @click="printReport">{!! Template::icon('print') !!} {{ ucfirst(trans('modular-forms::common.print')) }}</div>
            </div>
        @endif
        @include('imet-core::oecm.report.components.navigation_menu')
    </div>
@endsection

@push('scripts')

    <style>
        .scrollButtons{
            margin-bottom: 0;
            bottom: 100px;
        }
        .scrollButtons.report{
            margin-bottom: 0;
            bottom: 20px;
        }
    </style>

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

                    fetch('{{ route(\AndreaMarelli\ImetCore\Controllers\Imet\oecm\Controller::ROUTE_PREFIX . 'report_update', ['item' => $item->getKey()]) }}', {
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
                            _this.error_objectives = false;
                            _this.getObjectives()
                        })
                        .catch(function (error) {
                            _this.status = 'error';
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
                    let _this = this;
                    this.loading_objectives = true;

                    fetch('{{ route(REPORT_PREFIX.'report_objectives', ['form_id' => $form_id]) }}', {
                        method: 'get',
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-Token": window.Laravel.csrfToken,
                        }
                    })
                        .then((response) => response.json())
                        .then(function(data){
                            _this.error_objectives = false;
                            _this.short_long_objectives =data;
                            _this.loading_objectives = false;
                        })
                        .catch( (error) => {
                            _this.error_objectives = true;
                            _this.loading_objectives = false;
                        })
                }
            }
        });
    </script>
@endpush