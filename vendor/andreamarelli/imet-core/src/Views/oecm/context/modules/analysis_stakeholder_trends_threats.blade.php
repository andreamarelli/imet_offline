<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */

/** @var Mixed $vue_data */


use \AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context\AnalysisStakeholderTrendsThreats;
use \AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context\StakeholdersNaturalResources;

$stakeholders = StakeholdersNaturalResources::getStakeholders($vue_data['form_id']);

$vue_data['current_stakeholder'] = 'summary';
$vue_data['key_elements_importance'] = AnalysisStakeholderTrendsThreats::calculateKeyElementsImportances2($vue_data['form_id'], $vue_data['records']);
$num_cols = count($definitions['fields']);
?>


{{-- Stakeholder's summary--}}
<div class="card">
    <div class="card-header">
        <h4 class="card-title" role="button" @click="switchStakeholder('summary')">
            @lang('imet-core::oecm_context.AnalysisStakeholderTrendsThreats.summary')
        </h4>
    </div>
    <div>
        <div class="card-body" v-if="isCurrentStakeholder('summary') ">

            <table class="table module-table">
                <thead>
                <tr>
                    <th>@lang('imet-core::oecm_context.AnalysisStakeholderTrendsThreats.fields.Element')</th>
                    <th>@lang('imet-core::oecm_context.AnalysisStakeholderTrendsThreats.fields.Status')</th>
                    <th>@lang('imet-core::oecm_context.AnalysisStakeholderTrendsThreats.fields.Trend')</th>
                    <th>@lang('imet-core::oecm_context.AnalysisStakeholderTrendsThreats.average')</th>
                </tr>
                </thead>
                <tbody>
                <tr class="module-table-item" v-for="element in key_elements_importance">
                    <td style="text-align: left;">@{{ element.element }}</td>
                    <td style="text-align: left;">@{{ element.status }}</td>
                    <td style="text-align: left;">@{{ element.trend }}</td>
                    <td style="text-align: left;">@{{ element.importance }}</td>
                </tr>
                </tbody>
            </table>

        </div>
    </div>
</div>


@foreach($stakeholders as $index => $stakeholder)
    <div class="card">
        <div class="card-header">
            <h4 class="card-title" role="button" @click="switchStakeholder('{{ $stakeholder }}')">
                {{ $index + 1 }} -
                {{ $stakeholder }}
            </h4>
        </div>
        <div v-if="isCurrentStakeholder('{{ $stakeholder }}')">
            <div class="card-body">


                {{-- groups --}}
                @foreach($definitions['groups'] as $group_key => $group_label)

                    @php
                        if(in_array($group_key, ['group0', 'group1', 'group2'])){
                            $definitions['fixed_rows'] = true;
                        } else {
                            $definitions['fixed_rows'] = false;
                        }

                        $table_id = 'group_table_'.$definitions['module_key'].'_'.$group_key;
                        $tr_record = 'records[\''.$group_key.'\']';
                    @endphp

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


                    <table id="{{ $table_id }}" class="table module-table">

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

                        {{-- nothing to evaluate --}}
                        <tbody class="{{ $group_key }}"
                               v-if="doesNotHaveElements('{{ $group_key }}', '{{ $stakeholder }}')">
                        @include('imet-core::components.module.nothing_to_evaluate', ['num_cols' => $num_cols])
                        </tbody>

                        {{-- records --}}
                        <tbody class="{{ $group_key }}" v-else>

                        <tr class="module-table-item" v-for="(item, index) in {{ $tr_record }}"
                            v-if="isCurrentStakeholder(item['Stakeholder'])">
                            {{--  fields  --}}
                            @foreach($definitions['fields'] as $index => $field)
                                <td>
                                    @include('modular-forms::module.edit.field.module-to-vue', [
                                       'definitions' => $definitions,
                                       'field' => $field,
                                       'vue_record_index' => 'index',
                                       'group_key' => $group_key
                                   ])
                                </td>
                            @endforeach
                            <td>
                                {{-- record id  --}}
                                @include('modular-forms::module.edit.field.vue', [
                                    'type' => 'hidden',
                                    'v_value' => 'item.'.$definitions['primary_key']
                                ])
                            </td>
                        </tr>

                        </tbody>


                    </table>

                    <br/>
                    <br/>
                @endforeach

            </div>
        </div>
    </div>
@endforeach




@push('scripts')
    <script>
        // ## Initialize Module controller ##
        let module_{{ $definitions['module_key'] }} = new window.ModularForms.ModuleController({
            el: '#module_{{ $definitions['module_key'] }}',
            data: @json($vue_data),

            methods: {

                doesNotHaveElements(group_key, stakeholder) {
                    let does_not_hav_elements = true;
                    this.records[group_key].forEach(function (item) {
                        if (item['Stakeholder'] === stakeholder) {
                            does_not_hav_elements = false;
                        }
                    })
                    return does_not_hav_elements;
                },

                isCurrentStakeholder(value) {
                    return this.current_stakeholder === value;
                },

                switchStakeholder(value) {
                    if (!this.isCurrentStakeholder(value)) {
                        this.current_stakeholder = value;
                    } else {
                        this.current_stakeholder = null;
                    }
                    this.resetModule();
                },

                addItem: function (group_key, stakeholder) {
                    this.records[group_key].push(this.__no_reactive_copy(this.empty_record));
                    this.records[group_key][this.records[group_key].length - 1][this.group_key_field] = group_key;
                    this.records[group_key][this.records[group_key].length - 1]['Stakeholder'] = stakeholder;
                },

                saveModuleDoneCallback(data) {
                    this.key_elements_importance = data.key_elements_importance;
                    this.current_stakeholder = '{{ $vue_data['current_stakeholder'] }}';
                },

            }

        });
    </script>
@endpush
