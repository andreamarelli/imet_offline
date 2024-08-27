<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $records */

$record = $records[0];
$total_budget = \AndreaMarelli\ImetCore\Controllers\Imet\v1\ContextController::get_records_total_budget();
$group_key = $group_key ?? '';

$table_id = 'table_'.$definitions['module_key'];

$result = [];
$percentage_results = [];
foreach ($records as $index => $record) {
    $result[$index] = 0;
    $result[$index] += $record['NationalBudget'] !== null ? floatval($record['NationalBudget']) : 0;
    $result[$index] += $record['OwnRevenues'] !== null ? floatval($record['OwnRevenues']) : 0;
    $result[$index] += $record['Disputes'] !== null ? floatval($record['Disputes']) : 0;
    $result[$index] += $record['Partners'] !== null ? floatval($record['Partners']) : 0;
    $result[$index] = $result[$index] === 0 ? null : $result[$index];

    $total = floatval($result[$index]);
    if($total > 0){
        $percentage_results[$index] = round($total / $total_budget * 100, 1).' %';
    } else {
        $percentage_results[$index] = "";
    }
}
\AndreaMarelli\ImetCore\Controllers\Imet\v1\ContextController::set_financial_available_resources_totals($result);
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
            @uclang('imet-core::v1_context.FinancialAvailableResources.fields.total')
        </th>
        <th class="text-center">
            @uclang('imet-core::v1_context.FinancialAvailableResources.fields.percentage')
        </th>
    </tr>
    </thead>

    {{-- inputs --}}
    <tbody>
    @foreach($records as $index => $record)
        <tr class="module-table-item">
            @foreach($definitions['fields'] as $idx => $field)
                <td>
                    @include('modular-forms::module.show.field', [
                      'type' =>$definitions['fields'][$idx]['type'],
                         'value' => $record[$definitions['fields'][$idx]['name']]
                    ])
                </td>
            @endforeach
            <td>
                <input type="numeric" disabled="disabled"
                       class="field-edit field-numeric text-right"
                       value="{{$result[$index]}}"
                />
            </td>
            <td>
                <input type="text" disabled="disabled" style="width: 80px;"
                       class="field-edit field-numeric text-center"
                       value="{{$percentage_results[$index]}}"
                />
            </td>
        <tr>
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


@include('modular-forms::module.show.type.commons', compact(['collection', 'definitions']))
