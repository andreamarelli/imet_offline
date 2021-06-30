<template>
  <div>
    <div v-for="item in items">
      <img :src="item"/>
    </div>
  </div>
</template>

<script>

import basket_store from "../stores/basket.store";

export default {
  name: "preview_template",
  props: {
    scaling_up_id: {
      type: String,
      default: ''
    }
  },
  data() {
    return {
      items: [],
      url: window.Laravel.baseUrl + '/'
    }
  },
  mounted() {
    this.printElement();

  },
  methods: {
    printElement: async function () {
      const BasketStore = new basket_store({scaling_up_id: this.scaling_up_id})
      const all = await BasketStore.retrieve_all();
      all.forEach(item => {
        this.items.push(this.url + item.item);
      })
    },
  }
}
</script>

<style scoped>

</style>