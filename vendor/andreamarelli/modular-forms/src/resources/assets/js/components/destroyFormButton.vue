<template>

    <dialog-box ref="destroyDialog">

        <template v-slot:dialog-anchor>
            <button type="button" class="btn-nav small red"><span class="fas fa-fw fa-trash" /></button>
            <tooltip>{{ Locale.getLabel('modular-forms::common.delete') }}</tooltip>
        </template>

        <template v-slot:dialog-content>

            <div class="with_header_and_footer">
                <div class="header">
                   {{ Locale.getLabel('modular-forms::common.confirm_deletion') }}
                </div>
                <div class="body"></div>
                <div class="footer">
                    <div class="spacer"></div>
                    <!-- cancel -->
                    <button type="button" v-on:click="closeDestroyDialog" class="btn-nav small green">{{ Locale.getLabel('modular-forms::common.cancel') }}</button>
                    <!-- confirm destroy -->
                    <form style="display: inline-block"
                          method="POST" :action=action>
                        <input type="hidden" name="_token" :value=csrfToken />
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn-nav small red">
                            <span class="fas fa-fw fa-trash" /> {{ Locale.getLabel('modular-forms::common.delete') }}
                        </button>
                    </form>
                </div>
            </div>

        </template>

    </dialog-box>


</template>

<script setup>

import { ref } from "vue";

const Locale = window.ModularForms.Helpers.Locale;
const csrfToken = window.Laravel.csrfToken;

const props = defineProps({
    action: {
        type: String,
        required: true
    },
});

const destroyDialog = ref(null);

function closeDestroyDialog() {
    destroyDialog.value.closeDialog();
}

</script>
