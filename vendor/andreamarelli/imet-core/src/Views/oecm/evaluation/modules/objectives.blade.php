<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */

// Predefined and loaded from C1.2: force "fixed_rows" and "Element" type as disabled
$predefined = $definitions['predefined_values']['values'];


?>

@include('modular-forms::module.edit.type.table', compact(['collection', 'vue_data', 'definitions']))


@push('scripts')
    <script>
        // ## Initialize Module controller ##
        let module_{{ $definitions['module_key'] }} = new window.ModularForms.ModuleController({
            el: '#module_{{ $definitions['module_key'] }}',
            data: @json($vue_data),
            mounted(){
                let _this = this;

                let predefined = @json($predefined);

                this.$el.querySelectorAll('tr.module-table-item').forEach(function(el, index) {
                    let input = el.firstElementChild.querySelector('#simple-textarea');
                    if(predefined.includes(_this.records[index]['Objective'])){
                        input.setAttribute('contenteditable', false);
                        input.classList.add('disabled');
                    }
                })
            }
        });
    </script>
@endpush
