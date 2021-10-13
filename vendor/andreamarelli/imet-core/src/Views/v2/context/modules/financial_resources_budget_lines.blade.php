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

$area = \AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context\Areas::getArea($vue_data['form_id']);

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
            @lang_u('imet-core::v2_context.FinancialResourcesBudgetLines.fields.function_costs')
        </th>
        <th class="text-center">
            @lang_u('imet-core::v2_context.FinancialResourcesBudgetLines.fields.percentage')
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
            <div :class="!totalIsValid ? 'form-group has-error' : 'form-group'">
                <input type="text" disabled="disabled"
                       class="input-number field-edit text-center"
                       v-bind:value="sumBudget"
                />
            </div>
        </td>
        <td colspan="4">
            <div v-if="!totalIsValid" class="text-danger text-left" style="font-size: 0.9em;">
                <i class="fa fa-exclamation-triangle"></i>
                {!!  ucfirst(trans('imet-core::v2_context.FinancialResourcesBudgetLines.sum_error')) !!}
            </div>
        </td>
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
                    let area = this.get_area();
                    this.records.forEach(function (item, index) {
                        result[index] = 0;
                        if(area!==null && area>0){
                            result[index] = item['Amount'] / area * 100;
                        }
                        result[index] = result[index]===0 ? null : result[index].toFixed(2);
                    });
                    return result;
                },
                percentages() {
                    let _this = this;
                    let result = [];
                    let totalBudget = this.get_total_budget();
                    this.records.forEach(function (item, index) {
                        result[index] = '';
                        if(item['Amount']>0 && totalBudget>0){
                            result[index] = (item['Amount']/totalBudget*100).toFixed(1) + ' %';
                        }
                    });
                    return result;
                },

                sumBudget (){
                    return this.sumColumnFloat('Amount');
                },

                totalIsValid(){
                    return this.sumBudget===null
                        || this.sumBudget===''
                        || isNaN(this.sumBudget)
                        || (this.sumBudget>0
                            && parseFloat(this.sumBudget).toFixed(2)===parseFloat(this.get_total_budget()).toFixed(2));
                }

            },

            methods: {

                get_area() {
                    return {{ $area }};
                },

                get_total_budget(){
                    return module_imet__v2__context__financial_resources.records[0]['TotalBudget'];
                },

            }

        });
    </script>
@endpush
