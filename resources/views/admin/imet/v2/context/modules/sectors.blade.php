<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */
/** @var String $group_key (optional - only for GROUP_TABLE) */

$group_key = isset($group_key) ? $group_key : '';

$table_id = $definitions['module_type'] === 'GROUP_TABLE'
    ? 'group_table_' . $definitions['module_key'] . '_' . $group_key
    : 'table_' . $definitions['module_key'];

$tr_record = $definitions['module_type'] === 'GROUP_TABLE'
    ? 'records[\'' . $group_key . '\']'
    : 'records'

?>

<table id="{{ $table_id }}" class="table module-table">

    {{-- labels  --}}
    <thead>
        <tr>
            @foreach($definitions['fields'] as $index=>$field)
                @if($field['type']!=='hidden')
                    <th class="text-center">{{ isset($field['label']) ? ucfirst($field['label']) : '' }}</th>
                @endif
                @if($index==1)
                    <th class="text-center">@lang('form/imet/v2/context.Sectors.area_percentage')</th>
                @endif
                @if($index==3)
                    <th class="text-center">@lang('form/imet/v2/context.Sectors.average_time')</th>
                @endif
            @endforeach

            <th></th>
        </tr>
    </thead>

    {{-- inputs --}}
    <tbody class="{{ $group_key }}">
        <tr class="module-table-item" v-for="(item, index) in {{ $tr_record }}">
            {{--  fields  --}}
            @foreach($definitions['fields'] as $index=>$field)
                <td>
                    @include('admin.components.module.edit.field.auto_vue', [
                        'definitions' => $definitions,
                        'field' => $field,
                        'vue_record_index' => 'index',
                        'group_key' => $group_key
                    ])
                </td>
                @if($index==1)
                    <td>
                        <input type="text" disabled="disabled"
                               class="input-number field-edit text-right"
                               v-bind:value="area_percentage[index]"
                        />
                    </td>
                @endif
                @if($index==3)
                    <td>
                        <input type="text" disabled="disabled"
                               class="input-number field-edit text-right"
                               v-bind:value="average_time[index]"
                        />
                    </td>
                @endif
            @endforeach
            <td>
                {{-- record id  --}}
                @include('admin.components.module.edit.field.vue', [
                    'type' => 'hidden',
                    'v_value' => 'item.'.$definitions['primary_key']
                ])
                @if(!$definitions['fixed_rows'])
                    <span v-if="typeof item.__predefined === 'undefined'">
                        @include('admin.components.buttons.delete_item')
                    </span>
                @endif
            </td>
        </tr>

        <tr>
            <td></td>
            <td>
                <div :class="isValidArea ? '' : 'has-error'">
                    <input type="text" disabled="disabled"
                       class="input-number field-edit text-right"
                       v-bind:value="sumUnderControlArea"
                    />
                </div>
            </td>
            <td></td>
            <td>
                <input type="text" disabled="disabled"
                       class="input-number field-edit text-right"
                       v-bind:value="UnderControlPatrolKm"
                />
            </td>
            <td>
                <input type="text" disabled="disabled"
                       class="input-number field-edit text-right"
                       v-bind:value="UnderControlPatrolManDay"
                />
            </td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td></td>
            <td colspan="6">
                <div v-if="!isValidArea" class="text-danger text-left" style="font-size: 0.9em;">
                    <i class="fa fa-exclamation-triangle"></i>
                    {!!  ucfirst(trans('form/imet/v2/context.Sectors.sum_error')) !!}
                </div>
            </td>
        </tr>

    </tbody>

    @if(!$definitions['fixed_rows'])
        <tfoot v-if="max_rows==null || records.length < max_rows">
            {{-- add button --}}
            <tr>
                <td colspan="{{ count($definitions['fields']) + 1 }}">
                    @include('admin.components.buttons.add_item')
                </td>
            </tr>
        </tfoot>
    @endif

</table>


@include('admin.components.module.edit.type.commons', compact(['collection', 'vue_data', 'definitions']))

@push('scripts')
    <script>
        // ## Initialize Module controller ##
        let module_{{ $definitions['module_key'] }} = new ModuleController({
            el: '#module_{{ $definitions['module_key'] }}',
            data: JSON.parse('{!! App\Library\Utils\Type\JSON::toVue($vue_data) !!}'),

            computed: {

                area_percentage(){
                    let _this = this;
                    let result = [];
                    let area = this.getPaArea();
                    _this.records.forEach(function (item, index) {
                        let underControlArea = item['UnderControlArea'];
                        if(_this.isValid(area) && _this.isValid(underControlArea) && underControlArea>0){
                            result[index] = (parseFloat(underControlArea) / parseFloat(area) * 100).toFixed(2);
                        } else {
                            result[index] = null;
                        }
                    });
                    return result;
                },

                average_time(){
                    let result = [];
                    let _this = this;
                    let area = this.getPaArea();
                    _this.records.forEach(function (item, index) {
                        let UnderControlPatrolManDay = item['UnderControlPatrolManDay'];
                        if(_this.isValid(area) && _this.isValid(UnderControlPatrolManDay) && UnderControlPatrolManDay>0){
                            result[index] = (parseFloat(UnderControlPatrolManDay) / parseFloat(area)).toFixed(2);
                        } else {
                            result[index] = null;
                        }
                    });
                    return result;
                },

                sumUnderControlArea (){
                    return this.sumColumnFloat('UnderControlArea');
                },
                UnderControlPatrolKm(){
                    return this.sumColumnFloat('UnderControlPatrolKm');
                },
                UnderControlPatrolManDay(){
                    return this.sumColumnFloat('UnderControlPatrolManDay');
                },
                isValidArea: function () {
                    return this.sumUnderControlArea===null
                        || this.sumUnderControlArea===''
                        || isNaN(this.sumUnderControlArea)
                        || (this.sumUnderControlArea>0
                            && parseFloat(this.sumUnderControlArea).toFixed(2)===parseFloat(this.getPaArea()).toFixed(2));
                }

            },

            methods: {

                getPaArea(){
                    let area =  module_imet__v2__context__areas.getArea();
                    if(area!==null){
                        area = parseFloat(area.toString().replace(',', '.'));
                    }
                    return area;
                },

                isValid: function (n) {
                    return !isNaN(parseFloat(n))
                        && isFinite(n)
                        && n!==null;
                }
            }

        });
    </script>
@endpush
