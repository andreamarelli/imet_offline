<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vueData */

$vue_record_index = '0';

$area = \AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context\Areas::getArea($vueData['form_id']);

?>


<table id="table_imet__context__control_level" class="table module-table">
    <tr class="border-b border-solid border-gray-300">
        <td></td>
        <th class="text-center" colspan="2">@lang('imet-core::v1_context.ControlLevel.area')</th>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <th rowspan="4" style="width: 400px;">@lang('imet-core::v1_context.ControlLevel.under_control_area')</th>
        <td class="text-center"><label for="{{  $definitions['fields'][0]['name'] }}">{!! ucfirst($definitions['fields'][0]['label']) !!}</label></td>
        <td class="text-center"><label for="area_percentage">@lang('imet-core::v1_context.ControlLevel.area_percentage')</label></td>
        <td class="text-center"><label for="{{  $definitions['fields'][1]['name'] }}">{!! ucfirst($definitions['fields'][1]['label']) !!}</label></td>
        <td class="text-center"><label for="average_time">@lang('imet-core::v1_context.ControlLevel.average_time')</label></td>
    </tr>
    <tr>
        <td>
            @include('modular-forms::module.edit.field.module-to-vue', [
               'definitions' => $definitions,
               'field' => $definitions['fields'][0],
               'vue_record_index' => $vue_record_index
           ])
        </td>
        <td>
            <input type="text" disabled="disabled" v-bind:value="area_percentage" class="field-edit field-numeric text-right"/>
        </td>
        <td rowspan="3">
            @include('modular-forms::module.edit.field.module-to-vue', [
               'definitions' => $definitions,
               'field' => $definitions['fields'][1],
               'vue_record_index' => $vue_record_index
            ])
        </td>
        <td>
            <input type="text" disabled="disabled" v-bind:value="average_time" class="field-edit field-numeric text-right"/>
        </td>
    </tr>
    <tr>
        <td><label for="{{  $definitions['fields'][2]['name'] }}">{!! ucfirst($definitions['fields'][2]['label']) !!}</label></td>
        <th>@lang('imet-core::v1_context.ControlLevel.area_percentage_conversion')</th>
        <th>@lang('imet-core::v1_context.ControlLevel.average_time_controlled')</th>
    </tr>
    <tr class="border-b border-solid border-gray-300">
        <td>
            @include('modular-forms::module.edit.field.module-to-vue', [
               'definitions' => $definitions,
               'field' => $definitions['fields'][2],
               'vue_record_index' => $vue_record_index
            ])
        </td>
        <td><input type="text" disabled="disabled" v-bind:value="area_percentage_conversion" class="field-edit field-numeric text-right"/></td>
        <td><input type="text" disabled="disabled" v-bind:value="average_time_controlled" class="field-edit field-numeric text-right"/></td>
    </tr>
    <tr class="border-b border-solid border-gray-300">
        <td><label for="{{  $definitions['fields'][3]['name'] }}">{!! ucfirst($definitions['fields'][3]['label']) !!}</label></td>
        <td>
            @include('modular-forms::module.edit.field.module-to-vue', [
               'definitions' => $definitions,
               'field' => $definitions['fields'][3],
               'vue_record_index' => $vue_record_index
            ])
        </td>
        <td><input type="text" disabled="disabled" v-bind:value="ecologicalMonitoringPatrolKm_percentage" class="field-edit field-numeric text-right"/></td>
        <td colspan="2"></td>
    </tr>
</table>

@component('modular-forms::module.components.field_container', [
               'name' => $definitions['fields'][4]['name'],
               'label' => $definitions['fields'][4]['label'] ?? '',
               'label_width' => $definitions['label_width']
           ])

    {{-- input field --}}
    @include('modular-forms::module.edit.field.module-to-vue', [
        'definitions' => $definitions,
        'field' => $definitions['fields'][4],
        'vue_record_index' => $vue_record_index
    ])

@endcomponent


@component('modular-forms::module.components.field_container', [
               'name' => $definitions['fields'][5]['name'],
               'label' => $definitions['fields'][5]['label'] ?? '',
               'label_width' => $definitions['label_width']
           ])

    {{-- input field --}}
    @include('modular-forms::module.edit.field.module-to-vue', [
        'definitions' => $definitions,
        'field' => $definitions['fields'][5],
        'vue_record_index' => $vue_record_index
    ])

@endcomponent

@push('scripts')
    <style>
        #table_imet__context__control_level td{
            border: none;
            padding: 10px;
            text-align: center;
        }
    </style>
    <script type="module">
        window.imet__v1__context__areas = (new window.ImetCore.Apps.Modules.ImetV1.context.ControlLevel(@json($vueData)))
            .mount('#module_{{ $definitions['module_key'] }}');
    </script>
@endpush
