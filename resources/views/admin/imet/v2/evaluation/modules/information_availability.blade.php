<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */

?>

@include('admin.components.module.edit.body', compact(['collection', 'vue_data', 'definitions']))

@push('scripts')
<script>
    // ## Initialize Module controller ##
    let module_{{ $definitions['module_key'] }} = new ModuleController({
        el: '#module_{{ $definitions['module_key'] }}',
        data: JSON.parse('{!! App\Library\Utils\Type\JSON::toVue($vue_data) !!}'),

        methods: {
            plain_name(fullName){
                return fullName!=null && this.isTaxonomy(fullName)
                    ? this.getScientificName(fullName)
                    : fullName;
            },

            tooltip(fullName){
                return fullName!=null && this.isTaxonomy(fullName)
                    ? fullName.replace(/\|/g, " ")
                    : '';
            },

            isTaxonomy(fullName){
                return (fullName.match(/\|/g) || []).length===5
            },

            getScientificName (fullName){
                let sciName = null;
                if(fullName!==null){
                    let taxonomy = fullName.split("|");
                    sciName =  taxonomy[4] + ' ' + taxonomy[5]
                }
                return sciName;
            },
        }

    });
</script>
@endpush