<?php
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context\Stakeholders;
use Illuminate\Database\Eloquent\Collection;

/** @var Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $records */
/** @var Array $stakeholders */
/** @var Array $key_elements_importance */
/** @var String $current_stakeholder */

$form_id = $collection[0]['FormID'];

$num_cols = count($definitions['fields']);

$grouped_records = collect($records)->groupBy('group_key')->toArray();
$stakeholders_records = collect($records)
    ->groupBy('Stakeholder')
    ->map(function ($group) {
        return $group->groupBy('group_key');
    })
    ->toArray();

$stakeholders_categories = Stakeholders::getStakeholders(
    $form_id,
    ('AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context\\'.$definitions['module_class'])::$USER_MODE,
    true
);

?>


{{-- Stakeholder's summary--}}
<div class="card">
    <div class="card-header">
        <h4 class="card-title">
            @lang('imet-core::oecm_context.AnalysisStakeholders.summary')
        </h4>
    </div>
    <div>
        <div class="card-body" style="display: flex; column-gap: 40px;">

            <div>
                <h4>@lang('imet-core::oecm_context.AnalysisStakeholders.elements_importance')</h4>
                <table class="table module-table">
                    <thead>
                    <tr>
                        <th>@lang('imet-core::oecm_context.AnalysisStakeholders.element')</th>
                        <th>@lang('imet-core::oecm_context.AnalysisStakeholders.importance')</th>
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
                <h4>@lang('imet-core::oecm_context.AnalysisStakeholders.involvement_ranking')</h4>
                <table class="table module-table">
                    <thead>
                    <tr>
                        <th></th>
                        <th>@lang('imet-core::oecm_context.AnalysisStakeholders.involvement')</th>
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

                @php
                    $categories = array_key_exists($stakeholder, $stakeholders_categories)
                        ? json_decode($stakeholders_categories[$stakeholder])
                        : [];
                    $categories = $categories!==null ? $categories : [];
                @endphp

                @if($categories === [])
                    @include('imet-core::components.module.nothing_to_evaluate', ['num_cols' => 6])

                @else

                    {{-- groups --}}
                    @foreach($definitions['groups'] as $group_key => $group_label)

                        @if(
                            in_array('provisioning', $categories) && in_array($group_key, ['group0', 'group1', 'group2', 'group3']) ||
                            in_array('cultural', $categories) && in_array($group_key, ['group4', 'group5', 'group6' ]) ||
                            in_array('regulating', $categories) && in_array($group_key, ['group7', 'group8']) ||
                            in_array('supporting', $categories) && in_array($group_key, ['group9', 'group10'])
                        )

                            {{-- titles --}}
                            @if($group_key === 'group0')
                                <h4 style="margin-bottom: 20px;">@lang('imet-core::oecm_context.AnalysisStakeholders.titles.title0')</h4>
                            @elseif($group_key === 'group4')
                                <h4 style="margin-bottom: 20px;">@lang('imet-core::oecm_context.AnalysisStakeholders.titles.title1')</h4>
                            @elseif($group_key === 'group7')
                                <h4 style="margin-bottom: 20px;">@lang('imet-core::oecm_context.AnalysisStakeholders.titles.title2')</h4>
                            @elseif($group_key === 'group9')
                                <h4 style="margin-bottom: 20px;">@lang('imet-core::oecm_context.AnalysisStakeholders.titles.title3')</h4>
                            @elseif($group_key === 'group11')
                                <h4 style="margin-bottom: 20px;">@lang('imet-core::oecm_context.AnalysisStakeholders.titles.title4')</h4>
                            @endif

                            <h5 class="highlight group_title_{{ $definitions['module_key'] }}_{{ $group_key }}">{{ $group_label }}</h5>
                            @lang('imet-core::oecm_context.AnalysisStakeholders.groups_descriptions.' . $group_key)

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

                        @endif
                    @endforeach

                @endif

            </div>
        </div>
    </div>
@endforeach

