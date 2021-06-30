<template>
  <div>
    <div class="container">
      <div class="row">
      </div>
    </div>
    <div class="stable" id="sidePreview">
      <div class="container">
        <div class="row">
          <div class="col-3">
            <div class="row mb-6">
              <div class="col-sm mt-2">
                <span class="badge badge-pill badge-primary">{{ preview_images.length }}</span>
              </div>
            </div>
            <div class="row mb-6">
              <div class="col-sm mt-2">
                <i
                    @click="remove_all()"
                    class="fa fa-trash green"></i>
              </div>
            </div>
            <div class="row mb-6">
              <div class="col-sm mt-2">
                <i class="fas fa-print" @click="printElement"></i>
              </div>
            </div>
          </div>
          <div class="col-8">
            <div style="" class="scrollPreview mb-2" v-cloak>
              <div id="preview">
                <div class="row dropzone-areas">
                  <drop_drag_area :drop_id="1" :key="1" class="row dropzone_area">
                    <template>
                      <draggable_item class="col" v-for="(image, idx) in preview_images" :key="image.id"
                                      :item="{id:image.id}">
                        <div class="d-flex justify-content-start">
                          <i @click="remove_item(image.id)" class="fa fa-times fa-2x red_dark"></i>
                        </div>
                        <preview_item :url="url+image.url" :width="'100%'">

                        </preview_item>

                      </draggable_item>
                    </template>
                  </drop_drag_area>
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

import preview_item from "./basket/preview_item";
import drop_drag_area from "./drag_and_drop/drop_drag_area";
import draggable_item from "./drag_and_drop/draggable_item";

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
      }else {

      }
    },
    printElement: async function (elem, append = false, delimiter) {
      window.open(window.Laravel.baseUrl + 'admin/imet/v2/report/scaling/up/preview/' + this.stores.BasketStore.get_scaling_up_id(), '', 'directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no');
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
  /*max-height: 100%;*/
  /*overflow: auto;*/
  z-index: 99;

  padding-left: 0px;
  margin-top: 0px;
  margin-left: 0px;
  margin-right: 0px;
  margin-bottom: 0px;
  width: 450px;
}

.stable .col {
  flex-grow: 1;
  max-width: 100%;
  flex-basis: unset;
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
  background-color: #04AA6D;
  text-decoration: none; /* Remove underline */
  font-size: 18px; /* Increase font size */
  color: white; /* White text color */
  border-radius: 5px 5px 5px 5px; /* Rounded corners on the top right and bottom right side */
}

#sidePreview:hover {
  right: 0; /* On mouse-over, make the elements appear as they should */
}

.dropzone_area {
  background-color: #eee;
  /*margin-bottom: 10px;*/
  padding: 10px;
  min-height: 300px;
  width: 500px;
  max-height: 500px;
  overflow: auto;
}

.change-add {
  transition: all 0.1s;
  -webkit-transition: all 0.1s ease-in-out;
}

.change-remove {
  transition: all 0.8s;
  -webkit-transition: all 0.8s ease-in-out;
}

.change {
  background-color: red !important;
  transform: scale(1.5);
}

</style>