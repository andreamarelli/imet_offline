<template>
    <div class="horizontal">
        <div class="sub-title" v-html="stores.BaseStore.localization('imet-core::analysis_report.element_diagrams.threats.threats.title')"></div>

        <div class="bg-white collapse mb-2 show">
            <guidance :text="guidance"/>
            <checkboxes_list :items="items" :event="'apply_filter'"/>
            <div v-if="show_loader" class="spinner-border text-success" role="status">
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

<script>

import container_cycle from './container_analysis_management_cycle.vue';

export default {
    name: "container_analysis_management_threat.vue",
    mixins: [
        window.ImetCore.ScalingUp.Mixins.ajax,
        container_cycle
    ]

}
</script>
