<template>
  <div v-if="data.length">
    <datatable_scaling :columns="columns" :values="data" :key="data.length">
    </datatable_scaling>
  </div>
</template>

<script>

import datatable_scaling from "./datatable_scaling";

export default {
  name: "datatable_interact_with_radar",
  components: {datatable_scaling},
  props: {
    values: {
      type: [Array, Object],
      default: () => {
      }
    },
    columns: {
      type: Array,
      default: () => {
      }
    },
    event_key: {
      type: String,
      default: ''
    }
  },
  data: function () {
    return {
      data: []
    }
  },
  mounted() {
    this.$root.$on(`radar_data_${this.event_key}`, (params) => {
      this.parse_data(params.selected);
    });
    this.parse_data();
  },
  methods: {
    parse_data: function (selected = null) {
      const values = Object.entries({...this.values});
      const data = [];

      values.forEach((value, idx) => {
        if ((selected !== null && selected[value[0]]) || (selected === null && value[1]['legend_selected'])) {
          data.push({
            name: value[0],
            context: value[1][0] || value[1]['context'],
            planning: value[1][5] || value[1]['planning'],
            inputs: value[1][4] || value[1]['inputs'],
            process: value[1][3] || value[1]['process'],
            outputs: value[1][2] || value[1]['outputs'],
            outcomes: value[1][1] || value[1]['outcomes'],
            color: value[1]['color']
          })
        }
      });
      this.data = data;
    }
  }

}
</script>

<style scoped>

</style>