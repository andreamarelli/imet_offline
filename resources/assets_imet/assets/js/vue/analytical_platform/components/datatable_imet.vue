<template>
  <div class="row">
    <div id="table" class="col-xs-12 table-responsive">
      <datatable :columns="columns" :data="dataSend">
        <template slot-scope="{ row, columns, index }">
          <tr>
            <template v-for="value in row">
              <td><span v-html="value"></span>
              </td>
            </template>
          </tr>
        </template>

      </datatable>

    </div>
  </div>

</template>

<script>


export default {
  props: {
    rows: {
      type: [Array, Object],
      default: null
    },
    columns: {
      type: [Array, Object],
      default: null
    }
  },
  mounted() {

    Object.entries(this.rows).forEach(([key, value]) => {
      const object = {};

      this.columns.forEach((value2) => {
        if (value[value2.field] !== 'undefined') {
          if (value2['type'] && value2['type'] === 'percentage') {
            object[value2.field] = this.percentage(value[value2.field], value2.color);
          } else if (value2['type'] && value2['type'] === 'color') {
            object[value2.field] = this.colorArea(value[value2.field]);
          } else if (value2['type'] && value2['type'] === 'value_in_area_with_color') {
            object[value2.field] = this.colorArea(value2.color, value[value2.field]);
          } else {
            object[value2.field] = value[value2.field];
          }

        }
      });

      this.dataSend.push(object);
      // console.log({a:this.dataSend})
    })
    //console.log({a:this.dataSend})
  },
  data() {
    return {
      dataLength: Object.keys(this.columns).length,
      dataSend: [],
      page: 1,
      per_page: 10,
    }
  },
  methods: {
    log: function (e) {
      //console.log(e);
    },
    percentage: function (value, color) {
      return `${value} <br/><div class="progress"><div class="progress-bar " style="width: ${value}%;background-color: ${color}" role="progressbar" aria-valuenow="${value}" aria-valuemin="0" aria-valuemax="100"></div></div>`;
    },
    colorArea: function (color, value = '') {
      return `<div class="p-3 mb-2 " style="background-color: ${color}">${value}</div>`;
    }
  }
  ,
  created: function () {

  }
}
</script>