<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */
/** @var String $group_key (optional - only for GROUP_TABLE) */

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
                    <th class="text-center">
                        @if($field['type']!=='hidden')
                            {{ ucfirst($field['label'] ?? '') }}
                        @endif
                    </th>
                @endforeach
                <th></th>
            </tr>
        </thead>

        {{-- inputs --}}
        <tbody class="{{ $group_key }}">
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

        @if(!$definitions['fixed_rows'])
            <tfoot v-if="max_rows==null || records.length < max_rows">
                {{-- add button --}}
                <tr>
                    <td colspan="{{ count($definitions['fields']) + 1 }}">
                        @include('modular-forms::buttons.add_item')
                    </td>
                </tr>
            </tfoot>
        @endif

    </table>
