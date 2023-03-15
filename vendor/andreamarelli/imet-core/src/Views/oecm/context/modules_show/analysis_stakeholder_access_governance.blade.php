<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */

/** @var Mixed $records */


use \AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context\AnalysisStakeholderAccessGovernance;
use \AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context\StakeholdersNaturalResources;

$form_id = $collection[0]['FormID'];
$stakeholders = StakeholdersNaturalResources::calculateWeights($form_id);
arsort($stakeholders);
$key_elements_importance = AnalysisStakeholderAccessGovernance::calculateKeyElementsImportances($form_id, $records);

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
                <h4>@lang('imet-core::oecm_context.AnalysisStakeholderAccessGovernance.elements_importance')</h4>
                <table class="table module-table">
                    <thead>
                    <tr>
                        <th>@lang('imet-core::oecm_context.AnalysisStakeholderAccessGovernance.fields.Element')</th>
                        <th>@lang('imet-core::oecm_context.AnalysisStakeholderAccessGovernance.importance')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($key_elements_importance as $element)
                        <tr class="module-table-item">
                            <td style="text-align: left;">{{ $element['element'] }}</td>
                            <td style="text-align: left;">{{ $element['importance'] }}</td>
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
                    {{-- titles --}}
                    @if($group_key === 'group0')
                        <h2 style="margin-bottom: 20px;">@lang('imet-core::oecm_context.AnalysisStakeholderAccessGovernance.biodiversity')</h2>
                        <h4 style="margin-bottom: 20px;">@lang('imet-core::oecm_context.AnalysisStakeholderAccessGovernance.titles.title0')</h4>
                    @elseif($group_key === 'group3')
                        <h2 style="margin-bottom: 20px;">@lang('imet-core::oecm_context.AnalysisStakeholderAccessGovernance.ecosystem_services')</h2>
                        <h4 style="margin-bottom: 20px;">@lang('imet-core::oecm_context.AnalysisStakeholderAccessGovernance.titles.title1')</h4>
                    @elseif($group_key === 'group7')
                        <h4 style="margin-bottom: 20px;">@lang('imet-core::oecm_context.AnalysisStakeholderAccessGovernance.titles.title2')</h4>
                    @elseif($group_key === 'group10')
                        <h4 style="margin-bottom: 20px;">@lang('imet-core::oecm_context.AnalysisStakeholderAccessGovernance.titles.title3')</h4>
                    @elseif($group_key === 'group12')
                        <h4 style="margin-bottom: 20px;">@lang('imet-core::oecm_context.AnalysisStakeholderAccessGovernance.titles.title4')</h4>
                    @endif

                    <h5 class="highlight group_title_{{ $definitions['module_key'] }}_{{ $group_key }}">{{ $group_label }}</h5>
                    @lang('imet-core::oecm_context.AnalysisStakeholderAccessGovernance.groups_descriptions.' . $group_key)

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
                            @foreach($stakeholders_records[$stakeholder][$group_key] as $record)
                                <tr class="module-table-item">
                                    @foreach($definitions['fields'] as $f_index=>$field)
                                        <td>
                                            @include('modular-forms::module.show.field', [
                                                   'type' => $field['type'],
                                                   'value' => $record[$field['name']]
                                              ])
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        @endif
                        </tbody>

                    </table>

                @endforeach

            </div>
        </div>
    </div>
@endforeach

