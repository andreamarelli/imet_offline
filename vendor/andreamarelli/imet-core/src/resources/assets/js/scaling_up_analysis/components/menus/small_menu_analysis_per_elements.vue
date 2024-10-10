<template>
    <div class="smallMenu" style="min-height: 80px;">
      <div class="standalone js-smallMenu" id="smallMenu" v-if="listNames.length > 1">
        <div
          :class="isSelected(idx)"
          v-for="(item, idx) in listNames"
          v-html="item[1]"
          @click="scrollToSection(item[0])"
          :key="idx"
        >
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
  const excludedItems = ref([]);
  const selection = ref(null);

  const excludeItems = () => {
    excludedItems.value = props.exclude.split(',');
  };

  const listItems = () => {
    excludeItems();
    const objectEntries = Object.entries(props.items);
    if (objectEntries.length > 0) {
      objectEntries.forEach((item) => {
        if (!excludedItems.value.includes(item[0])) {
          if (item[1].length) {
            item[1].forEach((v) => {
              const { menu, name } = v;
              const menuItem = ['header', item[0], name];
              listNames.value.push([menuItem.join('-'), menu.header]);
            });
          } else {
            listNames.value.unshift(item[1]);
          }
        }
      });
    }
  };

  const scrollToSection = (idx) => {
    const element = document.getElementById(props.ids + idx);
    element.scrollIntoView({ behavior: "smooth" });
    selection.value = idx;
  };

  const isSelected = (index) => {
    return selection.value === index ? 'active' : '';
  };

  onMounted(() => {
    listItems();
  });
  </script>
