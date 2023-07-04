<?php

use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context\Stakeholders;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

/** @var Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */

/** @var Array $stakeholders */
$num_cols = count($definitions['fields']);

//$categories_per_stakeholders = Stakeholders::getStakeholders($vue_data['form_id'], Stakeholders::ALL_USERS, true);
//$groups_per_category = [
//    'provisioning'  => ['group0', 'group1', 'group2', 'group3'],
//    'cultural'      => ['group4', 'group5', 'group6'],
//    'regulating'    => ['group7', 'group8'],
//    'supporting'    => ['group9', 'group10'],
//    'biodiversity'  => ['group11', 'group12', 'group13']
//];
//

?>

{{-- Stakeholder's summary--}}
<div class="card">
    <div class="card-header">
        <h4 class="card-title" role="button" @click="switchStakeholder('summary')">
            @lang('imet-core::oecm_context.AnalysisStakeholders.summary')
        </h4>
    </div>
    <div>
        <div class="card-body" v-if="isCurrentStakeholder('summary')" style="display: flex; column-gap: 40px;">

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
                    <tr class="module-table-item" v-for="element in key_elements_importance">
                        <td style="text-align: left;">@{{ element.element }}</td>
                        <td style="text-align: left;">@{{ element.importance }}</td>
                    </tr>
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
            <h4 class="card-title" role="button"
                @click="switchStakeholder('{{ Str::replace("'", "\'", $stakeholder) }}')">
                {{ $index + 1 }} -
                {{ $stakeholder }}
            </h4>
        </div>
        <div v-if="isCurrentStakeholder('{{ Str::replace("'", "\'", $stakeholder) }}')">
            <div class="card-body">

{{--                <div v-for="(gg_label, gg_key) in {{ json_encode($definitions['groups']) }}">--}}

{{--                    --}}{{-- category title --}}
{{--                    <h4 v-if="gg_key==='group0'" style="margin-bottom: 20px;">@lang('imet-core::oecm_context.AnalysisStakeholders.titles.title0')</h4>--}}
{{--                    <h4 v-else-if="gg_key==='group4'" style="margin-bottom: 20px;">@lang('imet-core::oecm_context.AnalysisStakeholders.titles.title1')</h4>--}}
{{--                    <h4 v-else-if="gg_key==='group7'" style="margin-bottom: 20px;">@lang('imet-core::oecm_context.AnalysisStakeholders.titles.title2')</h4>--}}
{{--                    <h4 v-else-if="gg_key==='group9'" style="margin-bottom: 20px;">@lang('imet-core::oecm_context.AnalysisStakeholders.titles.title3')</h4>--}}
{{--                    <h4 v-else-if="gg_key==='group11'" style="margin-bottom: 20px;">@lang('imet-core::oecm_context.AnalysisStakeholders.titles.title4')</h4>--}}

{{--                    --}}{{-- group title --}}
{{--                    <h5 :class="'highlight group_title_{{ $definitions['module_key'] }}_' + gg_key">@{{ gg_label }}</h5>--}}

{{--                </div>--}}

{{--                ############################################################--}}

                {{-- groups --}}
                @foreach($definitions['groups'] as $group_key => $group_label)

                    @php
                        if(in_array($group_key, ['group11', 'group12', 'group13'])){
                            $definitions['max_rows'] = 9999;
                        } else {
                            $definitions['max_rows'] = 5;
                        }

                        $table_id = 'group_table_'.$definitions['module_key'].'_'.$group_key;
                        $tr_record = 'records[\''.$group_key.'\']';
                    @endphp

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

                    <table id="{{ $table_id }}" class="table module-table">

                        {{-- labels  --}}
                        <thead>
                        <tr>
                            @foreach($definitions['fields'] as $index => $field)
                                @if(!(($index==1 || $index==2) && in_array($group_key, ['group11', 'group12', 'group13'])))
                                    <th class="text-center">
                                        @if($field['type']!=='hidden')
                                            {{ ucfirst($field['label'] ?? '') }}
                                        @endif
                                    </th>
                                @endif
                            @endforeach
                            <th></th>
                        </tr>
                        </thead>

                        {{-- nothing to evaluate --}}
                        <tbody class="{{ $group_key }}"
                               v-if="records['{{ $group_key }}'][0].Element===null && ['group11', 'group12', 'group13'].includes('{{ $group_key }}')">
                        @include('imet-core::components.module.nothing_to_evaluate', ['num_cols' => $num_cols])
                        </tbody>

                        {{-- records --}}
                        <tbody class="{{ $group_key }}" v-else>

                        <tr class="module-table-item" v-for="(item, index) in {{ $tr_record }}"
                            v-if="isCurrentStakeholder(item['Stakeholder'])">
                            {{--  fields  --}}
                            @foreach($definitions['fields'] as $index => $field)
                                @if(!(($index==1 || $index==2) && in_array($group_key, ['group11', 'group12', 'group13'])))
                                    <td>
                                        @include('modular-forms::module.edit.field.module-to-vue', [
                                           'definitions' => $definitions,
                                           'field' => $field,
                                           'vue_record_index' => 'index',
                                           'group_key' => $group_key
                                       ])
                                    </td>
                                @endif
                            @endforeach
                            <td>
                                {{-- record id  --}}
                                @include('modular-forms::module.edit.field.vue', [
                                    'type' => 'hidden',
                                    'v_value' => 'item.'.$definitions['primary_key']
                                ])
                                <span v-if="typeof item.__predefined === 'undefined'">
                                    @include('modular-forms::buttons.delete_item')
                                </span>
                            </td>
                        </tr>

                        </tbody>

                        {{-- add button --}}
                        <tfoot v-if="numItemPerGroupAndStakeholder('{{ $group_key }}', '{{ $stakeholder }}') < {{ $definitions['max_rows'] }}">
                            <tr>
                                <td colspan="{{ count($definitions['fields']) + 1 }}">
                                    @include('modular-forms::buttons.add_item', [
                                        'onClick' => "addItem('". $group_key . "', '". Str::replace("'", "\'", $stakeholder)  . "')"
                                    ])
                                </td>
                            </tr>
                        </tfoot>

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

                showAddButton(group_key, stakeholder){
                    let count = 0;
                    if(['group11', 'group12', 'group13'].includes(group_key)){
                        return false;
                    }
                    this.records[group_key].forEach(function (item, index) {
                        if (item['Stakeholder'] === stakeholder){
                            count++;
                        }
                    });
                },

                numItemPerGroupAndStakeholder: function (group_key, stakeholder) {
                    let count = 0;
                    this.records[group_key].forEach(function (item, index) {
                        if (item['Stakeholder'] === stakeholder){
                            count++;
                        }
                    });
                    return count;
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
