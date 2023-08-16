<?php
/** @var string $action */
/** @var array $report */
/** @var array $key_elements_biodiversity */
/** @var array $key_elements_ecosystem */
/** @var array $main_threats */

?>
<div class="module-container mt-1">
    <div class="module-header">
        <div class="module-title">@lang('imet-core::oecm_report.general_planning.name')</div>
    </div>
    <div class="module-body">
        <div class="row ">
            <div class="col text-center mt-4">
                <h4>@lang('imet-core::oecm_report.key_biodiversity_elements')</h4>
            </div>
        </div>
        <table>
            <tr>
                <th><h5>@lang('imet-core::oecm_report.general_planning.priority')</h5></th>
                <th><h5>@lang('imet-core::oecm_report.general_planning.category')</h5></th>
                <th>
                    <h5>@lang('imet-core::oecm_report.general_planning.key_elements_service')</h5>
                </th>
                <th><h5>@lang('imet-core::oecm_report.general_planning.comments')</h5></th>
            </tr>
            @foreach($key_elements_biodiversity as $key => $elem)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $elem['__group_stakeholders'] ?? 'No category' }}</td>
                    <td>{{ $elem['Aspect'] }}</td>
                    <td>{{ $elem['Comments'] }}</td>
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
                <th><h5>@lang('imet-core::oecm_report.general_planning.priority')</h5></th>
                <th><h5>@lang('imet-core::oecm_report.general_planning.category')</h5></th>
                <th>
                    <h5>@lang('imet-core::oecm_report.general_planning.key_elements_service')</h5>
                </th>
                <th><h5>@lang('imet-core::oecm_report.general_planning.comments')</h5></th>
            </tr>

            @foreach($key_elements_ecosystem as $key => $elem)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $elem['__group_stakeholders'] ?? 'No category' }}</td>
                    <td>{{ $elem['Aspect'] }}</td>
                    <td>{{ $elem['Comments'] }}</td>
                </tr>
            @endforeach
        </table>
        <div class="mb-5"></div>
        <table>
            <tr>
                <th>
                    <h5>@lang('imet-core::oecm_report.driving_forces')</h5>
                </th>
                <th>
                    <h5>@lang('imet-core::oecm_report.score')</h5>
                </th>
            </tr>
            @foreach($main_threats['values'] as $elem)
                <tr>
                    <td>{{ $elem['Threat'] }}</td>
                    @if($elem['__score'] !== null)
                        <td>{{ round($elem['__score'],2) }}</td>
                    @else
                        <td></td>
                    @endif
                </tr>
            @endforeach
        </table>
        <div class="row mb-5">
            <div class="col">
                <imet_bar_chart
                    :values="{{$main_threats['chart']['values'] }}"
                    :fields="{{$main_threats['chart']['fields'] }}"
                    :colors="{{$main_threats['chart']['colors'] }}"
                    :axis_dimensions_y="{max:0,min:-100}"
                ></imet_bar_chart>
            </div>
        </div>

        <h5>@lang('imet-core::oecm_report.management_priorities')</h5>
        @include('imet-core::oecm.report.components.editor', ['report' => $report[0], 'action' => $action, 'field' => 'priorities'])
    </div>
</div>
