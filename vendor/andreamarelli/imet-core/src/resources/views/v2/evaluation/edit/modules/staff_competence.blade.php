<?php
/** @var Mixed $definitions */

$table_id = 'table_'.$definitions['module_key'];

?>

<table id="{{ $table_id }}" class="table module-table">

    {{-- labels  --}}
    <thead>
    <tr>
        @foreach($definitions['fields'] as $field)
            @if($field['type']!=='hidden')
                <th class="text-center">{{ ucfirst($field['label'] ?? '') }}</th>
            @endif
        @endforeach
        <th></th>
    </tr>
    </thead>

    {{-- inputs --}}
    <tbody >
        <tr class="module-table-item" v-for="(item, index) in records">
            {{--  fields  --}}
            @foreach($definitions['fields'] as $field)
                <td>
                    @if($field['name']==='EvaluationScore' || $field['name']==='PercentageLevel')
                        @include('modular-forms::module.edit.field.module-to-vue', [
                            'definitions' => $definitions,
                            'field' => $field,
                            'vue_record_index' => 'index',
                            'vue_directives' => 'v-if="records[index].__num_staff!==0"'
                        ])
                    @else
                        @include('modular-forms::module.edit.field.module-to-vue', [
                            'definitions' => $definitions,
                            'field' => $field,
                            'vue_record_index' => 'index'
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
            </td>
        </tr>
    </tbody>

</table>

@include('modular-forms::module.edit.script', compact(['collection', 'vueData', 'definitions']))
