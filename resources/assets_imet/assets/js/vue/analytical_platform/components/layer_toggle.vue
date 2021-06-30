<template>

    <div class="switch_checkbox">
        <input type="checkbox"
               :id=layer_key
               :name=group_key
               :data-layer=layer_key
               :checked=checked
               @click=toggle
        />
        <label :for=layer_key>x</label>
    </div>

</template>


<script>
export default {

    props: {
        layer_key: {
            type: String,
            default: null
        },
        group_key: {
            type: String,
            default: null
        },
        layer_id: {
            type: String,
            default: null
        },
    },

    data: function (){
        return {
            checked: null
        }
    },

    mounted() {
        let _this = this;
        this.checked = this.$root.layerIsOnMap(this.layer_id);

        window.vueBus.$on('toggle_layer', function (layer_id, on_map) {
            if(layer_id === _this.layer_id){
                _this.checked = on_map;
            }
        });
    },

    methods: {

        toggle(){
            this.$root.toggleLayer(this.layer_id, this.group_key);
            window.vueBus.$emit('toggle_layer',
                this.layer_id,
                this.$root.layerIsOnMap(this.layer_id)
            );
        }

    }

}
</script>