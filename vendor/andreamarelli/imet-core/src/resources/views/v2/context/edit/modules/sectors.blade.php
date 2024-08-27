<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vueData */
/** @var String $group_key (optional - only for GROUP_TABLE) */

use \AndreaMarelli\ImetCore\Helpers\Template;
use \AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Component\ImetModule;

$group_key = $group_key ?? '';

$table_id = 'table_' . $definitions['module_key'];

?>

<table id="{{ $table_id }}" class="table module-table">

    {{-- labels  --}}
    <thead>
        <tr>
            @foreach($definitions['fields'] as $index=>$field)
                @if($field['type']!=='hidden')
                    @if($index==3)
                        <th class="text-center">
                            {!! Template::module_scope(ImetModule::TERRESTRIAL) . ' ' . ucfirst($field['label'] ?? '') !!}
                        </th>
                    @else
                        <th class="text-center">{{ ucfirst($field['label'] ?? '') }}</th>
                    @endif
                @endif
                @if($index==2)
                    <th class="text-center">@lang('imet-core::v2_context.Sectors.area_percentage')</th>
                @endif
                @if($index==4)
                    <th class="text-center">@lang('imet-core::v2_context.Sectors.average_time')</th>
                @endif
            @endforeach

            <th></th>
        </tr>
    </thead>

    {{-- inputs --}}
    <tbody class="{{ $group_key }}">

        <tr class="module-table-item" v-for="(item, index) in records">
            {{--  fields  --}}
            @foreach($definitions['fields'] as $index=>$field)
                <td>
                    @include('modular-forms::module.edit.field.module-to-vue', [
                        'definitions' => $definitions,
                        'field' => $field,
                        'vue_record_index' => 'index',
                        'group_key' => $group_key
                    ])
                </td>
                @if($index==2)
                    <td>
                        <input type="text" disabled="disabled"
                               class="field-edit field-numeric text-right"
                               v-bind:value="area_percentage[index]"
                        />
                    </td>
                @endif
                @if($index==4)
                    <td>
                        <input type="text" disabled="disabled"
                               class="field-edit field-numeric text-right"
                               v-bind:value="average_time[index]"
                        />
                    </td>
                @endif
            @endforeach
            <td>
                {{-- record id  --}}
                @include('modular-forms::module.edit.field.vue', [
                    'type' => 'hidden',
                    'v_value' => 'item.'.$definitions['primary_key']
                ])
                @if(!$definitions['fixed_rows'])
                    <span v-if="typeof item.__predefined === 'undefined'">
                        <x-modular-forms::module.components.buttons.delete-item />
                    </span>
                @endif
            </td>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td>
                <div class="field-preview" v-html="sumUnderControlArea"></div>
            </td>
            <td></td>
            <td>
                <input type="text" disabled="disabled"
                       class="field-preview field-numeric text-right"
                       v-bind:value="UnderControlPatrolKm"
                />
            </td>
            <td>
                <input type="text" disabled="disabled"
                       class="field-preview field-numeric text-right"
                       v-bind:value="UnderControlPatrolManDay"
                />
            </td>
            <td></td>
            <td></td>
        </tr>

    </tbody>

    @if(!$definitions['fixed_rows'])
        <tfoot v-if="max_rows==null || records.length < max_rows">
            {{-- add button --}}
            <tr>
                <td colspan="{{ count($definitions['fields']) + 1 }}">
                    <x-modular-forms::module.components.buttons.add-item :group-key="$group_key" />
                </td>
            </tr>
        </tfoot>
    @endif

</table>


@include('modular-forms::module.edit.type.commons', compact(['collection', 'vueData', 'definitions']))

@push('scripts')
    <script type="module">
        (new window.ImetCore.Apps.Modules.ImetV2.context.Sectors(@json($vueData)))
            .mount('#module_{{ $definitions['module_key'] }}');
    </script>
@endpush
