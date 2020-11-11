<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */

$vue_record_index = '0';

$area = \App\Models\Imet\v1\Modules\Context\Areas::getArea($vue_data['form_id']);

?>


@component('admin.components.module.components.row', [
               'name' => $definitions['fields'][0]['name'],
               'label' => $definitions['fields'][0]['label'] ?? '',
               'label_width' => $definitions['label_width']
           ])

    {{-- input field --}}
    @include('admin.components.module.edit.field.auto_vue', [
        'definitions' => $definitions,
        'field' => $definitions['fields'][0],
        'vue_record_index' => $vue_record_index
    ])

@endcomponent


@component('admin.components.module.components.row', [
               'name' => $definitions['fields'][1]['name'],
               'label' => $definitions['fields'][1]['label'] ?? '',
               'label_width' => $definitions['label_width']
           ])

    {{-- input field --}}
    @include('admin.components.module.edit.field.auto_vue', [
        'definitions' => $definitions,
        'field' => $definitions['fields'][1],
        'vue_record_index' => $vue_record_index
    ])

@endcomponent



<table id="{{ 'table_'.$definitions['module_key'] }}" class="table module-table">

    <tr>
        <td></td>
        <th class="text-center" style="width: 200px;">@lang('form/imet/v1/context.FinancialResources.amount')</th>
        <th class="text-center">@lang('form/imet/v1/context.FinancialResources.functioning_costs')</th>
        <th class="text-center">@lang('form/imet/v1/context.FinancialResources.estimation_financial_plan')</th>
        <th class="text-center">@lang('form/imet/v1/context.FinancialResources.estimation_operational_plan')</th>
    </tr>

    <tr>
        <td>
            <label for="{{  $definitions['fields'][2]['name'] }}">{!! ucfirst($definitions['fields'][2]['label']) !!}</label>
        </td>
        <td>
            @include('admin.components.module.edit.field.auto_vue', [
                'definitions' => $definitions,
                'field' => $definitions['fields'][2],
                'vue_record_index' => $vue_record_index
            ])
        </td>
        <td><input type="text" disabled="disabled" v-bind:value="functioning_costs_1" class="input-number field-edit text-right"/></td>
        <td></td>
        <td></td>
    </tr>

    <tr>
        <td>
            <label for="{{  $definitions['fields'][3]['name'] }}">{!! ucfirst($definitions['fields'][3]['label']) !!}</label>
        </td>
        <td>
            @include('admin.components.module.edit.field.auto_vue', [
                'definitions' => $definitions,
                'field' => $definitions['fields'][3],
                'vue_record_index' => $vue_record_index
            ])
        </td>
        <td><input type="text" disabled="disabled" v-bind:value="functioning_costs_2" class="input-number field-edit text-right"/></td>
        <td><input type="text" disabled="disabled" v-bind:value="estimation_financial_plan_2" class="input-number field-edit text-right"/></td>
        <td></td>
    </tr>

    <tr>
        <td>
            <label for="{{  $definitions['fields'][4]['name'] }}">{!! ucfirst($definitions['fields'][4]['label']) !!}</label>
        </td>
        <td>
            @include('admin.components.module.edit.field.auto_vue', [
                'definitions' => $definitions,
                'field' => $definitions['fields'][4],
                'vue_record_index' => $vue_record_index
            ])
        </td>
        <td><input type="text" disabled="disabled" v-bind:value="functioning_costs_3" class="input-number field-edit text-right"/></td>
        <td><input type="text" disabled="disabled" v-bind:value="estimation_financial_plan_3" class="input-number field-edit text-right"/></td>
        <td><input type="text" disabled="disabled" v-bind:value="estimation_operational_plan_3" class="input-number field-edit text-right"/></td>
        <td></td>
    </tr>

</table>

@push('scripts')
    <script>
        // ## Initialize Module controller ##
        let module_{{ $definitions['module_key'] }} = new ModuleController({
            el: '#module_{{ $definitions['module_key'] }}',
            data: JSON.parse('{!! App\Library\Utils\Type\JSON::toVue($vue_data) !!}'),

            props: {
                area: {
                    type: Number,
                    default: {{ $area }}
                },
            },

            computed: {

                functioning_costs_1 (){
                    let result = null;
                    let value = this.records[0]['ManagementFinancialPlanCosts'];
                    let value2 = this.area;
                    if(this.isValid(this.area) && this.isValid(value) && value>0){
                        result = parseFloat(value) / parseFloat(value2);
                        result = result.toFixed(2);
                    }
                    return result;
                },
                functioning_costs_2 (){
                    let result = null;
                    let value = this.records[0]['OperationalWorkPlanCosts'];
                    let value2 = this.area;
                    if(this.isValid(this.area) && this.isValid(value) && value>0){
                        result = parseFloat(value) / parseFloat(value2);
                        result = result.toFixed(2);
                    }
                    return result;
                },
                functioning_costs_3 (){
                    let result = null;
                    let value = this.records[0]['TotalBudget'];
                    let value2 = this.area;
                    if(this.isValid(this.area) && this.isValid(value) && value>0){
                        result = parseFloat(value) / parseFloat(value2);
                        result = result.toFixed(2);
                    }
                    return result;
                },
                estimation_financial_plan_2 (){
                    let result = null;
                    let value = this.records[0]['OperationalWorkPlanCosts'];
                    let value2 = this.records[0]['ManagementFinancialPlanCosts'];
                    if(this.isValid(this.area) && this.isValid(value) && value>0){
                        result = parseFloat(value) / parseFloat(value2) * 100;
                        result = result.toFixed(1);
                    }
                    return result;
                },
                estimation_financial_plan_3 (){
                    let result = null;
                    let value = this.records[0]['TotalBudget'];
                    let value2 = this.records[0]['ManagementFinancialPlanCosts'];
                    if(this.isValid(this.area) && this.isValid(value) && value>0){
                        result = parseFloat(value) / parseFloat(value2) * 100;
                        result = result.toFixed(1);
                    }
                    return result;
                },
                estimation_operational_plan_3 (){
                    let result = null;
                    let value = this.records[0]['TotalBudget'];
                    let value2 = this.records[0]['OperationalWorkPlanCosts'];
                    if(this.isValid(this.area) && this.isValid(value) && value>0){
                        result = parseFloat(value) / parseFloat(value2) * 100;
                        result = result.toFixed(1);
                    }
                    return result;
                },


            },

            methods: {
                isValid: function (n) {
                    return !isNaN(parseFloat(n)) && isFinite(n) && n!==null;
                }
            }

        });
    </script>
@endpush
