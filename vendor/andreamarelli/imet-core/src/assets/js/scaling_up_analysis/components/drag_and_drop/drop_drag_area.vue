<template>
    <div :style="'background-color:'+ color" class="drop-zone d-grid gap-1 rounded"  @drop='onDrop($event)' @dragover.prevent
         @dragenter.prevent>
      <slot></slot>
    </div>
</template>

<script>
export default {
  name: "drop_drag_area",
  props: {
    drop_id: {
      type: Number,
      default: 0
    },
    visible:{
      type: Boolean,
      default: true
    },
    color:{
      type: String,
      default: '#f8f9fa'
    }
  },
  data: function () {
    return {
      listItems: []
    }
  },
  methods: {
    onDrop(evt) {
      this.$root.$emit('drop-element', evt, this.drop_id);
    }
  }
}
</script>

<style scoped>
.drop-zone {
  background-color: #eee;
  margin-bottom: 10px;
  padding: 10px;
  min-height: 200px;
  width: 250px;
  max-height:400px;
  overflow:auto;
}
</style>
