<template>
    <div :id="name">
        <div class="mb-2 mt-1">
            <slot :props="data"></slot>
        </div>
        <div class="mb-2 mt-2">
            <div v-if="show_comments" class="mt-3 text-black-50 font-bold generic-comments">{{ title }} :</div>
            <text_editor v-if="show_comments" :save_data="get_data" :event_id="event_data"></text_editor>
            <html_to_image :element="name" :exclude_elements="exclude_elements" :event_id="uniqueEventId">
            </html_to_image>
            <div class="text-right">
                <button type="button" class="btn-nav my-3 exclude-element" @click="save">
                    <span v-if="loading">
                        <i class="fa fa-spinner fa-spin text-primary-800"></i>
                        <span class="sr-only">Loading...</span>
                    </span>
                    <span v-if="!loading" class="text-center">
                        {{ stores.BaseStore.localization('imet-core::analysis_report.add_analysis') }}
                    </span>
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import html_to_image from "../../tools/html_to_image.vue";
import { onMounted, watch, inject, ref, reactive } from "vue";

const stores = inject('stores');
const emitter = inject('emitter')

let get_data = ref(false);
let loading = ref(false);
let title = ref('');
const uniqueEventId = Math.random().toString(36).substring(2, 15);
let values = reactive({
    func: null,
    attr: null
});

const image_src = ref(null);
const comment = ref(null);

const props = defineProps({
    name: {
        type: String,
        default: ''
    },
    exclude_elements: {
        type: String,
        default: ''
    },
    event_image: {
        type: String,
        default: 'save_image'
    },
    event_data: {
        type: String,
        default: 'save_data'
    },
    comment_title: {
        type: String,
        default: null
    },
    data: {
        type: [Object, Array],
        default: () => {
        }
    },
    show_comments: {
        type: Boolean,
        default: true
    }
});

onMounted(() => {
    if (props.comment_title === null) {
        title.value = stores.BaseStore.localization('imet-core::analysis_report.comments');
    } else {
        title.value = props.comment_title;
    }

});

watch([image_src, comment], async ([newA, newB], [prevA, prevB]) => {
    if (newA && ((props.show_comments && newB != null) || !props.show_comments)) {
        const item = await stores.BasketStore.save({ image_src: newA, comment: newB });
        emitter.emit('add-section-template', item);
        resetRefs();
    }
}, { immediate: true });

function resetRefs() {
    image_src.value = null;
    loading.value = false;
}

function add(val, attr) {
    if (attr === 'image_src') {
        image_src.value = val;
    } else {
        comment.value = val;
    }
}

function save() {
    try {
        loading.value = true;
        values = {
            func: add,
            attr: 'image_src'
        };

        comment.value = 'comments';
        if (props.event_image === 'save_image') {
            emitter.emit('save_data' + uniqueEventId, values);
        } else {
            emitter.emit('save_entire_block_as_image' + uniqueEventId, values);
        }
    } catch (error) {
        console.error('Error occurred while emitting save_data event:', error);
        loading.value = false;
    }

    emitter.emit('save_comments' + uniqueEventId, add, 'comment');
}

</script>
