<?php
/** @var string $action */

/** @var \AndreaMarelli\ImetCore\Models\Imet\oecm\Imet $item */
/** @var array $assessment */
/** @var array $key_elements */
/** @var array $planning_objectives */
/** @var array $report */
/** @var array $report_schema */
/** @var array $general_info */
/** @var array $vision */
/** @var array $area */
/** @var bool $show_non_wdpa */
/** @var Array $non_wdpa */
/** @var Array $governance */

// Force Language
use Illuminate\Support\Facades\App;

if ($item->language != App::getLocale()) {
    App::setLocale($item->language);
}
//dd($report);
?>

@extends('layouts.admin')

@include('imet-core::components.breadcrumbs_and_page_title')

@section('content')

    <div id="imet_report">

        @include('imet-core::components.heading', ['phase' => 'report'])
        @include('imet-core::oecm.report.components.non_wdpa', [
            'show_non_wdpa' => $show_non_wdpa,
            'non_wdpa' =>  $non_wdpa
        ])

        <div class="module-container">
            <div class="module-header">
                <div class="module-title">@lang('imet-core::oecm_report.key_elements')</div>
            </div>
            <div class="module-body">
                <h3>1. @lang('imet-core::oecm_context.Governance.management') </h3>
                <table>
                    <tr>
                        <td><b>@lang('imet-core::oecm_context.Governance.fields.GovernanceModel')</b></td>
                        <td>@lang('imet-core::oecm_lists.GovernanceModel.'.$governance['GovernanceModel'])</td>
                    </tr>
                    <tr>
                        <td><b>@lang('imet-core::oecm_context.Governance.fields.AdditionalInfo')</b></td>
                        <td>{{ $governance['AdditionalInfo'] }}</td>
                    </tr>
                    <tr>
                        <td><b>@lang('imet-core::oecm_context.Governance.fields.ManagementUnique')</b></td>
                        <td>@lang('imet-core::oecm_lists.ManagementUnique.'.$governance['ManagementUnique'])</td>
                    </tr>
                    <tr>
                        <td><b>@lang('imet-core::oecm_context.Governance.fields.ManagementList')</b></td>
                        <td>{{ $governance['ManagementList'] }}</td>
                    </tr>
                    <tr>
                        <td><b>@lang('imet-core::oecm_context.Governance.fields.DateOfCreation')</b></td>
                        <td>{{ $governance['DateOfCreation'] }}</td>
                    </tr>
                    <tr>
                        <td><b>@lang('imet-core::oecm_context.Governance.fields.OfficialRecognition')</b></td>
                        <td>{{ $governance['OfficialRecognition'] }}</td>
                    </tr>
                    <tr>
                        <td><b>@lang('imet-core::oecm_context.Governance.fields.SupervisoryInstitution')</b></td>
                        <td>{{ $governance['SupervisoryInstitution'] }}</td>
                    </tr>

                </table>
                <h3>2. @lang('imet-core::oecm_report.stakeholder_users_managing_oecm')</h3>
                <table>
                    <tr>
                        <th>
                            <b>@lang('imet-core::oecm_report.stakeholder_direct_users')</b>
                        </th>
                        <th>
                            <b>@lang('imet-core::oecm_report.stakeholder_indirect_users') </b>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <table>
                                @foreach($stake_holders['direct'] as $key => $elem)
                                    <tr>
                                        <td>
                                            @if($elem > 1)
                                                {{$elem}}
                                            @endif
                                            {{ $key }}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </td>
                        <td>
                            <table>
                                @foreach($stake_holders['indirect'] as $key => $elem)
                                    <tr>
                                        <td>
                                            @if($elem > 1)
                                                {{$elem}}
                                            @endif
                                            {{ $key }}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </td>
                    </tr>
                </table>
                <h3>3. @lang('imet-core::oecm_report.stakeholders')</h3>
                <table class="table module-table">
                    <tr>
                        <th>
                            <b>@lang('imet-core::oecm_context.AnalysisStakeholderDirectUsers.fields.Element')</b>
                        </th>
                        <th>
                            <b>@lang('imet-core::oecm_context.AnalysisStakeholderDirectUsers.fields.Description')</b>
                        </th>
                    </tr>
                    @foreach($stake_analysis as $key => $elem)
                        <tr class="module-table-item">
                            <td>
                                {{ $key }}
                            </td>
                            <td>
                                @if($elem !== null)
                                    {{ join(', ',$elem)}}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
                <h3>4. @lang('imet-core::oecm_report.key_biodiversity_elements')</h3>
                <table>
                    <tr>
                        <th>
                            <b>@lang('imet-core::oecm_evaluation.KeyElementsImpact.fields.KeyElement')</b>
                        </th>
                        <th>
                            <b>@lang('imet-core::oecm_evaluation.KeyElementsImpact.fields.StatusSH') {{strtolower(trans('imet-core::oecm_evaluation.KeyElementsImpact.from_sa'))}}</b>
                        </th>
                        <th>
                            <b>@lang('imet-core::oecm_evaluation.KeyElementsImpact.fields.TrendSH') {{strtolower(trans('imet-core::oecm_evaluation.KeyElementsImpact.from_sa'))}}</b>
                        </th>
                        <th>
                            <b>@lang('imet-core::oecm_evaluation.KeyElementsImpact.fields.StatusSH') {{strtolower(trans('imet-core::oecm_evaluation.KeyElementsImpact.from_external_source'))}}</b>
                        </th>
                        <th>
                            <b>@lang('imet-core::oecm_evaluation.KeyElementsImpact.fields.TrendSH') {{strtolower(trans('imet-core::oecm_evaluation.KeyElementsImpact.from_external_source'))}}</b>
                        </th>
                    </tr>
                    @foreach($key_elements_impacts as $key => $elem)
                        <tr>
                            <td>
                                {{ $elem['KeyElement'] }}
                            </td>
                            <td>
                                {{ $elem['StatusSH'] }}
                            </td>
                            <td>
                                {{ $elem['TrendSH'] }}
                            </td>
                            <td>
                                {{ $elem['StatusER'] }}
                            </td>
                            <td>
                                {{ $elem['TrendER'] }}
                            </td>
                        </tr>
                    @endforeach
                </table>

                @include('imet-core::oecm.report.components.editor', ['report' => $report[0], 'action' => $action, 'field' => 'key_elements_comment'])

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
                @include('imet-core::v2.report.components.editor', ['report' => $report[0], 'action' => $action, 'field' => 'analysis'])
                <h5>@lang('imet-core::oecm_report.characteristics_elements')</h5>
                <div class="swot">
                    <div>
                        <b>@lang('imet-core::oecm_report.strengths')</b>
                        @include('imet-core::oecm.report.components.editor', ['report' => $report[0], 'action' => $action, 'field' => 'strengths_swot'])
                    </div>
                    <div>
                        <b>@lang('imet-core::oecm_report.weaknesses')</b>
                        @include('imet-core::oecm.report.components.editor', ['report' => $report[0], 'action' => $action, 'field' => 'weaknesses_swot'])
                    </div>
                    <div>
                        <b>@lang('imet-core::oecm_report.opportunities')</b>
                        @include('imet-core::oecm.report.components.editor', ['report' => $report[0], 'action' => $action, 'field' => 'opportunities_swot'])
                    </div>
                    <div>
                        <b>@lang('imet-core::oecm_report.threats')</b>
                        @include('imet-core::oecm.report.components.editor', ['report' => $report[0], 'action' => $action, 'field' => 'threats_swot'])
                    </div>
                </div>
            </div>
        </div>

        <div class="module-container">
            <div class="module-header">
                <div class="module-title">@lang('imet-core::oecm_report.general_planning.name')</div>
            </div>
            <div class="module-body">
                <table>
                    <tr>
                        <th><h5>@lang('imet-core::oecm_report.general_planning.priority')</h5></th>
                        <th><h5>@lang('imet-core::oecm_report.general_planning.category')</h5></th>
                        <th>
                            <h5>@lang('imet-core::oecm_report.general_planning.key_elements_service')</h5>
                        </th>
                        <th><h5>@lang('imet-core::oecm_report.general_planning.comments')</h5></th>
                    </tr>
                    @foreach($key_elements as $key => $elem)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $elem['__group_stakeholders'] ?? 'No category' }}</td>
                            <td>{{ $elem['Aspect'] }}</td>
                            <td>{{ $elem['Comments'] }}</td>
                        </tr>
                    @endforeach
                </table>
                <table>
                    <tr>
                        <th>
                            <h5>@lang('imet-core::oecm_report.driving_forces')</h5>
                        </th>
                    </tr>
                    @foreach($main_threats as $elem)
                        <tr>
                            <td>{{ $elem['Threat'] }}</td>
                        </tr>
                    @endforeach
                </table>
                <h5>@lang('imet-core::oecm_report.management_priorities')</h5>
                @include('imet-core::oecm.report.components.editor', ['report' => $report[0], 'action' => $action, 'field' => 'priorities'])
            </div>
        </div>
        <div class="item">

            @include('imet-core::oecm.report.components.planning_roadmap', ['report' => $report, 'action' => $action])
            <div class="row">
                <div class="col">
                    <span v-if="reportLength < 10">
                        @include('modular-forms::buttons.add_item')
                    </span>
                    <span v-if="reportLength > 1">
                        @include('modular-forms::buttons.delete_item')
                    </span>
                </div>
            </div>
        </div>
        <div class="module-container mt-5">
            <div class="module-header">
                <div class="module-title">@lang('imet-core::oecm_report.key_questions')</div>
            </div>
            <div class="module-body">
                <h5>@lang('imet-core::oecm_report.operating_budget')</h5>
                @include('imet-core::oecm.report.components.editor', ['report' => $report[0], 'action' => $action, 'field' => 'minimum_budget'])
                <h5>@lang('imet-core::oecm_report.additional_funding')</h5>
                @include('imet-core::oecm.report.components.editor', ['report' => $report[0], 'action' => $action, 'field' => 'additional_funding'])
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
                default_schema: @json($report_schema),
                loading: false,
                error: false,
                status: 'idle',
                table_input_elems: [0]
            },
            mounted() {

                if (this.report.length > 0) {
                    this.table_input_elems = this.report.map((elem, index) => index);
                }
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
                addItem() {
                    if (this.table_input_elems.length < 10) {
                        const id = this.table_input_elems.length;
                        this.table_input_elems.push(id);
                        this.report.push(JSON.parse(JSON.stringify(this.default_schema)));
                    }
                },
                deleteItem(index) {
                    const key = this.table_input_elems.pop();
                    this.report.splice(key, 1);
                }
            }
        });
    </script>

@endsection
