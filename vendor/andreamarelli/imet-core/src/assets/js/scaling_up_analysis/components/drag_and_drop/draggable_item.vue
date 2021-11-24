<template>
  <div
      :id="item.id"
      :class="'item_class'" class="default-zone-element"
      draggable
      @drop="onDrop($event, item)"
      @dragstart='start_drag($event, item)'
      @dragover='drag_over($event, item)'

  >
    <slot></slot>
    <i v-if="is_removable" class="fa fa-times"
       aria-hidden="true" @click='remove_item(item.id)'></i>
    <div class="w-50 mx-auto">{{ item.name }}</div>
  </div>
</template>

<script>
export default {
  name: "draggable_item",
  props: {
    item: {
      type: Object,
      default: () => {
        return {};
      }
    },
    is_removable: {
      type: Boolean,
      default: true
    },
    item_class: {
      type: String,
      default: 'default-zone-element'
    },
    remove_event:{
      type:String,
      default:'remove-element'
    }
  },
  mounted() {
  },
  data: function () {
    return {}
  },
  methods: {
    onDrop(evt, item) {
      this.$root.$emit('drop-item-area', evt, item);
    },
    drag_over: function (evt, item) {
      this.$root.$emit('drag-over', evt, item);
    },
    start_drag: function (evt, item) {
      this.$root.$emit('drag-element', evt, item);
    },
    drag_end: function (evt, item) {
      this.$root.$emit('drag-end', evt, item);
    },
    remove_item: function (item) {
      this.$root.$emit(this.remove_event, item);
    }
  }
}
</script>

<style scoped>
.default-zone-element {
  background-color: #fff;
  margin-bottom: 10px;
  padding: 5px;
  min-height: 100px;
}
</style>
