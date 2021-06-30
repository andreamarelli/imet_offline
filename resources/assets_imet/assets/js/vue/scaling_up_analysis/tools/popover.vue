<template>
  <div v-if="show" class="popover fade right in" >
    {{label}}
  </div>
</template>

<script>
export default {
  name: "popover",
  props: {
    label: {F
      type: String,
      default: ''
    },
    show:{
      type:Boolean,
      default: false
    }
  }
}
</script>

<style scoped>

</style>