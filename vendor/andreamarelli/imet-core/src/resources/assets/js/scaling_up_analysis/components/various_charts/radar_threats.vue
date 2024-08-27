<template>
    <div class="imet_radar" :style="'width:100%; min-height: ' + height +'px;'"></div>
</template>

<script>
import imet_radar from "./radar_multiple_values.vue";
export default {
    name: "radar_threats",
    mixins: [
        imet_radar
    ],
    data: function () {
        return {
            default_colors: ['#5470c6', '#91cc75', '#fac858', '#ee6666', '#73c0de', '#3ba272', '#fc8452', '#9a60b4', '#ea7ccc'],
            legend_selected: [],
            start_angle: 60
        }
    },
    methods: {
        setIndicators: function () {
            if (!this.indicators?.length) {
                return [];
            }
            return this.indicators.map((value, key) => {
                return {text: value.replace(' ', '\n'), max: 0, min: -100};
            });
        },
    }
}

</script>
