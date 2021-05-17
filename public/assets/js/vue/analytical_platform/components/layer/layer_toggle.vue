<template>

    <div class="toggle">

        <button v-if="as_button"
            @mouseenter="showTooltip"
            @mouseleave="hideTooltip"
            @click=toggle
            class="btn-nav small"
            :class="{active: checked}"
        >
            <i class="fas fa-toggle-off" v-if=!checked></i>
            <i class="fas fa-toggle-on" v-else-if=checked></i>
            Sur la carte
        </button>

        <!-- layer toggle -->
        <div v-else-if="!as_button" class="switch_checkbox"
             :class="{sm: small}"
             @mouseenter="showTooltip"
             @mouseleave="hideTooltip"
        >
            <input type="checkbox"
                   :id=switch_id
                   :checked=checked
                   @click=toggle
            />
            <label :for=switch_id></label>
        </div>

        <!-- tooltip -->
        <div class="toggle__tooltip" v-if=show_tooltip>

            <layer_card
                :layer=layer
                :with_info_toggle=false
            ></layer_card>

        </div>

    </div>

</template>

<style lang="scss" scoped>

.toggle{

    button{
        white-space: nowrap;
    }

    .toggle__tooltip{
        display: none;
        position: fixed;
    }

    // style
    .toggle__tooltip{
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.7);
        padding: 8px;
        background-color: white;
        border-radius: 3px;
        min-width: 200px;
        max-width: 250px;
        z-index: 1;

        // triangle
        &:before{
            content: '';
            display: block;
            width: 0;
            height: 0;
            position: absolute;
            border-top: 8px solid transparent;
            border-bottom: 8px solid transparent;
            border-right: 8px solid white;
            left: -8px;
            top: calc(50% - 8px);
        }

    }

}
</style>

<script>
export default {

    props: {
        layer: {
            type: Object,
            default: () => {}
        },
        as_button:{
            type: Boolean,
            default: false
        },
        small: {
            type: Boolean,
            default: false
        },
        show_tooltip: {
            type: Boolean,
            default: true
        },
        data_driven_layer:{
            type: Boolean,
            default: false
        },
        exclusive_layer:{
            type: Boolean,
            default: false
        }
    },

    data: function (){
        return {
            switch_id: null,
            checked: null,
            tooltip: null
        }
    },

    mounted() {
        let _this = this;
        this.switch_id = 'layer_toggle_' + this._uid + '_';

        this.checked = this.$root.layerIsOnMap(this.layer.id);

        window.vueBus.$on('toggle_layer', function (layer_id, on_map) {
            if(layer_id === _this.layer.id){
                _this.checked = on_map;
            }
        });

        if(this.show_tooltip){
            this.tooltip = this.$el.querySelector('.toggle__tooltip');
        }
    },

    methods: {

        toggle(){
            this.checked = !this.checked;
            this.layer.data_driven = this.data_driven_layer;
            this.layer.exclusive = this.exclusive_layer;
            this.$root.toggleLayer(this.layer);
        },

        showTooltip(evt){
            if(this.show_tooltip) {
                // show tooltip
                this.tooltip.style.display = 'block';
                // set tooltip position
                let toggle_position = evt.target.getBoundingClientRect()
                let tooltip_height = this.tooltip.offsetHeight;
                this.tooltip.style.top = (toggle_position.top + toggle_position.height/2 - tooltip_height/2) + 'px';
                this.tooltip.style.left = (toggle_position.left + toggle_position.width + 13) + 'px';
            }
        },

        hideTooltip(){
            if(this.show_tooltip) {
                this.tooltip.style.display = 'none';
            }
        },

    }

}
</script>
