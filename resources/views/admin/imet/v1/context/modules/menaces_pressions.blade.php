<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */

$view_groupTable = View::make('admin.components.module.edit.type.group_table', compact(['collection', 'vue_data', 'definitions']))->render();

function injectStatsInGroup($view, $group)
{
    $allSpaces = '[\s\t\n\r]*';
    preg_match("/\<th\>\<\/th\>(".$allSpaces."\<\/tr\>".$allSpaces."\<\/thead\>".$allSpaces."\<tbody\sclass\=\"".$group."[\s\"])/m", $view, $matched);
    $textToAdd = '<th>
                      <input type="text" disabled="disabled" v-model="group_stats.'.$group.'" class="field-disabled input-number field-edit text-center"/>
                  </th>';
    return str_replace($matched[0], $textToAdd.$matched[0], $view);
}

function injectStatsInRow($view, $group)
{
    $searchFor = '<input type="hidden" v-model="records[\''.$group.'\'][index]';
    $textToAdd = '<input type="text" disabled="disabled" v-model="row_stats[\''.$group.'\'][index]" class="field-disabled input-number field-edit text-center"/>';
    return str_replace($searchFor, $textToAdd.$searchFor, $view);
}

function injectCategoryTitle($view, $module_key, $beforeGroup, $category_index, $title)
{
    $searchFor = '<h5 class="green group_title_'.$module_key.'_'.$beforeGroup.'">';
    $textToAdd = '
        <div class="module-row">
            <div style="width: 90%;">
                <h3>'.($category_index+1).'. '.$title.'</h3>
            </div>
            <div class="module-row__input">
                <input type="text" disabled="disabled" v-model="category_stats[\''.$category_index.'\']" class="field-disabled input-number field-edit text-center" style="font-style: bold; margin-top: 20px;"/>
            </div>
        </div>';
    return str_replace($searchFor, $textToAdd.$searchFor, $view);
}


// Inject titles (with category stats)
foreach(\App\Models\Imet\v1\Modules\Context\MenacesPressions::$groupByCategory as $i => $category){
    $group = $category[0];
    $category_index = $i+1;
    $view_groupTable = injectCategoryTitle($view_groupTable, $definitions['module_key'], $group, $i, trans('form/imet/v1/context.MenacesPressions.categories.title'.$category_index));
}

// inject row and group stats


foreach(\App\Models\Imet\v1\Modules\Context\MenacesPressions::$groupByCategory as $i => $category){
    foreach ($category as $group){
        $view_groupTable = injectStatsInRow($view_groupTable, $group);
        $view_groupTable = injectStatsInGroup($view_groupTable, $group);
    }
}

$vue_data['groupByCategory'] = $definitions['groupByCategory'];


?>

{!! $view_groupTable !!}
@include('admin.components.module.edit.type.commons', compact(['collection', 'vue_data', 'definitions']))


@push('scripts')
    <script>
        // ## Initialize Module controller ##cont
        let module_{{ $definitions['module_key'] }} = new ModuleController({
            el: '#module_{{ $definitions['module_key'] }}',
            data: JSON.parse('{!! App\Library\Utils\Type\JSON::toVue($vue_data) !!}'),

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