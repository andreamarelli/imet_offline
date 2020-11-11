<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */

$group_key = $group_key ?? '';

$table_id = $definitions['module_type']==='GROUP_TABLE'
    ? 'group_table_'.$definitions['module_key'].'_'.$group_key
    : 'table_'.$definitions['module_key'];

$tr_record = $definitions['module_type']==='GROUP_TABLE'
    ? 'records[\''.$group_key.'\']'
    : 'records'

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
            {{ ucfirst(trans('form/imet/v1/context.FinancialAvailableResources.fields.total')) }}
        </th>
        <th class="text-center">
            {{ ucfirst(trans('form/imet/v1/context.FinancialAvailableResources.fields.percentage')) }}
        </th>
    </tr>
    </thead>

    {{-- inputs --}}
    <tbody>
    <tr class="module-table-item" v-for="(item, index) in {{ $tr_record }}">
        {{--  fields  --}}
        @foreach($definitions['fields'] as $field)
            <td>
                @include('admin.components.module.edit.field.auto_vue', [
                    'definitions' => $definitions,
                    'field' => $field,
                    'vue_record_index' => 'index',
                    'group_key' => $group_key
                ])
            </td>
        @endforeach
        <td>
            <input type="numeric" disabled="disabled"
                   class="input-number field-edit text-right"
                   v-bind:value="totals[index]"
                   v-bind:id="'{{$definitions['module_key'] }}_'+index+'_total'"
            />        </td>
        <td>
            <input type="text" disabled="disabled" style="width: 80px;"
                   class="input-number field-edit text-center"
                   v-bind:value="percentages[index]"
                   v-bind:id="'{{$definitions['module_key'] }}_'+index+'_percentage'"
            />
        </td>
        <td>
            {{-- record id  --}}
            @include('admin.components.module.edit.field.vue', [
                'type' => 'hidden',
                'v_value' => 'item.'.$definitions['primary_key']
            ])
            <span v-if="typeof item.__predefined === 'undefined'">
                @include('admin.components.buttons.delete_item')
            </span>
        </td>
    <tr>
    </tbody>

    <tfoot>
    {{-- add button --}}
    <tr>
        <td colspan="{{ count($definitions['fields']) + 1 }}">
            @include('admin.components.buttons.add_item')
        </td>
    </tr>
    </tfoot>

</table>


@include('admin.components.module.edit.type.commons', compact(['collection', 'vue_data', 'definitions']))

@push('scripts')
    <script>
        // ## Initialize Module controller ##
        let module_{{ $definitions['module_key'] }} = new ModuleController({
            el: '#module_{{ $definitions['module_key'] }}',
            data: JSON.parse('{!! App\Library\Utils\Type\JSON::toVue($vue_data) !!}'),

            computed: {

                totals() {
                    let result = [];
                    this.records.forEach(function (item, index) {
                        result[index] = 0;
                        result[index] += item['NationalBudget'] !== null ? parseFloat(item['NationalBudget']) : 0;
                        result[index] += item['OwnRevenues'] !== null ? parseFloat(item['OwnRevenues']) : 0;
                        result[index] += item['Disputes'] !== null ? parseFloat(item['Disputes']) : 0;
                        result[index] += item['Partners'] !== null ? parseFloat(item['Partners']) : 0;
                        result[index] = result[index]===0 ? null : result[index];
                    });
                    return result;
                },
                percentages(){
                    let _this = this;
                    let result = [];
                    let totalPlannedBudget = parseFloat(module_imet__v1__context__financial_resources.records[0]['TotalBudget']);
                    this.records.forEach(function (item, index) {
                        let total =  parseFloat(_this.totals[index]);
                        if(total>0){
                            result[index] = (total/totalPlannedBudget*100).toFixed(1) + ' %';
                        }
                    });
                    return result;
                }

            }
        });
    </script>
@endpush
