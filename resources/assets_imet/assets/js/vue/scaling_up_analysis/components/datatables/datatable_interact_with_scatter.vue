<script>

import datatable_interact_with_radar from "./datatable_interact_with_radar";

export default {
  name: "datatable_interact_with_scatter",
  mixins: [datatable_interact_with_radar],

  data: function () {
    return {
      data: []
    }
  },
  mounted() {
    this.$root.$on(`scatter_data_${this.event_key}`, (params) => {
      this.parse_data(params.selected);
    });
    this.parse_data();
  },
  methods: {
    parse_data: function (selected = null) {
      const values = Object.entries({...this.values});
      const data = [];

      values.forEach((value, idx) => {
        if (selected === null || (selected !== null && selected[value[1].name])) {
          data.push({
            name: value[1]['name'],
            context: value[1]['value'][0],
            planning: value[1]['value'][1],
            inputs: value[1]['value'][2]
          });
        }
      });
      this.data = data;
    }
  }

}
</script>

<style scoped>

</style>