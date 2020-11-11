<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $records */

$record  = $records[0];

$group_key = 'null';
$table_id = 'table_'.$definitions['module_key'];

$area = array_key_exists('FormID', $record) ? \App\Models\Imet\v2\Modules\Context\Areas::getArea($record['FormID']) : null;
$totalBudget = array_key_exists('FormID', $record) ? \App\Models\Imet\v2\Modules\Context\FinancialResources::getTotalBudget($records[0]['FormID']) : null;


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
            {{ ucfirst(trans('form/imet/v2/context.FinancialResourcesBudgetLines.fields.function_costs')) }}
        </th>
        <th class="text-center">
            {{ ucfirst(trans('form/imet/v2/context.FinancialResourcesBudgetLines.fields.percentage')) }}
        </th>
    </tr>
    </thead>

    {{-- inputs --}}
    <tbody>
    <?php
        $totalSum = 0;
    ?>
    @foreach($records as $record)
        <?php
            $sumRow = $record['Amount']>0 && $area>0 ? $record['Amount'] / $area * 100 : 0;
            $percentRow = $record['Amount']>0 && $totalBudget>0 ? $record['Amount'] / $totalBudget * 100 : 0;
            $totalSum += $sumRow;
        ?>
        <tr class="module-table-item">
            {{--  fields  --}}
            @foreach($definitions['fields'] as $field)
                <td>
                    @include('admin.components.module.preview.field', [
                        'type' => $field['type'],
                        'value' => $record[$field['name']]
                   ])
                </td>
            @endforeach
            <td>
                @include('admin.components.module.preview.field', [
                                   'type' => 'numeric',
                                   'value' => $sumRow>0 ? $sumRow : ''
                               ])</td>
            <td>
                @include('admin.components.module.preview.field', [
                                   'type' => 'numeric',
                                   'value' => $percentRow>0 ? $percentRow : ''
                               ])
            </td>
        </tr>
        @endforeach
        <tr class="module-table-item">
            <td></td>
            <td>
                @include('admin.components.module.preview.field', [
                   'type' => 'numeric',
                   'value' => 999
               ])
            </td>
            <td colspan="4">
            </td>
        </tr>
    </tbody>

</table>


@include('admin.components.module.preview.type.commons', compact(['collection', 'vue_data', 'definitions']))
