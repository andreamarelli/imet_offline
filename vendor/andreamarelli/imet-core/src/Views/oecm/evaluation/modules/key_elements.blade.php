<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */


?>

@include('modular-forms::module.edit.body', compact(['collection', 'vue_data', 'definitions']))

@push('scripts')
    <script>
        // ## Initialize Module controller ##
        let module_{{ $definitions['module_key'] }} = new window.ModularForms.ModuleController({
            el: '#module_{{ $definitions['module_key'] }}',
            data: @json($vue_data),

            methods:{
                __get_indexes(element_id){
                    let indexes = element_id.replace(this.module_key, '').replace('Aspect', '')
                    indexes = indexes.replace(/^_/, '').replace(/_$/, '');
                    indexes = indexes.split('_');
                    return indexes;
                },
                __get_index(element_id){
                    return element_id.replace(this.module_key, '').replace('Aspect', '').replaceAll('_', '');
                },
                group_label(element_id){
                    let [group_key, index] = this.__get_indexes(element_id);
                    if(this.records[group_key][index]['__group_stakeholders'] !== null){
                        return Locale.getLabel('imet-core::oecm_evaluation.KeyElements.from_group')
                            + ': <b>' + this.records[group_key][index]['__group_stakeholders'] + '</b>';
                    }
                    return '';
                },
                percentage_stakeholder_label(element_id){
                    let [group_key, index]  = this.__get_indexes(element_id);
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
                    return '';
                }
            }

        });
    </script>
@endpush
