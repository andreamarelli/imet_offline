<template>
    <div>

        <div class="basket">

            <div class="basket-menu">
                <span class="badge badge-pill badge-primary">{{ preview_images.length }}</span>
                <i @click="remove_all()" class="fa fa-trash text-red-800"></i>
                <i class="fas fa-print" @click="printElement"></i>
            </div>

            <div class="basket-content">
                <div v-if="preview_images.length > 0" v-for="(image, idx) in preview_images" :key="image.id">
                    <div class="flex justify-start gap-2">
                        <i @click="remove_item(image.id)" class="fa fa-times fa-2x text-red-800"></i>
                        <preview_item :url="image.url" :width="'100%'">
                        </preview_item>
                    </div>

                </div>
                <div v-else>
                    Basket is empty
                </div>
            </div>

        </div>

        <div style="display:none">
            <div id="template"></div>
        </div>

    </div>
</template>

<script>

import preview_item from "./basket/preview_item.vue";
import drop_drag_area from "./drag_and_drop/drop_drag_area.vue";
import draggable_item from "./drag_and_drop/draggable_item.vue";

export default {
  name: "printable_template",
  inject: ['stores'],
  components: {
    preview_item,
    drop_drag_area,
    draggable_item
  },
  data: function () {
    return {
      preview_images: [],
      just_added: false,
      ordering_elements: {
        element_selected: null,
        element_replaced: null
      }
    }
  },
  async mounted() {
    this.basket_events();
    await this.load_all();
  },
  methods: {
    basket_events: function () {
      window.vueBus.$on('add-section-template', (item) => {
        this.preview_images.push({id: item.id, url: item.item});
        this.just_added = true;
      });

      // this.$root.$on('remove-element', (id) => {
      //   this.remove_from_list(id);
      // });
    },
    not_empty: function () {
      return this.preview_images.length > 0;
    },
    async load_all() {
      const items = await this.stores.BasketStore.retrieve_all();
      items.forEach(item => {
        this.preview_images.push({id: item.id, url: item.item});
      })
    },
    remove_item: async function (idx) {
      //this.preview_images = this.preview_images.filter((i, index) => index !== idx);
      this.preview_images = [];
      const success = await this.stores.BasketStore.delete(idx);
      if (success) {
        await this.load_all();
      }
    },
    remove_all: async function () {
      this.preview_images = [];
      const success = await this.stores.BasketStore.clear();
      if (success) {
        await this.load_all();
      } else {

      }
    },
    printElement: async function (elem, append = false, delimiter) {
      window.open(
          window.Routes.scaling_up_preview.replace('__id__', this.stores.BasketStore.get_scaling_up_id()),
          '', 'directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no');
    }
  }
}
</script>

<style lang="scss" scoped>

.basket {
    font-size: 18px;
    color: white;

    display: flex;

    z-index: 9999999;
    position: fixed;
    top: 20%;
    right: -490px;
    &:hover {
        right: 0;
    }

    .basket-menu {
        width: 30px;
        height: fit-content;
        row-gap: 15px;
        padding: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background-color: #04AA6D;
        border-radius: 5px 0 0 5px;
    }

    .basket-content {
        width: 490px;
        border-bottom-left-radius: 5px;
        overflow: auto;
        border: 2px solid #04AA6D;
        border-right: none;
        background-color: #eee;
        padding: 10px;
        min-height: 200px;
        max-height: 400px;
    }
    
}

.fa-times:hover,
.fa-trash:hover {
  color: red;
}

</style>
