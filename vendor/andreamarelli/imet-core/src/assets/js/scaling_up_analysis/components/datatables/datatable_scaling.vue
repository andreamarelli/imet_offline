<template>
  <div>
    <div class="row mb-3 mt-1" style="font-size: 12px" v-if="average.length">
      <div class="col-sm align-self-center">
        {{ stores.BaseStore.localization("imet-core::analysis_report.average_explained") }}
      </div>
    </div>
    <table id="global_scores">
      <tr>
        <th v-for="(column, idx) in columns" @click="sort(column.field)"
            :style="idx === 0 ? 'width:15%;' : 'width:11%;'">
        {{ column.label.charAt(0).toUpperCase() + column.label.slice(1) }} <i :class="sort_icon(column.field)"/>
        </th>
      </tr>
      <tr v-for="(value, index) in items">
        <td v-for="(column, idx) in columns" v-html="value[column.field]"
            :class="idx === 0 ?'': score_class(value[column.field])"></td>
      </tr>
      <tr v-if="average.length > 0">
        <td v-for="(column, idx) in columns" v-html="itemLabel(average[0][column.field])"
            :class="idx === 0 ?'': score_class(average[0][column.field])"></td>
      </tr>
    </table>
    <div class="row" style="font-size: 12px">
      <div class="col-sm text-right">
        {{ stores.BaseStore.localization("imet-core::analysis_report.scaling_legend") }} :
      </div>
      <div class="col-sm">
        <div class="row">
          <div class="col text-center" :class="score_class(0)">0</div>
          <div class="col text-center" :class="score_class(10)">1-33</div>
          <div class="col text-center" :class="score_class(34)">34-50</div>
          <div class="col text-center" :class="score_class(51)">51-100</div>
        </div>
      </div>
      <div class="col-sm align-self-center"></div>
    </div>

  </div>
</template>

<script>


import datatable_custom from './datatable_custom.vue';

export default {
  name: "datatable_scaling.vue",
  inject: ['stores'],
  mixins: [
    datatable_custom
  ],
  data: function () {
    const Locale = window.Locale;
    return {
      Locale: Locale,
      list: [],
      pageSize: 100,
      average: []
    }
  },
  computed: {
    items() {
      let items = this.list;
      if (this.average.length === 0 && items.length > 0) {
        this.average = items.filter(item => {
          return item.name === "Average";
        })

        const averageIndex = items.findIndex((item) => {
          return item.name === "Average";
        });

        if (averageIndex > -1) {
          items.splice(averageIndex, 1);
        }
      }

      items = this.filterList(items);     // from filter mixin
      items = this.sortList(items);       // from sorter mixin
      items = this.paginateList(items);   // from paginate mixin
      return items;
    }
  },
  mounted() {
    this.list.sort((a, b) => {
      return a.name.localeCompare(b.name)
    })
  },
  methods: {
    itemLabel: function (value) {
      if (value === 'Average') {
        value = "* " + value;
      }

      return value;
    },
    score_class: function (value, additional_classes = '') {
      let addClass = '';
      if (value === 0) {
        addClass = 'score_danger';
      } else if (value < 34) {
        addClass = 'score_alert';
      } else if (value < 51) {
        addClass = 'score_warning';
      } else {
        addClass = 'score_success';
      }
      return `${addClass} ${additional_classes}`;
    },
    score_class_threats: function (value, $additional_classes = '') {
      let addClass = '';
      if (value < -51) {
        addClass = 'score_danger';
      } else if (value < -34) {
        addClass = 'score_alert';
      } else if (value < -1) {
        addClass = 'score_warning';
      } else {
        addClass = 'score_success';
      }
      return `${addClass} ${$additional_classes}`;
    }
  }
}
</script>
