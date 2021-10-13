<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */

$group_key = $group_key ?? '';

$table_id = $definitions['module_type']==='GROUP_TABLE'
    ? 'group_table_'.$definitions['module_key'].'_'.$group_key
    : 'table_'.$definitions['module_key'];

$tr_record = $definitions['module_type']==='GROUP_TABLE'
    ? 'records[\''.$group_key.'\']'
    : 'records'

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
                            @lang_u('imet-core::v1_context.ManagementStaff.fields.difference')
                    @endif

                </th>
            @endif


        @endforeach
    </tr>
    </thead>

    {{-- inputs --}}
    <tbody>
    <tr class="module-table-item" v-for="(item, index) in {{ $tr_record }}">
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
                @include('modular-forms::buttons.delete_item')
            </span>
        </td>
    <tr>
    </tbody>

    <tfoot>
    {{-- add button --}}
    <tr>
        <td colspan="{{ count($definitions['fields']) + 1 }}">
            @include('modular-forms::buttons.add_item')
        </td>
    </tr>
    </tfoot>

</table>


@include('modular-forms::module.edit.type.commons', compact(['collection', 'vue_data', 'definitions']))

@push('scripts')
    <script>
        // ## Initialize Module controller ##
        let module_{{ $definitions['module_key'] }} = new window.ModularForms.ModuleController({
            el: '#module_{{ $definitions['module_key'] }}',
            data: @json($vue_data),

            computed: {

                diffs() {
                    let diffs = [];
                    this.records.forEach(function (item, index) {
                        diffs[index] = null;
                        if (item['ExpectedPermanent'] !== null && item['ActualPermanent']) {
                            diffs[index] += parseInt(item['ActualPermanent']) - parseInt(item['ExpectedPermanent']);
                        }
                    });
                    return diffs;
                }

            }
        });
    </script>
@endpush
