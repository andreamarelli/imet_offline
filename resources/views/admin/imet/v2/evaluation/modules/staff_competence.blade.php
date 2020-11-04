<?php
/** @var Mixed $definitions */

$table_id = 'table_'.$definitions['module_key'];
$tr_record = 'records';

?>

<table id="{{ $table_id }}" class="table module-table">

    {{-- labels  --}}
    <thead>
    <tr>
        @foreach($definitions['fields'] as $field)
            @if($field['type']!=='hidden')
                <th class="text-center">{{ isset($field['label']) ? ucfirst($field['label']) : '' }}</th>
            @endif
        @endforeach
        <th></th>
    </tr>
    </thead>

    {{-- inputs --}}
    <tbody >
        <tr class="module-table-item" v-for="(item, index) in {{ $tr_record }}">
            {{--  fields  --}}
            @foreach($definitions['fields'] as $field)
                <td>
                    @if($field['name']==='EvaluationScore' || $field['name']==='PercentageLevel')
                        @include('admin.components.module.edit.field.auto_vue', [
                            'definitions' => $definitions,
                            'field' => $field,
                            'vue_record_index' => 'index',
                            'vue_directives' => 'v-if="records[index].__num_staff!==0"'
                        ])
                    @else
                        @include('admin.components.module.edit.field.auto_vue', [
                            'definitions' => $definitions,
                            'field' => $field,
                            'vue_record_index' => 'index'
                        ])
                    @endif
                </td>
            @endforeach
            <td>
                {{-- record id  --}}
                @include('admin.components.module.edit.field.vue', [
                    'type' => 'hidden',
                    'v_value' => 'item.'.$definitions['primary_key']
                ])
            </td>
        </tr>
    </tbody>

</table>

@include('admin.components.module.edit.script', compact(['collection', 'vue_data', 'definitions']))