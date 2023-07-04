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

                    let num_stakeholders = this.records[index]['__num_stakeholders'];
                    let elements = this.records[index]['__elements'];
                    let elements_illegal = this.records[index]['__elements_illegal'];

                    let label = '';
                    if(num_stakeholders!==null){
                        label =
                            Locale.getLabel('imet-core::oecm_evaluation.Threats.stakeholders', {'num': '<b>' + num_stakeholders + '</b>'})
                            + '<br />'
                            + 'Listed elements: <ul>';
                        let list = '';

                        for (const [_, elem] of Object.entries(elements_illegal)) {
                            if(elem.length>0){
                                list += '<b style="color: red;">' + elem.join(', ') + '</b>';
                            }
                        }
                        for (const [_, elem] of Object.entries(elements)) {
                            if(elem.length>0){
                                if (list !== ''){
                                    list += ', ';
                                }
                                list += elem.join(', ');
                            }
                        }
                        if (list !== ''){
                            label += '<li>' + list + '</li>';
                        }
                        label += '</ul>';
                    }
                    return label;
                }
            }

        });
    </script>
@endpush
