<script>
import datatable from './datatable.vue';

export default {
  name: "datatable_custom.vue",
  mixins: [
    datatable
  ],

  mounted: function () {
    this.customization();
  },

  methods: {
    customization: function () {
      let items = [];
      Object.entries(this.values).forEach(([key, value]) => {
        const object = {};
        this.columns.forEach((value2) => {

          if (value[value2.field] !== 'undefined') {
            if (value2['type'] && value2['type'] === 'percentage') {
              object[value2.field] = this.percentage(value[value2.field], value2.color);
            } else if (value2['type'] && value2['type'] === 'color') {
              object[value2.field] = this.colorArea(value[value2.field]);
            } else if (value2['type'] && value2['type'] === 'bg-color') {
              object[value2.field] = this.colorArea(value['color'], value[value2.field]);
            } else if (value2['type'] && value2['type'] === 'value_in_area_with_color') {
              object[value2.field] = this.colorArea(value2.color, value[value2.field]);
            } else {
              object[value2.field] = value[value2.field];
            }
          }
        });
        items.push(object);
      })

      this.list = items;
    },
    percentage: function (value, color) {
      return `${value} <br/><div class="progress"><div class="progress-bar " style="width: ${value}%;background-color: ${color}" role="progressbar" aria-valuenow="${value}" aria-valuemin="0" aria-valuemax="100"></div></div>`;
    },
    colorArea: function (color, value = '') {
      return `<div class="p-3 mb-2 " style="background-color: ${color}">${value}</div>`;
    }
  }
}
</script>
