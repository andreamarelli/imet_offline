<template>
  <div class="module-container" :id="name">
    <div class="module-header">
      <div class="module-title" @click="toggle_view()">
                      <span class="fas fa-fw carrot"
                            :class="{'fa-caret-up': !data.show_view,'fa-caret-down':data.show_view}"></span> {{ title }}
      </div>
    </div>
    <div class="module-body bg-white collapse" :class="{show: data.show_view}">
      <slot :props="data">
      </slot>
    </div>
  </div>
</template>

<script>


export default {
  name: "container_section",
  inject:['stores','config'],
  provide:{
    state:
        {
          image_src: '',
          comment: null
        }
  },
  props: {
    name: {
      type: String,
      default: ''
    },
    title: {
      type: String,
      default: ''
    }
  },
  data: function () {
    return {
      data: {
        values: {},
        show_view: false,
        loaded_once: false,
        config: this.config,
        stores: this.stores
      }
    }
  },
  methods: {

    toggle_view: async function () {
      this.data.show_view = !this.data.show_view;
    },
    is_visible: function (values) {
      return Object.keys(values).length;
    }
  }
}
</script>

<style scoped>

</style>
