<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $records */

$group_key = null;
$table_id = 'table_'.$definitions['module_key'];

if (!function_exists('financial_resources_calc')) {
    function financial_resources_calc($value, $value2){
        if(floatval($value)>0 && floatval($value2)>0){
            return round(floatval($value)/floatval($value2), 2);
        }
        return null;
    }
}

$record = $records[0];
$area = array_key_exists('FormID', $record) ? \AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context\Areas::getArea($record['FormID']) : null;


?>

@component('modular-forms::module.field_container', [
               'name' => $definitions['fields'][0]['name'],
               'label' => $definitions['fields'][0]['label'] ?? '',
               'label_width' => $definitions['label_width']
           ])

    {{-- input field --}}
    @include('modular-forms::module.show.field', [
        'type' =>$definitions['fields'][0]['type'],
        'value' => $record[$definitions['fields'][0]['name']]
   ])

@endcomponent

@component('modular-forms::module.field_container', [
               'name' => $definitions['fields'][1]['name'],
               'label' => $definitions['fields'][1]['label'] ?? '',
               'label_width' => $definitions['label_width']
           ])

    {{-- input field --}}
    @include('modular-forms::module.show.field', [
        'type' =>$definitions['fields'][1]['type'],
        'value' => $record[$definitions['fields'][1]['name']]
   ])

@endcomponent

<table id="{{ $table_id }}"  class="table module-table">

    {{-- labels  --}}
    <thead>
        <tr>
            <th></th>
            <th class="text-center" style="width: 200px;">@lang('imet-core::v2_context.FinancialResources.amount')</th>
            <th class="text-center">@lang('imet-core::v2_context.FinancialResources.functioning_costs')</th>
            <th class="text-center">@lang('imet-core::v2_context.FinancialResources.estimation_financial_plan')</th>
            <th class="text-center">@lang('imet-core::v2_context.FinancialResources.estimation_operational_plan')</th>
        </tr>
    </thead>

    <tbody class="{{ $group_key }}">
        <tr>
            <td>
                <label for="{{  $definitions['fields'][2]['name'] }}">{!! ucfirst($definitions['fields'][2]['label']) !!}</label>
            </td>
            <td>
                @include('modular-forms::module.show.field', [
                    'type' =>$definitions['fields'][2]['type'],
                    'value' => $record[$definitions['fields'][2]['name']]
                ])
            </td>
            <td>
                @include('modular-forms::module.show.field', [
                    'type' => 'numeric',
                    'value' => financial_resources_calc($record['ManagementFinancialPlanCosts'], $area)
                ])
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>
                <label for="{{  $definitions['fields'][3]['name'] }}">{!! ucfirst($definitions['fields'][3]['label']) !!}</label>
            </td>
            <td>
                @include('modular-forms::module.show.field', [
                    'type' =>$definitions['fields'][3]['type'],
                    'value' => $record[$definitions['fields'][3]['name']]
                ])
            </td>
            <td>
                @include('modular-forms::module.show.field', [
                    'type' => 'numeric',
                    'value' => financial_resources_calc($record['OperationalWorkPlanCosts'], $area)
                ])
            </td>
            <td>
                @include('modular-forms::module.show.field', [
                    'type' => 'numeric',
                    'value' => financial_resources_calc($record['OperationalWorkPlanCosts'], $record['ManagementFinancialPlanCosts'])*100
                ])
            </td>
            <td></td>
        </tr>
        <tr>
            <td>
                <label for="{{  $definitions['fields'][4]['name'] }}">{!! ucfirst($definitions['fields'][4]['label']) !!}</label>
            </td>
            <td>
                @include('modular-forms::module.show.field', [
                    'type' =>$definitions['fields'][4]['type'],
                    'value' => $record[$definitions['fields'][4]['name']]
                ])
            </td>
            <td>
                @include('modular-forms::module.show.field', [
                    'type' => 'numeric',
                    'value' => financial_resources_calc($record['TotalBudget'], $area)
                ])
            </td>
            <td>

                @include('modular-forms::module.show.field', [
                    'type' => 'numeric',
                    'value' => financial_resources_calc($record['TotalBudget'], $record['ManagementFinancialPlanCosts'])*100
                ])
            </td>
            <td>

                @include('modular-forms::module.show.field', [
                    'type' => 'numeric',
                    'value' => financial_resources_calc($record['TotalBudget'], $record['OperationalWorkPlanCosts'])*100
                ])
            </td>
        </tr>
    </tbody>

</table>
