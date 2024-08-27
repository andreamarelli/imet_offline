<?php
/** @var string $action */
/** @var array $report */
/** @var array $key_elements_biodiversity */
/** @var array $key_elements_ecosystem */

?>
<div class="module-container mt-1">
    <div class="module-header">
        <div class="module-title" id="ar4">AR.4 @lang('imet-core::oecm_report.general_planning.name')</div>
    </div>
    <div class="module-body">

         <h4>1. @lang('imet-core::oecm_report.key_biodiversity_elements')</h4>

        <table>
            <tr>
                <th style="width:25%"><h5>@lang('imet-core::oecm_report.general_planning.priority')</h5></th>
                <th style="width:25%"><h5>@lang('imet-core::oecm_report.general_planning.category')</h5></th>
                <th style="width:25%">
                    <h5>@lang('imet-core::oecm_report.general_planning.key_elements_service')</h5>
                </th>
                <th style="width:25%"><h5>@lang('imet-core::oecm_report.general_planning.comments')</h5></th>
            </tr>
            @foreach($key_elements_biodiversity as $key => $elem)
                <tr>
                    <td style="width:25%">{{ $key + 1 }}</td>
                    <td style="width:25%">{{ $elem['__group_stakeholders'] ?? 'No category' }}</td>
                    <td style="width:25%">{{ $elem['Aspect'] }}</td>
                    <td style="width:25%">{{ $elem['Comments'] }}</td>
                </tr>
            @endforeach
        </table>

        <h4>2. @lang('imet-core::oecm_report.ecosystem_services')</h4>

        <table>
            <tr>
                <th style="width:25%"><h5>@lang('imet-core::oecm_report.general_planning.priority')</h5></th>
                <th style="width:25%"><h5>@lang('imet-core::oecm_report.general_planning.category')</h5></th>
                <th style="width:25%">
                    <h5>@lang('imet-core::oecm_report.general_planning.key_elements_service')</h5>
                </th>
                <th style="width:25%"><h5>@lang('imet-core::oecm_report.general_planning.comments')</h5></th>
            </tr>

            @foreach($key_elements_ecosystem as $key => $elem)
                <tr>
                    <td style="width:25%">{{ $key + 1 }}</td>
                    <td style="width:25%">{{ $elem['__group_stakeholders'] ?? 'No category' }}</td>
                    <td style="width:25%">{{ $elem['Aspect'] }}</td>
                    <td style="width:25%">{{ $elem['Comments'] }}</td>
                </tr>
            @endforeach
        </table>


        <h4>3. @lang('imet-core::oecm_report.general_planning.general_planning_specific_global')</h4>

        <h5>@lang('imet-core::oecm_report.general_planning.general_planning_specific_threats')</h5>

        @foreach($key_elements_biodiversity_charts_global['integration']['chart']['values'] as $threat_key => $threat_label)
            <div class="histogram-row">
                <div class="histogram-row__title text-left">{{ $threat_key }}</div>
                <div class="histogram-row__value text-right" style="margin-right: 20px;">
                    <b>{{ $threat_label ?? '-' }}</b>
                </div>
                <div class="histogram-row__progress-bar">
                    @if($threat_label!=='-')
                        <imet_score_bar
                            :value={{ $threat_label }}
                            color="#87c89b"
                            :min=-100
                            :max=0
                        ></imet_score_bar>
                    @endif
                </div>
            </div>
        @endforeach

        <h5>@lang('imet-core::oecm_report.general_planning.general_planning_global_threats')</h5>

        @foreach($key_elements_biodiversity_charts_global['global']['chart']['values'] as $threat_key => $threat_label)
            <div class="histogram-row">
                <div class="histogram-row__title text-left">{{ $threat_key }}</div>
                <div class="histogram-row__value text-right" style="margin-right: 20px;">
                    <b>{{ $threat_label ?? '-' }}</b>
                </div>
                <div class="histogram-row__progress-bar">
                    @if($threat_label!=='-')
                        <imet_score_bar
                            :value={{ $threat_label }}
                            color="#87c89b"
                            :min=-100
                            :max=0
                        ></imet_score_bar>
                    @endif
                </div>
            </div>
        @endforeach

        <h4>4. @lang('imet-core::oecm_report.general_planning.short_term_prioritize')</h4>
        <div v-if="error_objectives">
            <div class="standalone error text-center mb-5 alert alert-danger">
                {{ ucfirst(trans('imet-core::analysis_report.error_wrong')) }}!
            </div>
        </div>
        <div v-else>
            <div class="standalone" v-if="loading_objectives">
                <i class="fa fa-spinner fa-spin text-primary-800"></i>
            </div>

            <div v-else>
                <h5>@lang('imet-core::oecm_report.general_planning.intervention_context')</h5>
                <div v-if="short_long_objectives" v-for="(objective, index) in short_long_objectives['context']" class="mt-3">
                    @{{ objective}}
                </div>
                <h5>@lang('imet-core::oecm_report.general_planning.management_evaluation')</h5>
                <div v-if="short_long_objectives" v-for=" (objective, index) in short_long_objectives['evaluation']" class="mt-3">
                    @{{ objective}}
                </div>
            </div>
        </div>

        <h5>@lang('imet-core::oecm_report.general_planning.management_priorities')</h5>
        @include('imet-core::oecm.report.components.editor', ['report' => $report[0], 'action' => $action, 'field' => 'priorities'])
    </div>
</div>
