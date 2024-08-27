<template>

    <selector-dialog
        v-model="inputValue"
        :parent-id=id
        :search-url=searchUrl
        :label-url=labelUrl
        :multiple=multiple
        :with-id=true
        ref="selectorDialogComponent"
    >

        <!-- api search - result header -->
        <template v-slot:searchResultHeader>
            <th>{{ Locale.getLabel('imet-core::common.name') }}</th>
            <th>{{ Locale.getLabel('imet-core::common.protected_area.wdpa_id',1) }}</th>
            <th>{{ Locale.getLabel('imet-core::common.country') }}</th>
            <th>{{ Locale.getLabel('imet-core::common.protected_area.iucn_category') }}</th>
        </template>

        <!-- api search - result items -->
        <template #searchResultItem="{ item }">
            <td><span class="result_left"><b>{{ item.name }}</b></span></td>
            <td><a v-if="item.wdpa_id!==null"
                   target="_blank"
                   href="https://www.protectedplanet.net/'+item.wdpa_id+'">{{ item.wdpa_id }}</a></td>
            <td>{{ item.country_name }}</td>
            <td>{{ item.iucn_category }}</td>
        </template>

    </selector-dialog>


</template>

<style lang="scss" scoped></style>

<script setup>

import {ref, provide, onBeforeMount, onMounted} from "vue";
const selectorDialog = window.ModularForms.Components.selectorDialog;

const Locale = window.ModularForms.Helpers.Locale;

const props = defineProps({
    id: {
        type: String,
        default: null
    },
    searchUrl: {
        type: String,
        default: null
    },
    labelUrl: {
        type: String,
        default: null
    },
    multiple: {
        type: Boolean,
        default: false,
    }
});

// components, injections & expose
const selectorDialogComponent = ref(null);
provide('setLabel', setLabel);
provide('setValue', setValue);

// values
const inputValue = defineModel();

function setLabel(item) {
   return item?.name
}

function setValue(item){
    return item?.wdpa_id;
}

</script>
