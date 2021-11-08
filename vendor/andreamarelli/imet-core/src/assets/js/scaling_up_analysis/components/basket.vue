<template>
  <div>
    <div class="container">
      <div class="row">
      </div>
    </div>
    <div class="stable" id="sidePreview">
      <div class="container">
        <div class="row">
          <div class="col-1 basket-menu">
            <div class="mt-2">
              <span class="badge badge-pill badge-primary">{{ preview_images.length }}</span>
            </div>
            <div class="mt-2">
              <i
                  @click="remove_all()"
                  class="fa fa-trash green"></i>
            </div>
            <div class="mt-2">
              <i class="fas fa-print" @click="printElement"></i>
            </div>
          </div>
          <div class="col basket">
            <div style="" class="scrollPreview mb-2" v-cloak>
              <div id="preview">
                <div v-if="preview_images.length > 0" class="row" v-for="(image, idx) in preview_images" :key="image.id">
                  <div class="col">
                    <div class="d-flex justify-content-start">
                      <i @click="remove_item(image.id)" class="fa fa-times fa-2x red_dark"></i>
                    </div>
                    <preview_item :url="image.url" :width="'100%'">
                    </preview_item>
                  </div>
                </div>
                <div v-else>
                  Basket is empty
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div style="display:none">
      <div id="template">
      </div>
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
      },
      url: window.Laravel.baseUrl + '/'
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
      window.open(window.Laravel.baseUrl + 'admin/imet/scaling_up/preview/' + this.stores.BasketStore.get_scaling_up_id(), '', 'directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no');
    },
    preview_template_window: function (img_url) {
      return `<div class='container'><div class="row mb-5"><div class="col-sm"><img class="img-fluid" src="${img_url}"/></div></div></div>`;
    }
  }
}
</script>

<style scoped>
.stable {
  right: 40px;
  z-index: 9999999;
}

.stable .scrollPreview {
  z-index: 99;

  padding-left: 0px;
  margin-top: 0px;
  margin-left: 0px;
  margin-right: 0px;
  margin-bottom: 0px;
  width: 400px;
}


.stable .basket-menu {
  margin-top: 50px;
  background-color: #04AA6D;

  height: 100px;
  width: 30px;
  box-sizing: content-box;
  border-radius: 5px 0px 0px 5px; /* Rounded corners on the top right and bottom right side */
}

.basket {
  background-color: #eee;
  margin-bottom: 10px;
  padding: 10px;
  min-height: 200px;
  width: 490px;
  max-height: 400px;
  overflow: auto;
  border-radius: 5px 5px 5px 5px;
  border: solid #04AA6D;
}

.stable .col {
  flex-grow: 1;
  max-width: 100%;
}

.fa-trash {
  color: red;
}

.fa-times:hover,
.fa-trash:hover {
  color: red;
}

#sidePreview {
  position: fixed; /* Position them relative to the browser window */
  right: -490px; /* Position them outside of the screen */
  transition: 0.5s; /* Add transition on hover */
  padding: 20px 0px 0px 5px; /* 15px padding */

  text-decoration: none; /* Remove underline */
  font-size: 18px; /* Increase font size */
  color: white; /* White text color */
  border-radius: 5px 5px 5px 5px; /* Rounded corners on the top right and bottom right side */
}

#sidePreview:hover {
  right: 0; /* On mouse-over, make the elements appear as they should */
}

</style>
