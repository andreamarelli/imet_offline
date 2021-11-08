<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */

$vue_record_index = '0';

$area = \AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context\Areas::getArea($vue_data['form_id']);

?>


<table id="table_imet__context__control_level" class="table module-table">
    <tr>
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
            <input type="text" disabled="disabled" v-bind:value="area_percentage" class="input-number field-edit text-right"/>
        </td>
        <td rowspan="3">
            @include('modular-forms::module.edit.field.module-to-vue', [
               'definitions' => $definitions,
               'field' => $definitions['fields'][1],
               'vue_record_index' => $vue_record_index
            ])
        </td>
        <td>
            <input type="text" disabled="disabled" v-bind:value="average_time" class="input-number field-edit text-right"/>
        </td>
    </tr>
    <tr>
        <td><label for="{{  $definitions['fields'][2]['name'] }}">{!! ucfirst($definitions['fields'][2]['label']) !!}</label></td>
        <th>@lang('imet-core::v1_context.ControlLevel.area_percentage_conversion')</th>
        <th>@lang('imet-core::v1_context.ControlLevel.average_time_controlled')</th>
    </tr>
    <tr>
        <td>
            @include('modular-forms::module.edit.field.module-to-vue', [
               'definitions' => $definitions,
               'field' => $definitions['fields'][2],
               'vue_record_index' => $vue_record_index
            ])
        </td>
        <td><input type="text" disabled="disabled" v-bind:value="area_percentage_conversion" class="input-number field-edit text-right"/></td>
        <td><input type="text" disabled="disabled" v-bind:value="average_time_controlled" class="input-number field-edit text-right"/></td>
    </tr>
    <tr>
        <td><label for="{{  $definitions['fields'][3]['name'] }}">{!! ucfirst($definitions['fields'][3]['label']) !!}</label></td>
        <td>
            @include('modular-forms::module.edit.field.module-to-vue', [
               'definitions' => $definitions,
               'field' => $definitions['fields'][3],
               'vue_record_index' => $vue_record_index
            ])
        </td>
        <td><input type="text" disabled="disabled" v-bind:value="ecologicalMonitoringPatrolKm_percentage" class="input-number field-edit text-right"/></td>
        <td colspan="2"></td>
    </tr>
</table>

@component('modular-forms::module.field_container', [
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


@component('modular-forms::module.field_container', [
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
    <script>
        // ## Initialize Module controller ##
        let module_{{ $definitions['module_key'] }} = new window.ModularForms.ModuleController({
            el: '#module_{{ $definitions['module_key'] }}',
            data: @json($vue_data),

            props: {
                area: {
                    type: Number,
                    default: {{ $area }}
                },
            },

            computed: {

                area_percentage (){
                    let result = null;
                    let value = this.records[0]['UnderControlArea'];
                    let value2 = this.area;
                    if(this.isValid(this.area) && this.isValid(value) && value>0){
                        result = parseFloat(value) / parseFloat(value2) * 100;
                        result = result.toFixed(2);
                    }
                    return result;
                },
                average_time (){
                    let result = null;
                    let value = this.records[0]['UnderControlPatrolManDay'];
                    let value2 = this.area;
                    if(this.isValid(this.area) && this.isValid(value) && value>0){
                        result = parseFloat(value) / parseFloat(value2);
                        result = result.toFixed(2);
                    }
                    return result;
                },
                area_percentage_conversion (){
                    let result = null;
                    let value = this.records[0]['UnderControlPatrolKm'];
                    let value2 = this.area;
                    if(this.isValid(this.area) && this.isValid(value) && value>0){
                        result = parseFloat(value) / parseFloat(value2) * 10;
                        result = result.toFixed(2);
                    }
                    return result;
                },
                average_time_controlled (){
                    let result = null;
                    let value = this.records[0]['UnderControlPatrolKm'];
                    let value2 = this.records[0]['UnderControlArea'];
                    if(this.isValid(this.area) && this.isValid(value) && value>0){
                        result = parseFloat(value) / parseFloat(value2);
                        result = result.toFixed(2);
                    }
                    return result;
                    //UnderControlPatrolManDay/UnderControlArea
                },
                ecologicalMonitoringPatrolKm_percentage(){
                    let result = null;
                    let value = this.records[0]['EcologicalMonitoringPatrolKm'];
                    let value2 = this.area;
                    if(this.isValid(this.area) && this.isValid(value) && value>0){
                        result = parseFloat(value) / parseFloat(value2) * 10;
                        result = result.toFixed(2);
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
