<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $records */

$record = $records[0];

$group_key = $group_key ?? '';
$table_id = 'table_' . $definitions['module_key'];

$diffs = AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context\ManagementStaff::diffs($records);

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
    @foreach($records as $i => $record)
        <tr class="module-table-item">
            {{--  fields  --}}
            @foreach($definitions['fields'] as $index => $field)
                <td>
                    @include('modular-forms::module.show.field', [
                         'type' =>$definitions['fields'][$index]['type'],
                         'value' => $record[$definitions['fields'][$index]['name']]
                    ])
                    @if($field['name']==="ActualPermanent")
                </td>
                <td>
                    <input type="text" disabled="disabled" style="width: 80px;"
                           class="field-edit text-right"
                           value="{{ $diffs[$i]  }}"
                    />
                    @endif
                </td>
    @endforeach
    <tr>
    @endforeach
    </tbody>

    <tfoot>

    </tfoot>

</table>


@include('modular-forms::module.show.type.commons', compact(['collection', 'definitions']))
