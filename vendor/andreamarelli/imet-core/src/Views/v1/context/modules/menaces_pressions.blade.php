<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context\MenacesPressions;
use Illuminate\Support\Facades\View;

$view_groupTable = View::make('modular-forms::module.edit.type.group_table', compact(['collection', 'vue_data', 'definitions']))->render();


// Inject titles (with category stats)
foreach(MenacesPressions::$groupByCategory as $i => $category){
    $searchFor = '<h5 class="highlight group_title_'.$definitions['module_key'].'_'.$category[0].'">';
    $textToAdd = '
        <div class="module-row">
            <div style="width: 90%;">
                <h3>'.($i+1).'. '.trans('imet-core::v1_context.MenacesPressions.categories.title'.($i+1)).'</h3>
            </div>
            <div class="module-row__input">
                <input type="text" disabled="disabled" v-model="category_stats[\''.$i.'\']"
                    class="field-disabled input-number field-edit text-center" style="font-style: bold; margin-top: 20px;"/>
            </div>
        </div>';
    $view_groupTable = str_replace($searchFor, $textToAdd.$searchFor, $view_groupTable);
}

// inject row and group stats
foreach(MenacesPressions::$groupByCategory as $i => $category){
    foreach ($category as $group){

        $searchFor = '<input type="hidden" v-model="records[\''.$group.'\'][index]';
        $textToAdd = '<input type="text" disabled="disabled" v-model="row_stats[\''.$group.'\'][index]" class="field-disabled input-number field-edit text-center"/>';
        $view_groupTable = str_replace($searchFor, $textToAdd.$searchFor, $view_groupTable);

        $allSpaces = '[\s\t\n\r]*';
        preg_match("/\<th\>\<\/th\>(".$allSpaces."\<\/tr\>".$allSpaces."\<\/thead\>".$allSpaces."\<tbody\sclass\=\"".$group."[\s\"])/m", $view_groupTable, $matched);
        $textToAdd = '<th>
                          <input type="text" disabled="disabled" v-model="group_stats.'.$group.'"
                                class="field-disabled input-number field-edit text-center"/>
                      </th>';
        $view_groupTable = str_replace($matched[0], $textToAdd.$matched[0], $view_groupTable);
    }
}

$vue_data['groupByCategory'] = $definitions['groupByCategory'];

?>

{!! $view_groupTable !!}
@include('modular-forms::module.edit.type.commons', compact(['collection', 'vue_data', 'definitions']))


@push('scripts')
    <script>
        // ## Initialize Module controller ##cont
        let module_{{ $definitions['module_key'] }} = new window.ModularForms.ModuleController({
            el: '#module_{{ $definitions['module_key'] }}',
            data: @json($vue_data),

            computed: {

                row_stats(){
                    let _this = this;
                    let stats = [];
                    let fields = ['Impact', 'Extension', 'Duration', 'Trend', 'Probability'];

                    Object.keys(_this.records).forEach(function(group){
                        stats[group] = [];
                        _this.records[group].forEach(function(record){

                            // calculate stats for each row
                            let valuesByRecord = [];
                            fields.forEach(function (field){
                                valuesByRecord.push(record[field]);
                            });
                            stats[group].push(_this.calculate_stats(valuesByRecord, true));
                        });
                    });

                    return stats;
                },

                group_stats(){
                    let _this = this;
                    let stats = [];

                    // calculate stats for each group
                    Object.keys(_this.records).forEach(function(group){
                        stats[group] = _this.calculate_stats(_this.row_stats[group]);
                    });

                    return stats;
                },

                category_stats(){
                    let _this = this;
                    let stats = [];
                    let valuesByCategory = [];

                    // organized groups by category
                    _this.groupByCategory.forEach(function (groups, category_index){
                        valuesByCategory[category_index] = [];
                        groups.forEach(function(group){
                            valuesByCategory[category_index].push(_this.group_stats[group]);
                        });
                    });

                    // calculate stats for each category
                    valuesByCategory.forEach(function (category){
                        stats.push(_this.calculate_stats(category));
                    });

                    return stats;
                }

            },

            methods: {

                calculate_stats: function(values, rows=false){

                    let numCategories = 4;
                    let prod = 1;
                    let count = 0;

                    values.forEach(function(value, index){
                        if(value!==null){
                            if(index===3 && rows===true){
                                prod *= (numCategories+1)/2 - parseFloat(value)*(numCategories-1)/4;
                            } else {
                                prod *= numCategories - parseFloat(value);
                            }

                            count++;
                        }
                    });

                    return count>0 ? (4 - Math.pow(prod, 1/(count))).toFixed(2) : null;
                }
            }

        });
    </script>
@endpush
