<?php

use Illuminate\Database\Eloquent\Collection;
use \Illuminate\Support\Facades\View;
use \Wa72\HtmlPageDom\HtmlPageCrawler;

/** @var Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */

$original_definitions = $definitions;

// First group: nothing to change
$definitions['groups'] = array_slice($original_definitions['groups'], 0, 1);
$first_group = View::make('modular-forms::module.edit.type.group_table', compact(['collection', 'vue_data', 'definitions']))->render();

// Second groups: hidden importance rows
$definitions['groups'] = array_slice($original_definitions['groups'], 1);
$definitions['fields'][1]['type'] = 'hidden';
$second_group = View::make('modular-forms::module.edit.type.group_table', compact(['collection', 'vue_data', 'definitions']))->render();

$dom = HtmlPageCrawler::create('<div>'.$first_group.$second_group.'</div>');

?>

{!! $dom->saveHTML() !!}


@push('scripts')
    <script>
        // ## Initialize Module controller ##
        let module_{{ $definitions['module_key'] }} = new window.ModularForms.ModuleController({
            el: '#module_{{ $definitions['module_key'] }}',
            data: @json($vue_data),

            methods: {
                __get_indexes(element_id) {
                    let indexes = element_id.replace(this.module_key, '').replace('Aspect', '')
                    indexes = indexes.replace(/^_/, '').replace(/_$/, '');
                    indexes = indexes.split('_');
                    return indexes;
                },
                __get_index(element_id) {
                    return element_id.replace(this.module_key, '').replace('Aspect', '').replaceAll('_', '');
                },
                group_label(element_id) {
                    let [group_key, index] = this.__get_indexes(element_id);
                    if (this.records[group_key][index]['__group_stakeholders'] !== null) {
                        return Locale.getLabel('imet-core::oecm_evaluation.KeyElements.from_group')
                            + ': <b>' + this.records[group_key][index]['__group_stakeholders'] + '</b>';
                    }
                    return '';
                },
                percentage_stakeholder_label(element_id) {
                    let [group_key, index] = this.__get_indexes(element_id);
                    if (group_key==='group0'){
                        let num_dir = this.records[group_key][index]['__num_stakeholders_direct'];
                        let num_ind = this.records[group_key][index]['__num_stakeholders_indirect'];
                        if(num_dir !== null || num_ind){
                            num_dir = num_dir !== null ? parseInt(num_dir) : 0;
                            num_ind = num_ind !== null ? parseInt(num_ind) : 0;
                            return Locale.getLabel('imet-core::oecm_evaluation.KeyElements.num_stakeholders', {
                                'num_dir': '<b>' + num_dir + '</b>',
                                'num_ind': '<b>' + num_ind + '</b>',
                            })
                        }
                    } else if(group_key==='group1'){
                        let score = this.records[group_key][index]['__score'];
                        if(score!==null && score!==''){
                            return '<b>' + Locale.getLabel('imet-core::oecm_evaluation.KeyElements.ranking') + '</b>: ' + String(score);
                        }

                    }
                    return '';
                }
            }

        });
    </script>
@endpush
