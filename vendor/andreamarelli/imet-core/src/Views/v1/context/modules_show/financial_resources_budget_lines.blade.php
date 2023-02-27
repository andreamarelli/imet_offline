<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $records */

$record = $records[0];

$group_key = $group_key ?? '';

$table_id = $definitions['module_type'] === 'GROUP_TABLE'
    ? 'group_table_'.$definitions['module_key'].'_'.$group_key
    : 'table_'.$definitions['module_key'];

$tr_record = $definitions['module_type'] === 'GROUP_TABLE'
    ? $records[$group_key]
    : $records;

$area = \AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context\Areas::getArea($record['FormID']);
$totals = \AndreaMarelli\ImetCore\Controllers\Imet\v1\ContextController::get_financial_available_resources_totals();
$totalBudget = array_reduce($totals, function ($carry, $item) {
    $carry += $item;
    return $carry;
});

$cost = [];
$percentage = [];

foreach ($records as $index => $record) {

    $cost[$index] = 0;
    if($area !== null){
        $cost[$index] = $record['Amount'] / $area * 100;
    }
    $cost[$index] = $cost[$index] === 0 ? null : round($cost[$index], 2);

    $val = floatval($cost[$index]);
    if($val > 0 && $totalBudget > 0){
        $percentage[$index] = round($val / $totalBudget * 100, 1).' %';
    } else {
        $percentage[$index] = "";
    }
}

?>

<table id="{{ $table_id }}" class="table module-table">

    {{-- labels  --}}
    <thead>
    <tr>
        @foreach($definitions['fields'] as $field)
            @if($field['type']!=='hidden')
                <th class="text-center">
                    {{ ucfirst($field['label'] ?? '') }}
                </th>
            @endif
        @endforeach
        <th class="text-center">
            @uclang('imet-core::v1_context.FinancialResourcesBudgetLines.fields.function_costs')
        </th>
        <th class="text-center">
            @uclang('imet-core::v1_context.FinancialResourcesBudgetLines.fields.percentage')
        </th>
    </tr>
    </thead>

    {{-- inputs --}}
    <tbody>
    @foreach($tr_record as $index => $record)
        <tr class="module-table-item">
            {{--  fields  --}}
            @foreach($definitions['fields'] as $f_index => $field)
                <td>
                    @include('modular-forms::module.show.field', [
                        'type' =>$definitions['fields'][$f_index]['type'],
                         'value' => $record[$definitions['fields'][$f_index]['name']]
                    ])
                </td>
            @endforeach
            <td>
                <input type="numeric" disabled="disabled"
                       class="input-number field-edit text-right"
                       value="{{$cost[$index]}}"

                />
            </td>
            <td>
                <input type="text" disabled="disabled" style="width: 80px;"
                       class="field-edit text-center"
                       value="{{$percentage[$index]}}"
                />
            </td>
        </tr>
    @endforeach
    </tbody>

    <tfoot>
    {{-- add button --}}
    <tr>
        <td colspan="{{ count($definitions['fields']) + 1 }}">

        </td>
    </tr>
    </tfoot>

</table>


@include('modular-forms::module.show.type.commons', compact(['collection','records', 'definitions']))
