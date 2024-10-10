<template>
  <div class="mt-5" v-show=show_element>
    <div class="strong">{{ title }}</div>
    <slot></slot>
    <div v-for="(list, index) in values" class="mt-3 ml-3" id="collapse-habitats" :key="index">
      <div class="strong">{{ index }}</div>
      <ul>
        <li v-for="(item, k) in list[0]" :key="k">
          {{ item }}
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  name: "elements",
  props: {
    values: {
      type: [Array, Object],
      default: () => {
      }
    },
    show_element: {
      type: Boolean,
      default: false
    },
    comment_title: {
      type: String,
      default: ''
    },
    title: {
      type: String,
      default: ''
    }
  }
}
</script>
