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

        <div class="row ">
            <div class="col text-center mt-4">
                <h4>1. @lang('imet-core::oecm_report.key_biodiversity_elements')</h4>
            </div>
        </div>
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
        <div class="row ">
            <div class="col text-center mt-4">
                <h4>2. @lang('imet-core::oecm_report.ecosystem_services')</h4>
            </div>
        </div>
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
        <div class="row ">
            <div class="col text-center mt-4 mb-2">
                <h4>3. @lang('imet-core::oecm_report.general_planning.general_planning_specific_global')</h4>
            </div>
        </div>
        <div class="row ">
            <div class="col text-center mt-4 mb-2">
                <h5>@lang('imet-core::oecm_report.general_planning.general_planning_specific_threats')</h5>
            </div>
        </div>


        <div class="row mb-5">
            <div class="col">
                <div>
                    @foreach($key_elements_biodiversity_charts_global['integration']['chart']['values'] as $threat_key => $threat_label)
                        <div class="histogram-row">
                            <div class="histogram-row__title text-left">{{ $threat_key }}</div>
                            <div class="histogram-row__value text-right" style="margin-right: 20px;">
                                <b v-html="'{{ $threat_label }}' || '-'"></b>
                            </div>
                            <div class="histogram-row__progress-bar" v-if="'{{ $threat_label }}'!=='-'">
                                <div class="histogram-row__progress-bar__limit-left">-100%</div>
                                <div class="histogram-row__progress-bar__bar">
                                    <div class="progress">
                                        <div role="progressbar"
                                             class="progress-bar progress-bar-striped  progress-bar-negative"
                                             :style="'width: ' + Math.abs('{{ $threat_label }}') + '%; background-color: #87c89b !important;'">
                                            <span v-html="'{{ $threat_label }}'"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="histogram-row__progress-bar__limit-right">0%</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col text-center mt-4 mb-2">
                <h5>@lang('imet-core::oecm_report.general_planning.general_planning_global_threats')</h5>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col">
                <div>
                    @foreach($key_elements_biodiversity_charts_global['global']['chart']['values'] as $threat_key => $threat_label)
                        <div class="histogram-row">
                            <div class="histogram-row__title text-left">{{ $threat_key }}</div>
                            <div class="histogram-row__value text-right" style="margin-right: 20px;">
                                <b v-html="'{{ $threat_label }}' || '-'"></b>
                            </div>
                            <div class="histogram-row__progress-bar" v-if="'{{ $threat_label }}'!=='-'">
                                <div class="histogram-row__progress-bar__limit-left">-100%</div>
                                <div class="histogram-row__progress-bar__bar">
                                    <div class="progress">
                                        <div role="progressbar"
                                             class="progress-bar progress-bar-striped  progress-bar-negative"
                                             :style="'width: ' + Math.abs('{{ $threat_label }}') + '%; background-color: #87c89b !important;'">
                                            <span v-html="'{{ $threat_label }}'"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="histogram-row__progress-bar__limit-right">0%</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @include('imet-core::oecm.report.components.prioritize_objectives', ['report' => $report[0]])

        <h5>@lang('imet-core::oecm_report.general_planning.management_priorities')</h5>
        @include('imet-core::oecm.report.components.editor', ['report' => $report[0], 'action' => $action, 'field' => 'priorities'])
    </div>
</div>
