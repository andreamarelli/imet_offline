<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */

use \Illuminate\Support\Facades\View;
use \Wa72\HtmlPageDom\HtmlPageCrawler;

$original_view = View::make('modular-forms::module.edit.body', compact(['collection', 'vue_data', 'definitions']))->render();

$dom = HtmlPageCrawler::create('<div>'.$original_view.'</div>');
$dom->filter('h5.group_title_'.$definitions['module_key'].'_group0')->before('<h3 style="margin-bottom: 20px;">'.trans('imet-core::oecm_context.Stakeholders.titles.title0').'</h3>');
$dom->filter('h5.group_title_'.$definitions['module_key'].'_group5')->before('<h3 style="margin-bottom: 20px;">'.trans('imet-core::oecm_context.Stakeholders.titles.title1').'</h3>');
$dom->filter('h5.group_title_'.$definitions['module_key'].'_group7')->before('<h3 style="margin-bottom: 20px;">'.trans('imet-core::oecm_context.Stakeholders.titles.title2').'</h3>');
$dom->filter('h5.group_title_'.$definitions['module_key'].'_group9')->before('<h3 style="margin-bottom: 20px;">'.trans('imet-core::oecm_context.Stakeholders.titles.title3').'</h3>');

?>

{!! $dom->saveHTML() !!}

@push('scripts')
    <script>
        // ## Initialize Module controller ##
        let module_{{ $definitions['module_key'] }} = new window.ModularForms.ModuleController({
            el: '#module_{{ $definitions['module_key'] }}',
            data: @json($vue_data),
            methods:{

                empty_record_with_predefined(group_key) {
                    let empty_record = this.__no_reactive_copy(this.empty_record);
                    if(group_key==='group5'
                        || group_key==='group6'){
                        empty_record['Engagement'] = 'market_economy';
                    } else if(group_key==='group7'
                        || group_key==='group8'
                        || group_key==='group9'
                        || group_key==='group10'
                        || group_key==='group11'){
                        empty_record['GeographicalProximity'] = true;
                    }

                    return empty_record;
                },

                __arrange_records_by_group: function () {
                    let _this = this;
                    let records_by_group = {};
                    Object.keys(_this.groups).forEach(function (key) {
                        records_by_group[key] = [];
                    });
                    _this.records.forEach(function (item) {
                        if (item[_this.group_key_field] !== null) {
                            let group_key = item[_this.group_key_field];
                            if(group_key in records_by_group){
                                records_by_group[group_key].push(item);
                            }
                        }
                    });
                    Object.keys(records_by_group).forEach(function (key) {
                        if (records_by_group[key].length === 0) {
                            let empty_record = _this.empty_record_with_predefined(key);
                            records_by_group[key].push(empty_record);
                            records_by_group[key][0][_this.group_key_field] = key;
                        }
                    });
                    _this.records = records_by_group;
                },

                /**
                 * Add new item (row) at TABLE or ACCORDION module
                 */
                addItem: function () {
                    let table = $(event.currentTarget).parents('table');
                    let key = $(table).attr('id').replace('group_table_' + this.module_key + '_', '');
                    let empty_record = this.empty_record_with_predefined(key);

                    if (key === null) {
                        this.records.push(this.__no_reactive_copy(empty_record));
                    } else {
                        this.records[key].push(this.__no_reactive_copy(empty_record));
                        this.records[key][this.records[key].length - 1][this.group_key_field] = key;
                    }
                },

            }

        });
    </script>
@endpush