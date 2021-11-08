<template>
  <div  class="collapse mt-5" :class="{show: show_element}">
    <strong>{{ title }}</strong>
    <slot></slot>
    <div v-for="(list, index) in values" class="mt-3 ml-3" id="collapse-habitats" >
      <strong>{{ index }}</strong>
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