<?php
/** @var string $action */
/** @var array $report */
/** @var array $key_elements_biodiversity */
/** @var array $key_elements_ecosystem */
/** @var array $main_threats */

?>
<div class="module-container mt-1">
    <div class="module-header">
        <div class="module-title" id="ar4">AR.4 @lang('imet-core::oecm_report.general_planning.name')</div>
    </div>
    <div class="module-body">
        <div class="row ">
            <div class="col text-center mt-4">
                <h4>@lang('imet-core::oecm_report.key_biodiversity_elements')</h4>
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
                <h4>@lang('imet-core::oecm_report.ecosystem_services')</h4>
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
        <div class="mb-5"></div>
        <table>
            <tr>
                <th style="width:50%">
                    <h5>@lang('imet-core::oecm_report.driving_forces')</h5>
                </th>
                <th style="width:50%">
                    <h5>@lang('imet-core::oecm_report.score')</h5>
                </th>
            </tr>
            @foreach($main_threats['values'] as $elem)
                <tr>
                    <td style="width:50%">{{ $elem['Threat'] }}</td>
                    @if($elem['__score'] !== null)
                        <td style="width:50%">{{ round($elem['__score'],2) }}</td>
                    @else
                        <td style="width:50%"></td>
                    @endif
                </tr>
            @endforeach
        </table>
        <div class="row mb-5">
            <div class="col">
                <div>
                    @foreach($main_threats['chart']['values'] as $threat_key => $threat_label)
                        <div class="histogram-row">
                            <div class="histogram-row__title text-left">{{ $threat_key }}</div>
                            <div class="histogram-row__value text-right" style="margin-right: 20px;">
                                <b v-html="'{{ $threat_label }}' || '-'"></b>
                            </div>
                            <div class="histogram-row__progress-bar"  v-if="'{{ $threat_label }}'!=='-'">
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

        <h5>@lang('imet-core::oecm_report.management_priorities')</h5>
        @include('imet-core::oecm.report.components.editor', ['report' => $report[0], 'action' => $action, 'field' => 'priorities'])
    </div>
</div>
