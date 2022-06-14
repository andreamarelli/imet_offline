<template>
    <div>
        <v-swatches v-model="color"
                    show-fallback
                    fallback-input-type="color"
            popover-x="left"
            shapes="circles"
       />
        <input type="hidden" slot="trigger" :value="getColor()" :name="`color-${text_box_name}`" :id="`color-${text_box_name}`" class="field-edit" readonly>
    </div>
</template>

<script>
import VSwatches from 'vue-swatches'

import "vue-swatches/dist/vue-swatches.css"

export default {
    name: "color_picker",
    components: {VSwatches},
    props: {
        text_box_name: {
            type: Number,
            default: () => {
            }
        },
        default_color: {
            type: String,
            default: () => '#59c7f9'
        },
    },
    data() {
        return {
            color: '',
        }
    },
    mounted() {
        this.color = this.default_color
    },
    methods: {
        getColor() {
            return this.color;
        }
    }
}
</script>
