<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */


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
        <th class="text-center">{{ isset($definitions['fields'][0]['label']) ? ucfirst($definitions['fields'][0]['label']) : '' }}</th>
        <th class="text-center">{{ isset($definitions['fields'][1]['label']) ? ucfirst($definitions['fields'][1]['label']) : '' }}</th>
        <th class="text-center">{{ isset($definitions['fields'][2]['label']) ? ucfirst($definitions['fields'][2]['label']) : '' }}</th>
        <th class="text-center">{{ isset($definitions['fields'][3]['label']) ? ucfirst($definitions['fields'][3]['label']) : '' }}</th>
    </tr>
    </thead>

    {{-- inputs --}}
    <tbody >
        <tr class="module-table-item" v-for="(item, index) in {{ $tr_record }}">
            {{--  fields  --}}

            <td>
                @include('admin.components.module.edit.field.vue', [
                   'type' => 'hidden',
                   'v_value' => 'records[index].Equipment',
                   'id' => "'".$definitions['module_key']."_'+index+'_Equipment'"
               ])
                @include('admin.components.module.edit.field.vue', [
                    'type' => 'disabled',
                    'v_value' => 'records[index].__predefined_label',
                    'class' => 'field-disabled'
                ])
            </td>

            <td>
                @include('admin.components.module.edit.field.vue', [
                    'type' => 'disabled',
                    'v_value' => 'records[index].AdequacyLevel.toFixed(2)',
                    'id' => "'".$definitions['module_key']."_index_AdequacyLevel'",
                    'class' => 'text-center'
                ])
            </td>

            <td>
                @include('admin.components.module.edit.field.auto_vue', [
                    'definitions' => $definitions,
                    'field' => $definitions['fields'][2],
                    'vue_record_index' => 'index'
                ])
            </td>

            <td>
                @include('admin.components.module.edit.field.auto_vue', [
                    'definitions' => $definitions,
                    'field' => $definitions['fields'][3],
                    'vue_record_index' => 'index'
                ])
            </td>



            <td>
                {{-- record id  --}}
                @include('admin.components.module.edit.field.vue', [
                    'type' => 'hidden',
                    'v_value' => 'item.'.$definitions['primary_key']
                ])
                @if(!$definitions['fixed_rows'])
                    <span v-if="typeof item.__predefined === 'undefined'">
                                @include('admin.components.buttons.delete_item')
                            </span>
                @endif
            </td>
        </tr>
    </tbody>

</table>

@include('admin.components.module.edit.script', compact(['collection', 'vue_data', 'definitions']))