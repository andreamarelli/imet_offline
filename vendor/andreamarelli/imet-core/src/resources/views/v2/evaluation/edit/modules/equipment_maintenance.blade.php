<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vueData */

$table_id = 'table_'.$definitions['module_key'];

?>

<table id="{{ $table_id }}" class="table module-table">

    {{-- labels  --}}
    <thead>
    <tr>
        <th class="text-center">{{ ucfirst($definitions['fields'][0]['label'] ?? '') }}</th>
        <th class="text-center">{{ ucfirst($definitions['fields'][1]['label'] ?? '') }}</th>
        <th class="text-center">{{ ucfirst($definitions['fields'][2]['label'] ?? '') }}</th>
        <th class="text-center">{{ ucfirst($definitions['fields'][3]['label'] ?? '') }}</th>
    </tr>
    </thead>

    {{-- inputs --}}
    <tbody >
        <tr class="module-table-item" v-for="(item, index) in records">

            {{--  fields  --}}
            <td>
                @include('modular-forms::module.edit.field.vue', [
                   'type' => 'hidden',
                   'v_value' => 'records[index].Equipment',
                   'id' => "'".$definitions['module_key']."_'+index+'_Equipment'"
               ])
                @include('modular-forms::module.edit.field.vue', [
                    'type' => 'disabled',
                    'v_value' => 'records[index].__predefined_label',
                    'class' => 'field-disabled'
                ])
            </td>

            <td>
                @include('modular-forms::module.edit.field.module-to-vue', [
                    'definitions' => $definitions,
                    'field' => $definitions['fields'][1],
                    'vue_record_index' => 'index'
                ])
            </td>

            <td>
                @include('modular-forms::module.edit.field.module-to-vue', [
                    'definitions' => $definitions,
                    'field' => $definitions['fields'][2],
                    'vue_record_index' => 'index'
                ])
            </td>

            <td>
                @include('modular-forms::module.edit.field.module-to-vue', [
                    'definitions' => $definitions,
                    'field' => $definitions['fields'][3],
                    'vue_record_index' => 'index'
                ])
            </td>

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
    </tbody>

</table>

@include('modular-forms::module.edit.script', compact(['collection', 'vueData', 'definitions']))
