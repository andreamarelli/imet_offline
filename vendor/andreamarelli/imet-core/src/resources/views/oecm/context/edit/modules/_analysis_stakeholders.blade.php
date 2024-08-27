<?php

use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context\AnalysisStakeholderDirectUsers;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context\AnalysisStakeholderIndirectUsers;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context\Stakeholders;
use AndreaMarelli\ModularForms\Helpers\DOM;
use AndreaMarelli\ModularForms\Helpers\Template;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

/** @var Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vueData */
/** @var Array $stakeholders */

$num_cols = count($definitions['fields']);

$user_mode = Str::contains($definitions['module_class'], 'AnalysisStakeholderDirectUsers')
    ? AnalysisStakeholderDirectUsers::$USER_MODE
    : AnalysisStakeholderIndirectUsers::$USER_MODE;

$stakeholders_categories = Stakeholders::getStakeholders(
    $vueData['form_id'],
    $user_mode,
    true
);


?>

@if(empty($stakeholders))
    @include('imet-core::components.module.nothing_to_evaluate', ['num_cols' => 6])
@else

    <x-modular-forms::accordion.container>

        @foreach(array_keys($stakeholders) as $index => $stakeholder)
            <x-modular-forms::accordion.item>

                <x-slot:title>
                    <div class="w-full	h-full"
                         @click="switchStakeholder('{{ Str::replace("'", "\'", $stakeholder) }}')">
                        {{ $index + 1 }} -
                        {{ $stakeholder }}
                    </div>
                </x-slot:title>

                <div v-if="isCurrentStakeholder('{{ Str::replace("'", "\'", $stakeholder) }}')">

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

                            @php
                                $table_id = 'group_table_'.$definitions['module_key'].'_'.$group_key;
                                $element_list = trans('imet-core::oecm_context.AnalysisStakeholders.lists.' . $group_key);
                                $element_list = array_combine($element_list, $element_list);
                            @endphp

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
                                @endif

                                {{-- sub-titles --}}
                                <h5 class="highlight group_title_{{ $definitions['module_key'] }}_{{ $group_key }}">{{ $group_label }}</h5>

                                {{-- Desctiptions --}}
                                <div class="pb-4 px-6 text-sm">
                                    @lang('imet-core::oecm_context.AnalysisStakeholders.groups_descriptions.' . $group_key)
                                </div>

                                <table id="{{ $table_id }}" class="table module-table">

                                    {{-- labels  --}}
                                    <thead>
                                    <tr>
                                        @foreach($definitions['fields'] as $index => $field)
                                            <th class="text-center">
                                                @if($field['type']!=='hidden')
                                                    {{ ucfirst($field['label'] ?? '') }}
                                                @endif
                                            </th>
                                        @endforeach
                                        <th></th>
                                    </tr>
                                    </thead>

                                    {{-- records --}}
                                    <tbody class="{{ $group_key }}">

                                        <template v-for="(item, index) in records">
                                            <tr class="module-table-item"
                                                    v-if="recordIsInGroup(item, '{{ $group_key }}') && isCurrentStakeholder(item['Stakeholder'])">
                                                {{--  fields  --}}
                                                @foreach($definitions['fields'] as $index => $field)

                                                    <td>

                                                        @if($field['name'] === 'Element')
                                                            <dropdown
                                                                data-values='@json($element_list)'
                                                                {!! DOM::vueAttributes("'".$definitions['module_key']."_'+index+'_".$field['name']."'", 'records[index].'.$field['name']) !!}
                                                            ></dropdown>
                                                        @else
                                                                @include('modular-forms::module.edit.field.module-to-vue', [
                                                                   'definitions' => $definitions,
                                                                   'field' => $field,
                                                                   'vue_record_index' => 'index',
                                                                   'group_key' => $group_key
                                                               ])
                                                        @endif
                                                    </td>
                                                @endforeach
                                                <td>
                                                    {{-- record id  --}}
                                                    @include('modular-forms::module.edit.field.vue', [
                                                        'type' => 'hidden',
                                                        'v_value' => 'item.'.$definitions['primary_key']
                                                    ])
                                                    <span v-if="typeof item.__predefined === 'undefined'">
                                                         <button type="button" class="btn-nav small red" v-on:click="deleteItem(index, '{{ $group_key }}', '{{ $stakeholder }}')">
                                                             {!! Template::icon('trash', 'white') !!}
                                                        </button>
                                                    </span>
                                                </td>
                                            </tr>
                                        </template>

                                    </tbody>

                                    {{-- add button --}}
                                    <tfoot v-if="numItemPerGroupAndStakeholder('{{ $group_key }}', '{{ $stakeholder }}') < {{ $definitions['max_rows'] }}">
                                        <tr>
                                            <td colspan="{{ count($definitions['fields']) + 1 }}">
                                                <button type="button" class="btn-nav small " v-on:click="addItem('{{ $group_key }}', '{{ $stakeholder }}')">
                                                    {!! Template::icon('plus-circle', 'white') !!} {!! Str::ucfirst((trans('modular-forms::common.add_item'))) !!}
                                                </button>
                                            </td>
                                        </tr>
                                    </tfoot>

                                </table>


                                <br/>
                                <br/>
                            @endif
                        @endforeach

                    @endif

                </div>

            </x-modular-forms::accordion.item>
        @endforeach

    </x-modular-forms::accordion.container>

@endif

@push('scripts')
    <script type="module">
        (new window.ImetCore.Apps.Modules.Oecm.context.AnalysisStakeholder(@json($vueData)))
            .mount('#module_{{ $definitions['module_key'] }}');
    </script>
@endpush
