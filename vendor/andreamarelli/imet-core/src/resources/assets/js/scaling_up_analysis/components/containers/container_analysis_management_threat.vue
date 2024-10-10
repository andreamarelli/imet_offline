<template>
    <div class="horizontal">
        <div class="sub-title" v-html="stores.BaseStore.localization('imet-core::analysis_report.element_diagrams.threats.threats.title')"></div>

        <div class="bg-white collapse mb-2 show">
            <guidance :label="props.info_label"/>
            <checkboxes_list :items="items" :event="'apply_filter'"/>
            <div v-if="show_loader">
                <i class="fa fa-spinner fa-spin text-primary-800"></i>
                <span class="sr-only">Loading...</span>
            </div>
            <div v-else>
                <div v-if="error_returned" class="dopa_not_available mt-3"
                     v-html="stores.BaseStore.localization('entities.dopa_not_available')"></div>
                <div v-else-if="timeout" class="dopa_not_available mt-3"
                     v-html="stores.BaseStore.localization('entities.dopa_not_available')"></div>
                <div v-else-if="error_wrong" class="dopa_not_available mt-3"
                     v-html="stores.BaseStore.localization('imet-core::analysis_report.error_wrong')"></div>
                <div v-else class="container-menu mt-3">

                    <slot :props="data"></slot>
                </div>
            </div>
        </div>
    </div>
</template>


<script setup>
import { inject } from 'vue';

const stores = inject('stores');
</script>
