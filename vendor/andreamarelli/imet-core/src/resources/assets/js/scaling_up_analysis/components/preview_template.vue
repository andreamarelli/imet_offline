<template>
    <div>
        <div class="img-fluid" v-for="(item, idx) in items" :id="'image-content' + idx" :key="idx">
            <div>
                <img @load="imageLoaded(idx)" :src="item" :id="idx" />
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref, watch, onMounted } from "vue";
import basket_store from "../stores/basket.store.js";

const props = defineProps({
    scaling_up_id: {
        type: [String, Number],
        default: ''
    }
});

const items = ref([]);
const pixelsPage = ref(0);
const images = ref([]);

onMounted(async () => {
    await printElement();
})

watch(images.value, (val, oldVal) => {
    if (val.length === items.length) {
        isHeightEnough();
    }
}, { deep: true })

function imageLoaded(id) {
    images.value.push(id);
}

function isHeightEnough() {
    items.value.forEach((item, id) => {
        const img = document.getElementById(`${id}`);
        pixelsPage.value += img.height;

        if (pixelsPage.value > 1200 && pixelsPage.value < 1500) {
            const div = document.getElementById('image-content' + (id));
            div.className = "content";
            pixelsPage.value = 0;
        } else if (pixelsPage.value > 1500) {
            const div = document.getElementById('image-content' + (id - 1));
            div.className = "content";
            pixelsPage.value = 0;
        }
    })
}

async function printElement() {
    const BasketStore = new basket_store({ scaling_up_id: props.scaling_up_id })
    const all = await BasketStore.retrieve_all();

    all.forEach(item => {
        items.value.push('/' + item.item);
    })
}

</script>
