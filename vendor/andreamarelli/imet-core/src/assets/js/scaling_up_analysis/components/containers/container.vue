<template>
  <div>
    <div v-if="show_loader" class="spinner-border text-success" role="status">
      <span class="sr-only">Loading...</span>
    </div>
    <div v-else>
      <div v-if="error_returned" class="dopa_not_available"
           v-html="stores.BaseStore.localization('entities.dopa_not_available')"></div>
      <div v-else-if="timeout" class="dopa_not_available"
           v-html="stores.BaseStore.localization('entities.dopa_not_available')"></div>
      <div v-else-if="error_wrong" class="dopa_not_available"
           v-html="stores.BaseStore.localization('imet-core::analysis_report.error_wrong')"></div>
      <div v-else class="container-menu">
        <!--        <small_menu v-if="show_menu" :items="data.values.diagrams"></small_menu>-->
        <slot :props="data"></slot>
      </div>
    </div>
  </div>
</template>

<script>

import small_menu from './../menus/small_menu.vue';


export default {
  name: "container.vue",
  inject: ['stores'],
  mixins: [
      window.ImetCore.ScalingUp.Mixins.ajax
  ],
  components: {
      small_menu
  },
  props: {
    element: {
      type: String,
      default: ''
    },
    on_load: {
      type: Boolean,
      default: true
    },
    load_container: {
      type: Boolean,
      default: true
    },
    on_load_even: {
      type: String,
      default: null
    },
    show_menu: {
      type: Boolean,
      default: false
    }
  },
  data: function () {
    return {
      data: {
        values: {},
        show_view: false,
        loaded_once: false
      }
    }
  },

  methods: {
    success: function (response) {
      if (response.status === false) {
        this.timeout = true;
        return;
      }
      if (typeof response === 'object') {
        this.data.values = response.data;
        if (this.on_load_even !== null) {
          this.$root.$emit('component_loaded');
        }
      } else {
        this.error_returned = true;
      }
    },
    toggle_view: async function () {
      this.data.show_view = !this.data.show_view;
    }
  }
}
</script>
