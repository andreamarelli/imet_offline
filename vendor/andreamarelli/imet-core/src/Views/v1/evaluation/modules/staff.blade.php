<?php
/** @var Mixed $definitions */
/** @var String $group_key (optional - only for GROUP_TABLE) */

$group_key = '';

$table_id = 'table_'.$definitions['module_key'];

$tr_record = 'records';

?>

<table id="{{ $table_id }}" class="table module-table">

    {{-- labels  --}}
    <thead>
    <tr>
        <th class="text-center">{{ ucfirst($definitions['fields'][0]['label'] ?? '') }}</th>
        <th class="text-center">@uclang('imet-core::v1_evaluation.Staff.status')</th>
        <th class="text-center">{{ ucfirst($definitions['fields'][1]['label'] ?? '') }}</th>
        <th class="text-center">{{ ucfirst($definitions['fields'][2]['label'] ?? '') }}</th>
    </tr>
    </thead>

    {{-- inputs --}}
    <tbody class="{{ $group_key }}">
    <tr class="module-table-item" v-for="(item, index) in {{ $tr_record }}">
        {{--  fields  --}}


        <td>
            @include('modular-forms::module.edit.field.module-to-vue', [
                'definitions' => $definitions,
                'field' => $definitions['fields'][0],
                'vue_record_index' => 'index',
                'group_key' => $group_key
            ])
        </td>

        <td>
            @include('modular-forms::module.edit.field.vue', [
                'type' => 'disabled',
                'v_value' => 'records[index].__status',
                'id' => "'".$definitions['module_key']."_'+index+'___status'"
            ])
        </td>

        <td>
            @include('modular-forms::module.edit.field.module-to-vue', [
                'definitions' => $definitions,
                'field' => $definitions['fields'][1],
                'vue_record_index' => 'index',
                'group_key' => $group_key
            ])
        </td>

        <td>
            @include('modular-forms::module.edit.field.module-to-vue', [
                'definitions' => $definitions,
                'field' => $definitions['fields'][2],
                'vue_record_index' => 'index',
                'group_key' => $group_key
            ])
        </td>



        <td>
            {{-- group_key_field (for GROUP_TABLE)  --}}
            @if($definitions['module_type']==='GROUP_TABLE')
                @include('modular-forms::module.edit.field.vue', [
                    'type' => 'hidden',
                    'v_value' => 'item.'.$definitions['group_key_field']
                ])
            @endif
            {{-- record id  --}}
            @include('modular-forms::module.edit.field.vue', [
                'type' => 'hidden',
                'v_value' => 'item.'.$definitions['primary_key']
            ])
        </td>
    <tr>
    </tbody>


</table>

@include('modular-forms::module.edit.script', compact(['collection', 'vue_data', 'definitions']))
