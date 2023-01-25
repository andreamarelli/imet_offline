<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $records */
$record = $records[0];

$area = \AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context\Areas::getArea($record['FormID']);
\AndreaMarelli\ImetCore\Controllers\Imet\v1\Controller::set_records_total_budget($record['TotalBudget']);
$fn = function ($value) {
    if (!is_infinite($value) && $value > 0) {
        return true;
    }
    return false;
};

$value_financial_plans_costs_value_1 = $record['ManagementFinancialPlanCosts'];
$value_financial_plans_costs_value_2 = $area;
$value_financial_plans_costs_result = "";
if ($fn($value_financial_plans_costs_value_2) && $fn($value_financial_plans_costs_value_1)) {
    $value_financial_plans_costs_result = round($value_financial_plans_costs_value_1 / $value_financial_plans_costs_value_2, 2);
}

$value_operation_work_plan_costs_value_1 = $record['OperationalWorkPlanCosts'];
$value_operation_work_plan_costs_value_2 = $area;
$value_operation_work_plan_costs_result = "";
if ($fn($value_operation_work_plan_costs_value_2) && $fn($value_operation_work_plan_costs_value_1)) {
    $value_operation_work_plan_costs_result = round($value_operation_work_plan_costs_value_1 / $value_operation_work_plan_costs_value_2, 2);
}

$value_total_budget_value_1 = $record['TotalBudget'];
$value_total_budget_value_2 = $area;
$value_total_budget_result = "";
if ($fn($value_total_budget_value_2) && $fn($value_total_budget_value_1)) {
    $value_total_budget_result = round($value_total_budget_value_1 / $value_total_budget_value_2, 2);
}

$value_estimation_financial_plan_2_value_1 = $record['OperationalWorkPlanCosts'];
$value_estimation_financial_plan_2_value_2 = $record['ManagementFinancialPlanCosts'];
$value_estimation_financial_plan_2_result = "";
if ($fn($value_estimation_financial_plan_2_value_1) && $fn($value_estimation_financial_plan_2_value_2)) {
    $value_estimation_financial_plan_2_result = round($value_estimation_financial_plan_2_value_1 / $value_estimation_financial_plan_2_value_2 * 100, 1);
}

$value_estimation_financial_plan_3_value_1 = $record['TotalBudget'];
$value_estimation_financial_plan_3_value_2 = $record['ManagementFinancialPlanCosts'];
$value_estimation_financial_plan_3_result = "";
if ($fn($value_estimation_financial_plan_3_value_1) && $fn($value_estimation_financial_plan_3_value_2)) {
    $value_estimation_financial_plan_3_result = round($value_estimation_financial_plan_3_value_1 / $value_estimation_financial_plan_3_value_2 * 100, 1);
}

$value_estimation_operational_plan_3_value_1 = $record['TotalBudget'];
$value_estimation_operational_plan_3_value_2 = $record['OperationalWorkPlanCosts'];
$value_estimation_operational_plan_3_result = "";
if ($fn($value_estimation_operational_plan_3_value_1) && $fn($value_estimation_operational_plan_3_value_2)) {
    $value_estimation_operational_plan_3_result = round($value_estimation_operational_plan_3_value_1 / $value_estimation_operational_plan_3_value_2 * 100, 1);
}
?>


@component('modular-forms::module.field_container', [
           'name' => $definitions['fields'][0]['name'],
           'label' => $definitions['fields'][0]['label'] ?? '',
           'label_width' => $definitions['label_width']
       ])

    {{-- input field --}}
    @include('modular-forms::module.show.field', [
        'type' =>'',
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

<table id="{{ 'table_'.$definitions['module_key'] }}" class="table module-table">
    <tr>
        <td></td>
        <th class="text-center" style="width: 200px;">@lang('imet-core::v1_context.FinancialResources.amount')</th>
        <th class="text-center">@lang('imet-core::v1_context.FinancialResources.functioning_costs')</th>
        <th class="text-center">@lang('imet-core::v1_context.FinancialResources.estimation_financial_plan')</th>
        <th class="text-center">@lang('imet-core::v1_context.FinancialResources.estimation_operational_plan')</th>
    </tr>
    <tr>
        <td>
            <label
                for="{{  $definitions['fields'][2]['name'] }}">{!! ucfirst($definitions['fields'][2]['label']) !!}</label>
        </td>
        <td>
            @include('modular-forms::module.show.field', [
                'type' => $definitions['fields'][2]['type'],
                'value' => $record[$definitions['fields'][2]['name']]
            ])
        </td>
        <td><input type="text" disabled="disabled" value="{{$value_financial_plans_costs_result}}"
                   class="input-number field-edit text-right"/></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>
            <label
                for="{{  $definitions['fields'][3]['name'] }}">{!! ucfirst($definitions['fields'][3]['label']) !!}</label>
        </td>
        <td>
            @include('modular-forms::module.show.field', [
               'type' =>$definitions['fields'][3]['type'],
                    'value' => $record[$definitions['fields'][3]['name']]
            ])
        </td>
        <td><input type="text" disabled="disabled" value="{{$value_operation_work_plan_costs_result}}"
                   class="input-number field-edit text-right"/></td>
        <td><input type="text" disabled="disabled" value="{{$value_estimation_financial_plan_2_result}}"
                   class="input-number field-edit text-right"/></td>
        <td></td>
    </tr>
    <tr>
        <td>
            <label
                for="{{  $definitions['fields'][4]['name'] }}">{!! ucfirst($definitions['fields'][4]['label']) !!}</label>
        </td>
        <td>
            @include('modular-forms::module.show.field', [
                    'type' =>$definitions['fields'][4]['type'],
                    'value' => $record[$definitions['fields'][4]['name']]
            ])
        </td>
        <td><input type="text" disabled="disabled" value="{{$value_total_budget_result}}"
                   class="input-number field-edit text-right"/></td>
        <td><input type="text" disabled="disabled" value="{{$value_estimation_financial_plan_3_result}}"
                   class="input-number field-edit text-right"/></td>
        <td><input type="text" disabled="disabled" value="{{$value_estimation_operational_plan_3_result}}"
                   class="input-number field-edit text-right"/></td>
        <td></td>
    </tr>
</table>
