<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */


?>

@include('admin.components.module.edit.type.simple', compact(['collection', 'vue_data', 'definitions']))


@push('scripts')
    <script>
        // ## Initialize Module controller ##
        let module_{{ $definitions['module_key'] }} = new ModuleController({
            el: '#module_{{ $definitions['module_key'] }}',
            data: @json($vue_data),

            methods: {

                recordChangedCallback(){
                    if(this.records[0]['Year']
                        && this.records[0]['language']
                        && this.records[0]['name']
                        && this.records[0]['designation']
                        && this.records[0]['designation_type']
                        && this.records[0]['status']
                        && this.records[0]['country']
                    ){
                        this.status = 'changed';
                    } else {
                        this.status = 'init';
                    }

                },
            }

        });
    </script>
@endpush


