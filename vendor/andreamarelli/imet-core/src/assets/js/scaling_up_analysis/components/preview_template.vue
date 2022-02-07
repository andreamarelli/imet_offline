<template>
  <div>
    <div :class="classDiv" v-for="(item, idx) in items" :id="'image-content'+idx">
      <div>
        <img @load="imageLoaded(idx)" :src="item" :id="idx" width="1024"/>
      </div>
    </div>
  </div>
</template>

<script>

import basket_store from "../stores/basket.store.js";

export default {
  name: "preview_template",
  props: {
    scaling_up_id: {
      type: [String, Number],
      default: ''
    }
  },
  data() {
    return {
      items: [],
      url: window.Laravel.baseUrl + '/',
      classDiv: '',
      pixelsPage: 0,
      images: []
    }
  },
  mounted() {
    this.printElement();
  },
  watch: {
    images: function (val, oldVal) {
      if (val.length === this.items.length) {
        this.isHeightEnough();
      }
    }
  },
  methods: {
    imageLoaded: function (id) {
      this.images.push(id);
    },
    isHeightEnough: function () {
      this.items.forEach((item, id) => {
        const img = document.getElementById(`${id}`);

        this.pixelsPage += img.height;

        if (this.pixelsPage > 1200 && this.pixelsPage < 1500) {
          const div = document.getElementById('image-content' + (id));
          div.className = "content";
          this.pixelsPage = 0;
        } else if (this.pixelsPage > 1500) {
          const div = document.getElementById('image-content' + (id - 1));
          div.className = "content";
          this.pixelsPage = 0;
        }
      })
    },
    printElement: async function () {
      const BasketStore = new basket_store({scaling_up_id: this.scaling_up_id})
      const all = await BasketStore.retrieve_all();
      all.forEach(item => {
        this.items.push('/' + item.item);
      })
    },
  }
}
</script>

<style scoped>

</style>
