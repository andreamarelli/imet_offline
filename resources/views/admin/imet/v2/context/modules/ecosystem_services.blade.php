<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */


$view_groupTable = $view = View::make('admin.components.module.edit.type.group_table', compact(['collection', 'vue_data', 'definitions']))->render();

function injectTitleAndHistogram($title, $category_index){
    return '
        <div class="module-row">
            <div style="width: 60%;">
                <h3>'.$title.'</h3>
            </div>
            <div class="module-row__input">
                <div class="row progress_bar" style="margin-top: 25px">
                    <div class="col-lg-1 progress_bar_limits">-100%</div>
                    <div class="col-lg-10 progress_bar_container">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-negative"
                                 role="progressbar"
                                 :style="{ width: Math.abs(category_stats[\''.$category_index.'\']) + \'%\', backgroundColor: \'#87c89b\'}">
                                <span v-if="category_stats[\''.$category_index.'\']!==null">{{ category_stats[\''.$category_index.'\'] }} %</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1 progress_bar_limits">0%</div>
                </div>
            </div>
        </div>';
}


use \Wa72\HtmlPageDom\HtmlPageCrawler;

$dom = HtmlPageCrawler::create('<div>'.$view.'</div>');
$dom->filter('h5.group_title_'.$definitions['module_key'].'_group0')
    ->before(injectTitleAndHistogram(trans('form/imet/v2/context.EcosystemServices.categories.title1'), '0'));
$dom->filter('h5.group_title_'.$definitions['module_key'].'_group3')
    ->before(injectTitleAndHistogram(trans('form/imet/v2/context.EcosystemServices.categories.title2'), '1'));
$dom->filter('h5.group_title_'.$definitions['module_key'].'_group5')
    ->before(injectTitleAndHistogram(trans('form/imet/v2/context.EcosystemServices.categories.title3'), '2'));
$dom->filter('h5.group_title_'.$definitions['module_key'].'_group9')
    ->before(injectTitleAndHistogram(trans('form/imet/v2/context.EcosystemServices.categories.title4'), '3'));

?>
{!! $dom->saveHTML() !!}
@include('admin.components.module.edit.type.commons', compact(['collection', 'vue_data', 'definitions']))

@push('scripts')
    <script>
        // ## Initialize Module controller ##cont
        let module_{{ $definitions['module_key'] }} = new ModuleController({
            el: '#module_{{ $definitions['module_key'] }}',
            data: JSON.parse('{!! App\Library\Utils\Type\JSON::toVue($vue_data) !!}'),

            computed: {

                category_stats(){
                    let _this = this;
                    let category_stats = [];

                    _this.groupByCategory.forEach(function (groups, category_index){

                        let category_sum = 0;
                        let category_count = 0;
                        Object.keys(_this.records).forEach(function(group){
                            if(groups.includes(group)){
                                _this.records[group].forEach(function(record){
                                    let row_stats =_this.row_stats(record);
                                    if(row_stats!==null){
                                        category_sum += parseFloat(row_stats);
                                        category_count++;
                                    }
                                });
                            }
                        });
                        category_stats[category_index] = category_sum>0 ? ((category_sum/category_count)*100/3.0).toFixed(2) : null;
                    });
                    return category_stats;
                }

            },

            methods: {

                row_stats(record){
                    let stat = null;
                    if(record['Importance']!==null && record['ImportanceRegional']!==null && record['ImportanceGlobal']!==null){
                        stat = parseFloat(record['Importance'])
                            + (parseFloat(record['ImportanceRegional'])/3)
                            + ((2-parseFloat(record['ImportanceGlobal']))/4);
                    }
                    return stat;
                }
            }

        });
    </script>
@endpush
