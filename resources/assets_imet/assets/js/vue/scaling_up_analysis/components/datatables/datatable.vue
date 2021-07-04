<template>
  <table id="global_scores">
    <tr>
      <th v-for="column in columns" @click="sort(column.field)">
        {{ column.label }} <i :class="sort_icon(column.field)"/>
      </th>
    </tr>
    <tr v-for="(value, index) in items">
      <td v-for="column in columns" v-html="value[column.field]"></td>
    </tr>
  </table>
</template>

<script>

import filter from './../../../mixins/filter.mixin';
import sorter from './../../../mixins/sorter.mixin';
import paginate from './../../../mixins/paginate.mixin';

export default {
  name: "datatable.vue",
  mixins: [
    filter,
    sorter,
    paginate
  ],
  props: {
    columns: {
      type: Array,
      default: () => {
      }
    },
    values: {
      type: Array | Object,
      default: () => {
      }
    }
  },
  data: function () {
    const Locale = window.Locale;
    return {
      Locale: Locale,
      list: [],
      pageSize: 100,
      dataSend: []
    }
  },
  computed: {
    items() {
      let items = this.list;

      items = this.filterList(items);     // from filter mixin
      items = this.sortList(items);       // from sorter mixin
      items = this.paginateList(items);   // from paginate mixin
      return items;
    }
  },
  methods: {
    sort_icon: function (selectedItem = '') {
      if (this.sortBy === selectedItem && this.sortDir === 'asc') {
        return 'fa fa-arrow-up';
      }

      if (this.sortBy === selectedItem && ['desc', null].includes(this.sortDir)) {
        return 'fa fa-arrow-down';
      }

      return '';
    },
    __sorter: function (data) {
      let _this = this;
      return data.sort(function (a, b) {
        let dir = _this.sortDir === 'asc' ? 1 : -1;
        let text_a = _this.__getAttribute(a, _this.sortBy);
        let text_b = _this.__getAttribute(b, _this.sortBy);
        if (typeof text_a !== "undefined" && typeof text_b !== "undefined") {
          if(typeof text_a === 'string') {
            if (text_a.toString().toLowerCase() > text_b.toString().toLowerCase()) {
              return dir;
            }
            if (text_a.toString().toLowerCase() < text_b.toString().toLowerCase()) {
              return -1 * dir;
            }
          }
          else {
            if (text_a > text_b) {
              return dir;
            }
            if (text_a < text_b) {
              return -1 * dir;
            }
          }
        }
        return 0;
      });
    }
  }
}
</script>
