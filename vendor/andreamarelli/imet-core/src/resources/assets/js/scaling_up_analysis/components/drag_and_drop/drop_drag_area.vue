<template>
    <div :style="'background-color:'+ color" class="drop-zones d-grid gap-1 rounded"
         @drop='onDrop($event)' @dragover.prevent
         @dragenter.prevent>
      <slot></slot>
    </div>
</template>
<script setup>
import {inject} from 'vue';


const emit = defineEmits(['drop-element']);
const props = defineProps({
    drop_id: {
        type: Number,
        default: 0
    },
    visible: {
        type: Boolean,
        default: true
    },
    color: {
        type: String,
        default: '#f8f9fa'
    }
});


const onDrop = (evt) => {
    emit('drop-element', evt, props.drop_id);
};
</script>

<style scoped>
.drop-zones {
  background-color: #eee;
  margin-bottom: 10px;
  padding: 10px;
  min-height: 200px;
  min-width: 250px;
  max-height: 400px;
  overflow: auto;
}
</style>
