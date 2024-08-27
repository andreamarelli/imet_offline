<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vueData */

$group_key = $group_key ?? '';
$table_id = 'table_'.$definitions['module_key'];

?>

<table id="{{ $table_id }}" class="table module-table">

    {{-- labels  --}}
    <thead>
    <tr>
        @foreach($definitions['fields'] as $field)
            @if($field['type']!=='hidden')
                <th class="text-center">
                    {{ ucfirst($field['label'] ?? '') }}
                    @if($field['name']==="ActualPermanent")
                        </th>
                        <th class="text-center">
                            @uclang('imet-core::v1_context.ManagementStaff.fields.difference')
                    @endif

                </th>
            @endif


        @endforeach
    </tr>
    </thead>

    {{-- inputs --}}
    <tbody>
    <tr class="module-table-item" v-for="(item, index) in records">
        {{--  fields  --}}
        @foreach($definitions['fields'] as $field)
            <td>
                @include('modular-forms::module.edit.field.module-to-vue', [
                    'definitions' => $definitions,
                    'field' => $field,
                    'vue_record_index' => 'index',
                    'group_key' => $group_key
                ])

                @if($field['name']==="ActualPermanent")
                    </td>
                    <td>
                        <input type="text" disabled="disabled" style="width: 80px;"
                            class="field-edit text-right"
                            v-bind:value="diffs[index]"
                            v-bind:id="'{{$definitions['module_key'] }}_'+index+'_diff'"
                        />
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
                <x-modular-forms::module.components.buttons.delete-item />
            </span>
        </td>
    <tr>
    </tbody>

    <tfoot>
    {{-- add button --}}
    <tr>
        <td colspan="{{ count($definitions['fields']) + 1 }}">
            <x-modular-forms::module.components.buttons.add-item :group-key="$group_key" />
        </td>
    </tr>
    </tfoot>

</table>


@include('modular-forms::module.edit.type.commons', compact(['collection', 'vueData', 'definitions']))

@push('scripts')
    <script type="module">
        (new window.ImetCore.Apps.Modules.ImetV1.context.ManagementStaff(@json($vueData)))
            .mount('#module_{{ $definitions['module_key'] }}');
    </script>
@endpush
