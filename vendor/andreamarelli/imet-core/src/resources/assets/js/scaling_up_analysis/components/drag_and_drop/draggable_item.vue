<template v-slot>
   <div
        :id="item.id"
        :class="'item_class'" class="default-zone-element"
        draggable="true"
        @drop="onDrop($event, item)"
        @dragstart='startDrag($event, item)'
        @dragover='dragOver($event, item)'
    >
        <i class="fa-solid fa-grip-vertical mr-2 cursor-grab"></i>
        <slot></slot>
        <span >{{ item.name }}</span>
        <i v-if="is_removable" class="fa fa-times ml-2" aria-hidden="true" @click='removeItem(evt, item.id)'></i>
    </div>
</template>
<script setup>
import { inject } from 'vue';

const emitter = inject('emitter');
const props = defineProps({
    item: {
        type: Object,
        default: () => ({})
    },
    is_removable: {
        type: Boolean,
        default: true
    },
    item_class: {
        type: String,
        default: 'default-zone-element'
    },
    remove_event: {
        type: String,
        default: 'remove-element'
    }
});

const emit = defineEmits(['drop-item-area', 'drag-over', 'drag-element', 'drag-end', 'remove-element']);

const onDrop = (evt, item) => {
    const itemID = evt.dataTransfer.getData('itemID');

    emit('drop-item-area', evt, itemID);
};

const dragOver = (evt, item) => {
    emit('drag-over', evt, item);
};

const startDrag = (evt, item) => {
    evt.dataTransfer.effectAllowed = 'move';
    evt.dataTransfer.setData('itemID', item.id);
    emit('drag-element', evt, item);
};

const removeItem = (evt, item) => {
    emit(props.remove_event, evt, item);
};
</script>

<style scoped>
.default-zone-element {
    background-color: #fff;
    margin-bottom: 5px;
    padding: 5px 10px;
}
</style>
