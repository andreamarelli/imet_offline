<template>
  <div>
    <radar_multiple_values :width=1128 :height=500
                :single="single"
                :unselect_legends_on_load="unselect_legends_on_load"
                :show_legends="show_legends"
                :values='values'
                :indicators='indicators'></radar_multiple_values>
  </div>
</template>

<script>
import container from './container';
import Radar_multiple_values from "./../various_charts/radar_multiple_values";


export default {
  components: {Radar_multiple_values},
  props: {
    width: {
      type: Number,
      default: 180
    },
    height: {
      type: Number,
      default: 180
    },
    indicators: {
      type: Array,
      default: () => {
      }
    },
    show_legends: {
      type: Boolean,
      default: false
    },
    single: {
      type: Boolean,
      default: true
    },
    showOnlyScaling: {
      type: Boolean,
      default: false
    },
    unselect_legends_on_load: {
      type: Boolean,
      default: false
    }
  },
  mixins: [
    container//,
   // resize
  ],
  data: function () {
    return {
      values: {}
    }
  },
  methods: {
    success: function (response) {
      this.values = response.diagrams;
    }
  }
}
</script>
