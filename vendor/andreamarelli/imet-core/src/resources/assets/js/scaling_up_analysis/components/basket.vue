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

<script setup>
import { ref, onMounted, inject } from 'vue';
import preview_item from "./basket/preview_item.vue";


const stores = inject('stores');
const emitter = inject('emitter');

const preview_images = ref([]);
const just_added = ref(false);

const basket_events = () => {
  emitter.on('add-section-template', (item) => {
    preview_images.value.push({id: item.id, url: item.item});
    just_added.value = true;
  });
};

const not_empty = () => preview_images.value.length > 0;

const load_all = async () => {
  const items = await stores.BasketStore.retrieve_all();
  items?.forEach(item => {
    preview_images.value.push({id: item.id, url: item.item});
  });
};

const remove_item = async (idx) => {
  preview_images.value = [];
  const success = await stores.BasketStore.delete(idx);
  if (success) {
    await load_all();
  }
};

const remove_all = async () => {
  preview_images.value = [];
  const success = await stores.BasketStore.clear();
  if (success) {
    await load_all();
  }
};

const printElement = async () => {
  window.open(
    window.Routes.scaling_up_preview.replace('__id__', stores.BasketStore.get_scaling_up_id()),
    '', 'directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no'
  );
};

onMounted(async () => {
  basket_events();
  await load_all();
});
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
