<template>
    <div class="smallMenu" style="min-height: 80px;">
        <div class="standalone js-smallMenu" id="smallMenu" v-if="listNames.length > 1">
            <div :class="{ active: isSelected(idx) }" v-for="(item, idx) in listNames" v-html="item"
                @click="scrollToSection(idx)" :key="idx">
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';

const props = defineProps({
    items: {
        type: [Object, Array],
        default: () => ({}),
    },
    exclude: {
        type: String,
        default: '',
    },
    ids: {
        type: String,
        default: '',
    },
    root_dir: {
        type: String,
        default: '',
    },
});

const listNames = ref([]);
const selection = ref(null);

const excludedItems = props.exclude.split(',');

const listItems = () => {
    const objectEntries = Object.entries(props.items);
    if (objectEntries.length > 0) {
        objectEntries.forEach((item) => {
            if (!excludedItems.includes(item[0])) {
                listNames.value.unshift(item[0]);
            }
        });
    }
};

const scrollToSection = (idx) => {
    const element = document.getElementById(props.ids + idx);
    element?.scrollIntoView({ behavior: "smooth" });
    selection.value = idx;
};

const isSelected = (index) => selection.value === index;

onMounted(() => {
    listItems();
});
</script>
