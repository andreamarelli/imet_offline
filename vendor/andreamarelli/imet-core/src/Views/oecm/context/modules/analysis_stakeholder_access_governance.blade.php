<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */

/** @var Mixed $vue_data */

use \AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context\AnalysisStakeholderAccessGovernance;
use \AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context\StakeholdersNaturalResources;

$stakeholders = StakeholdersNaturalResources::calculateWeights($vue_data['form_id']);
arsort($stakeholders);

$vue_data['current_stakeholder'] = 'summary';
$vue_data['key_elements_importance'] = AnalysisStakeholderAccessGovernance::calculateKeyElementsImportances($vue_data['form_id'], $vue_data['records']);
$num_cols = count($definitions['fields']);

?>

{{-- Stakeholder's summary--}}
<div class="card">
    <div class="card-header">
        <h4 class="card-title" role="button" @click="switchStakeholder('summary')">
            @lang('imet-core::oecm_context.AnalysisStakeholderAccessGovernance.summary')
        </h4>
    </div>
    <div>
        <div class="card-body" v-if="isCurrentStakeholder('summary')" style="display: flex; column-gap: 40px;">

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
                    <tr class="module-table-item" v-for="element in key_elements_importance">
                        <td style="text-align: left;">@{{ element.element }}</td>
                        <td style="text-align: left;">@{{ element.importance }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div>
                <h4>@lang('imet-core::oecm_context.AnalysisStakeholderAccessGovernance.involvement_ranking')</h4>
                <table class="table module-table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>@lang('imet-core::oecm_context.AnalysisStakeholderAccessGovernance.involvement')</th>
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
                            $definitions['fixed_rows'] = false;
                        } else {
                            $definitions['fixed_rows'] = true;
                        }

                        $table_id = 'group_table_'.$definitions['module_key'].'_'.$group_key;
                        $tr_record = 'records[\''.$group_key.'\']';
                    @endphp

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
                               v-if="records['{{ $group_key }}'][0].Element===null">
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
                                @if(!$definitions['fixed_rows'])
                                    <span v-if="typeof item.__predefined === 'undefined'">
                                            @include('modular-forms::buttons.delete_item')
                                        </span>
                                @endif
                            </td>
                        </tr>

                        </tbody>

                        {{-- add button --}}
                        @if(!$definitions['fixed_rows'])
                            <tfoot>
                            <tr>
                                <td colspan="{{ count($definitions['fields']) + 1 }}">
                                    @include('modular-forms::buttons.add_item', [
                                        'onClick' => "addItem('". $group_key . "', '". $stakeholder . "')"
                                    ])
                                </td>
                            </tr>
                            </tfoot>
                        @endif

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

                deleteItem: function (event) {
                    let _this = this;

                    let table_row_index = event.currentTarget.closest('tr').rowIndex - 1; // force to start at 0
                    let group_key = event.currentTarget.closest('table').id.replace('group_table_' + this.module_key + '_', '');

                    let same_stakeholder_count = 0;
                    this.records[group_key].forEach(function (item, index) {

                        if (item['Stakeholder'] === _this.current_stakeholder && group_key === item['group_key']) {
                            if (same_stakeholder_count === table_row_index) {
                                _this.records[group_key].splice(index, 1);
                            }
                            same_stakeholder_count++;
                        }
                    });

                },

                saveModuleDoneCallback(data) {
                    this.key_elements_importance = data.key_elements_importance;
                    this.current_stakeholder = '{{ $vue_data['current_stakeholder'] }}';
                },

            }

        });
    </script>
@endpush