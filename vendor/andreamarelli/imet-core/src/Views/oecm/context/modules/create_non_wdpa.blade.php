<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */


?>

@include('modular-forms::module.edit.type.simple', compact(['collection', 'vue_data', 'definitions']))


@push('scripts')
    <script>
        // ## Initialize Module controller ##
        let module_{{ $definitions['module_key'] }} = new window.ModularForms.ModuleController({
            el: '#module_{{ $definitions['module_key'] }}',
            data: @json($vue_data),

            methods: {

                recordChangedCallback(){

                    let empty = [];
                    for (const [key, value] of Object.entries(this.records[0])) {
                        if(value === null || value === ''){
                            empty.push(key);
                        }
                    }

                    console.log(empty);

                    if(empty.includes('version') &&
                        empty.includes('FormID') &&
                        empty.includes('UpdateDate') &&
                        empty.includes('UpdateBy')){

                        if(empty.length === 4 ||
                            (empty.length === 5 &&  empty.includes('rep_m_area')) ||
                            (empty.length === 5 &&  empty.includes('rep_area'))
                        ){
                            this.status = 'changed';
                        } else {
                            this.status = 'init';
                        }
                    }

                    else {
                        this.status = 'init';
                    }

                },
            }

        });
    </script>
@endpush


