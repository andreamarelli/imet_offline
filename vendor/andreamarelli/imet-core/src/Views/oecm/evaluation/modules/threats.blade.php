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
                __get_index(element_id){
                    return element_id.replace(this.module_key, '').replace('Value', '').replaceAll('_', '');
                },
                threats_elements(element_id){
                    let index =  this.__get_index(element_id);
                    let num_stakeholders = this.records[index]['__num_stakeholders_by_elements'];
                    let label = '';
                    if(num_stakeholders!==null){
                        label = '<ul style="padding-inline-start: 10px;">';
                        for (const [key, num] of Object.entries(num_stakeholders)) {
                            label += '<li><i>' + key + '</i>: '
                                + Locale.getLabel('imet-core::oecm_evaluation.Threats.stakeholders', {'num': '<b>' + num + '</b>'}) + '</li>';
                        };
                        label += '</ul>';
                    }
                    return label;
                }
            }

        });
    </script>
@endpush
