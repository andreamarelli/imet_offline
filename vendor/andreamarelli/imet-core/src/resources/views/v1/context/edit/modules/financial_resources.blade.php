<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vueData */

$vue_record_index = '0';

$vueData['area'] = \AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context\Areas::getArea($vueData['form_id']);

?>


@component('modular-forms::module.components.field_container', [
               'name' => $definitions['fields'][0]['name'],
               'label' => $definitions['fields'][0]['label'] ?? '',
               'label_width' => $definitions['label_width']
           ])

    {{-- input field --}}
    @include('modular-forms::module.edit.field.module-to-vue', [
        'definitions' => $definitions,
        'field' => $definitions['fields'][0],
        'vue_record_index' => $vue_record_index
    ])

@endcomponent


@component('modular-forms::module.components.field_container', [
               'name' => $definitions['fields'][1]['name'],
               'label' => $definitions['fields'][1]['label'] ?? '',
               'label_width' => $definitions['label_width']
           ])

    {{-- input field --}}
    @include('modular-forms::module.edit.field.module-to-vue', [
        'definitions' => $definitions,
        'field' => $definitions['fields'][1],
        'vue_record_index' => $vue_record_index
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
            <label for="{{  $definitions['fields'][2]['name'] }}">{!! ucfirst($definitions['fields'][2]['label']) !!}</label>
        </td>
        <td>
            @include('modular-forms::module.edit.field.module-to-vue', [
                'definitions' => $definitions,
                'field' => $definitions['fields'][2],
                'vue_record_index' => $vue_record_index
            ])
        </td>
        <td><input type="text" disabled="disabled" v-bind:value="functioning_costs_1" class="field-edit field-numeric text-right"/></td>
        <td></td>
        <td></td>
    </tr>

    <tr>
        <td>
            <label for="{{  $definitions['fields'][3]['name'] }}">{!! ucfirst($definitions['fields'][3]['label']) !!}</label>
        </td>
        <td>
            @include('modular-forms::module.edit.field.module-to-vue', [
                'definitions' => $definitions,
                'field' => $definitions['fields'][3],
                'vue_record_index' => $vue_record_index
            ])
        </td>
        <td><input type="text" disabled="disabled" v-bind:value="functioning_costs_2" class="field-edit field-numeric text-right"/></td>
        <td><input type="text" disabled="disabled" v-bind:value="estimation_financial_plan_2" class="field-edit field-numeric text-right"/></td>
        <td></td>
    </tr>

    <tr>
        <td>
            <label for="{{  $definitions['fields'][4]['name'] }}">{!! ucfirst($definitions['fields'][4]['label']) !!}</label>
        </td>
        <td>
            @include('modular-forms::module.edit.field.module-to-vue', [
                'definitions' => $definitions,
                'field' => $definitions['fields'][4],
                'vue_record_index' => $vue_record_index
            ])
        </td>
        <td><input type="text" disabled="disabled" v-bind:value="functioning_costs_3" class="field-edit field-numeric text-right"/></td>
        <td><input type="text" disabled="disabled" v-bind:value="estimation_financial_plan_3" class="field-edit field-numeric text-right"/></td>
        <td><input type="text" disabled="disabled" v-bind:value="estimation_operational_plan_3" class="field-edit field-numeric text-right"/></td>
        <td></td>
    </tr>

</table>

@push('scripts')
    <script type="module">
        window.imet__v1__context__financial_resources = (new window.ImetCore.Apps.Modules.ImetV1.context.FinancialResources(@json($vueData)))
            .mount('#module_{{ $definitions['module_key'] }}');
    </script>
@endpush
