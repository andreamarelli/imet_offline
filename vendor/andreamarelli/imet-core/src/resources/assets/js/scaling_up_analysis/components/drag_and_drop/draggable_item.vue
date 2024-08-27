<template>
    <div
        :id="item.id"
        :class="'item_class'" class="default-zone-element"
        draggable
        @drop="onDrop($event, item)"
        @dragstart='start_drag($event, item)'
        @dragover='drag_over($event, item)'

    >
        <i class="fa-solid fa-grip-vertical mr-2 cursor-grab"></i>
        <slot></slot>
        <span >{{ item.name }}</span>
        <i v-if="is_removable" class="fa fa-times ml-2" aria-hidden="true" @click='remove_item(item.id)'></i>

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
        remove_event: {
            type: String,
            default: 'remove-element'
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
    margin-bottom: 5px;
    padding: 5px 10px;
}
</style>
