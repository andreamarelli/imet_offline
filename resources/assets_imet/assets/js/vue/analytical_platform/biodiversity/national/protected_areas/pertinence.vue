<template>

    <div>
        <div class="list-key-numbers">
            <div v-for="(item, index) in pertinence_regional">
                <data_driven_layer_toggle
                        v-if="regional"
                        :method=method_name(index)
                        title="index"
                        :api_data=api_data.per_country[index]
                ></data_driven_layer_toggle>
                <div class="content">
                    <span>{{ index }}</span>
                </div>
                <gauge :percentage=item />
            </div>
        </div>
    </div>

</template>


<script>
    import base from '../../../components/_base.mixin';

    export default {

        mixins: [base],

        computed: {
            pertinence_regional: function () {
                return this.regional
                    ? this.api_data.total
                    : this.api_data;
            },
        },
        methods:{
            method_name: function(label){
                if (label.includes('animales')){
                    return 'pertinence_animals';
                }
                else if (label.includes('végétales')){
                    return 'pertinence_vegetations';
                }
                else if (label.includes('habitats')){
                    return 'pertinence_habitats';
                }
                else if (label.includes('écosystèmes')){
                    return 'pertinence_ecosystems';
                }
            }
        },


    }
</script>