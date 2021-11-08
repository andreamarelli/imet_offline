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
    : 'records';

$area = \AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context\Areas::getArea($vue_data['form_id']);

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
            @lang_u('imet-core::v1_context.FinancialResourcesBudgetLines.fields.function_costs')
        </th>
        <th class="text-center">
            @lang_u('imet-core::v1_context.FinancialResourcesBudgetLines.fields.percentage')
        </th>
    </tr>
    </thead>

    {{-- inputs --}}
    <tbody>
    <tr class="module-table-item" v-for="(item, index) in {{ $tr_record }}">
        {{--  fields  --}}
        @foreach($definitions['fields'] as $field)
            <td>
                @include('modular-forms::module.edit.field.module-to-vue', [
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
                   v-bind:value="costs[index]"
                   v-bind:id="'{{$definitions['module_key'] }}_'+index+'_total'"
            />        </td>
        <td>
            <input type="text" disabled="disabled" style="width: 80px;"
                   class="field-edit text-center"
                   v-bind:value="percentages[index]"
                   v-bind:id="'{{$definitions['module_key'] }}_'+index+'_percentage'"
            />
        </td>
        <td>
            {{-- record id  --}}
            @include('modular-forms::module.edit.field.vue', [
                'type' => 'hidden',
                'v_value' => 'item.'.$definitions['primary_key']
            ])
            <span v-if="typeof item.__predefined === 'undefined'">
                @include('modular-forms::buttons.delete_item')
            </span>
        </td>
    <tr class="module-table-item">
        <td></td>
        <td>
            <input type="text" disabled="disabled"
                   class="input-number field-edit text-center"
                   v-bind:value="sumBudget"
            />
        </td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    </tbody>

    <tfoot>
    {{-- add button --}}
    <tr>
        <td colspan="{{ count($definitions['fields']) + 1 }}">
            @include('modular-forms::buttons.add_item')
        </td>
    </tr>
    </tfoot>

</table>


@include('modular-forms::module.edit.type.commons', compact(['collection', 'vue_data', 'definitions']))

@push('scripts')
    <script>
        // ## Initialize Module controller ##
        let module_{{ $definitions['module_key'] }} = new window.ModularForms.ModuleController({
            el: '#module_{{ $definitions['module_key'] }}',
            data: @json($vue_data),

            computed: {

                costs() {
                    let result = [];
                    this.records.forEach(function (item, index) {
                        let area = {{ $area }};
                        result[index] = 0;
                        if(area!==null){
                            result[index] = item['Amount'] / area * 100;
                        }
                        result[index] = result[index]===0 ? null : result[index].toFixed(2);
                    });
                    return result;
                },
                percentages() {
                    let _this = this;
                    let result = [];
                    let totalBudget = module_imet__v1__context__financial_available_resources.totals.reduce(
                        (accumulator, currentValue) => accumulator + currentValue
                    );
                    this.records.forEach(function (item, index) {
                        let cost =  parseFloat(_this.costs[index]);
                        if(cost>0){
                            result[index] = (cost/totalBudget*100).toFixed(1) + ' %';
                        }
                    });
                    return result;
                },

                sumBudget (){
                    return this.sumColumnFloat('Amount');
                },

            }
        });
    </script>
@endpush
