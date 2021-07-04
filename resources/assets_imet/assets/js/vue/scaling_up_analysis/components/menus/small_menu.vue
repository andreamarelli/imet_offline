<template>
  <div  class="smallMenu" style="min-height: 50px;">
    <div class="standalone js-smallMenu" id="smallMenu" v-if="list_names.length > 1">
      <div :class="is_selected(idx)" v-for="(item, idx) in list_names" v-html="item" @click="scroll_to_section(idx)">
      </div>
    </div>

  </div>
</template>

<script>
export default {
  name: "small_menu",
  props: {
    items: {
      type: [Object, Array],
      default: () => {
        return {};
      }
    },
    exclude: {
      type: String,
      default: ''
    },
    ids: {
      type: String,
      default: ''
    }
  },
  data: function () {
    return {
      list_names: [],
      excluded_items: [],
      selection: null
    }
  },
  mounted() {

    this.list_items();
  },
  methods: {
    list_items: function () {
      this.exclude_items();
      const object_entries = Object.entries(this.items);
      if (object_entries.length > 0) {
        object_entries.forEach((item, index) => {
          if (!this.excluded_items.includes(item[0])) {
            this.list_names.unshift(item[0])
          }
        })
      }
    },
    exclude_items: function () {
      this.excluded_items = this.exclude.split(',');
    },
    scroll_to_section: function (idx) {
      const element = document.getElementById(this.ids + idx);
      element.scrollIntoView({behavior: "smooth"});
      this.selection = idx;
    },
    is_selected: function (index) {
      return this.selection === index ? 'active' : '';
    }
  }
}
</script>
