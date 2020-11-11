<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $records */

$group_key = '';
$table_id = 'table_'.$definitions['module_key'];


?>

<table id="{{ $table_id }}"  class="table module-table">

    {{-- labels  --}}
    <thead>
    <tr>
        @foreach($definitions['fields'] as $f_index=>$field)
            <th class="text-center">{{ ucfirst($field['label'] ?? '') }}</th>
        @endforeach
    </tr>
    </thead>

    {{-- inputs --}}
    <tbody class="{{ $group_key }}">
    @foreach($records as $record)
        <tr class="module-table-item">
            @foreach($definitions['fields'] as $f_index=>$field)
                <td>
                    @if($record['__num_staff']!==0 || $field['name']==='Theme' || $field['name']==='Comments')
                        @include('admin.components.module.preview.field', [
                            'type' => $field['type'],
                            'value' => $record[$field['name']]
                       ])
                    @endif
                </td>
            @endforeach
        </tr>
    @endforeach
    </tbody>

</table>
