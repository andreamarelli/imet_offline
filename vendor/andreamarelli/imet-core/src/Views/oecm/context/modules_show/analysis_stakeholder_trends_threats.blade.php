<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */

/** @var Mixed $records */

use \AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context\AnalysisStakeholderTrendsThreats;
use \AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context\StakeholdersNaturalResources;

$form_id = $collection[0]['FormID'];
$stakeholders = StakeholdersNaturalResources::calculateWeights($form_id);
arsort($stakeholders);
$key_elements_importance = AnalysisStakeholderTrendsThreats::calculateKeyElementsImportances2($form_id, $records);

$num_cols = count($definitions['fields']);

$grouped_records = collect($records)->groupBy('group_key')->toArray();
$stakeholders_records = collect($records)
    ->groupBy('Stakeholder')
    ->map(function ($group) {
        return $group->groupBy('group_key');
    })
    ->toArray();


?>


{{-- Stakeholder's summary--}}
<div class="card">
    <div class="card-header">
        <h4 class="card-title">
            @lang('imet-core::oecm_context.AnalysisStakeholderAccessGovernance.summary')
        </h4>
    </div>
    <div>
        <div class="card-body"style="display: flex; column-gap: 40px;">

            <div>
                <table class="table module-table">
                    <thead>
                    <tr>
                        <th>@lang('imet-core::oecm_context.AnalysisStakeholderTrendsThreats.fields.Element')</th>
                        <th>@lang('imet-core::oecm_context.AnalysisStakeholderTrendsThreats.fields.Status')</th>
                        <th>@lang('imet-core::oecm_context.AnalysisStakeholderTrendsThreats.fields.Trend')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($key_elements_importance as $key_elements)
                        <tr class="module-table-item">
                            <td style="text-align: left;">{{ $key_elements['element'] }}</td>
                            <td style="text-align: left;">{{ $key_elements['status'] }}</td>
                            <td style="text-align: left;">{{ $key_elements['trend'] }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>


            <div>
                <h4>@lang('imet-core::oecm_context.AnalysisStakeholderTrendsThreats.involvement_ranking')</h4>
                <table class="table module-table">
                    <thead>
                    <tr>
                        <th></th>
                        <th>@lang('imet-core::oecm_context.AnalysisStakeholderTrendsThreats.involvement')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($stakeholders as $stakeholder => $ranking)
                        <tr class="module-table-item">
                            <td style="text-align: left;">{{ $stakeholder }}</td>
                            <td style="text-align: left;">{{ $ranking }}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@foreach(array_keys($stakeholders) as $index => $stakeholder)
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">
                {{ $index + 1 }} -
                {{ $stakeholder }}
            </h4>
        </div>
        <div>
            <div class="card-body">

                {{-- groups --}}
                @foreach($definitions['groups'] as $group_key => $group_label)

                    {{-- titles --}}
                    @if($group_key === 'group0')
                        <h3 style="margin-bottom: 20px;">{{ (new AnalysisStakeholderTrendsThreats())->titles['title0'] }}</h3>
                    @elseif($group_key === 'group3')
                        <h3 style="margin-bottom: 20px;">{{ (new AnalysisStakeholderTrendsThreats())->titles['title1'] }}</h3>
                    @elseif($group_key === 'group7')
                        <h3 style="margin-bottom: 20px;">{{ (new AnalysisStakeholderTrendsThreats())->titles['title2'] }}</h3>
                    @elseif($group_key === 'group10')
                        <h3 style="margin-bottom: 20px;">{{ (new AnalysisStakeholderTrendsThreats())->titles['title3'] }}</h3>
                    @elseif($group_key === 'group12')
                        <h3 style="margin-bottom: 20px;">{{ (new AnalysisStakeholderTrendsThreats())->titles['title4'] }}</h3>
                    @endif

                    <h5 class="highlight group_title_{{ $definitions['module_key'] }}_{{ $group_key }}">{{ $group_label }}</h5>


                    <table class="table module-table">

                        {{-- labels  --}}
                        <thead>
                        <tr>
                            @foreach($definitions['fields'] as $field)
                                <th class="text-center">
                                    @if($field['type']!=='hidden')
                                        {{ ucfirst($field['label'] ?? '') }}
                                    @endif
                                </th>
                            @endforeach
                            <th></th>
                        </tr>
                        </thead>

                        <tbody class="{{ $group_key }}">

                        {{-- nothing to evaluate --}}
                        @if(!array_key_exists($group_key, $grouped_records))
                            @include('imet-core::components.module.nothing_to_evaluate', ['num_cols' => $num_cols])

                        @else
                            {{--                                @foreach($stakeholders_records[$stakeholder][$group_key] as $record)--}}
                            {{--                                    <tr class="module-table-item">--}}
                            {{--                                        @foreach($definitions['fields'] as $f_index=>$field)--}}
                            {{--                                            <td>--}}
                            {{--                                                @include('modular-forms::module.show.field', [--}}
                            {{--                                                       'type' => $field['type'],--}}
                            {{--                                                       'value' => $record[$field['name']]--}}
                            {{--                                                  ])--}}
                            {{--                                            </td>--}}
                            {{--                                        @endforeach--}}
                            {{--                                    </tr>--}}
                            {{--                                @endforeach--}}
                        @endif
                        </tbody>
                    </table>
                @endforeach

            </div>
        </div>
    </div>
@endforeach
