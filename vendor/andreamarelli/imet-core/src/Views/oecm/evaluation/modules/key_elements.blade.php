<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */

//$vue_data['locale'] = 'window.Locale';

?>

@include('modular-forms::module.edit.body', compact(['collection', 'vue_data', 'definitions']))

@push('scripts')
    <script>
        // ## Initialize Module controller ##
        let module_{{ $definitions['module_key'] }} = new window.ModularForms.ModuleController({
            el: '#module_{{ $definitions['module_key'] }}',
            data: @json($vue_data),

            methods:{
                percentage_stakeholder_label(element_id){
                    let index = element_id.replace(this.module_key, '').replace('Aspect', '').replaceAll('_', '');
                    let percentage = this.records[index]['__percentage_stakeholders'];
                    percentage = parseFloat(percentage).toFixed(2);
                    return Locale.getLabel('imet-core::oecm_evaluation.KeyElements.percentage_stakeholders', {'percentage': percentage})
                }
            }

        });
    </script>
@endpush
