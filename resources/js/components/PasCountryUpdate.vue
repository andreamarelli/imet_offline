<template>

    <div class="bg-gray-100 py-1 px-2 flex justify-between content-center">
        <div><span class="fi" :class="'fi-'+iso2.toLowerCase()"></span> <span class="text-sm">{{ name }}</span></div>
        <div class="flex items-center justify-items-end">

            <!-- Loading -->
            <template v-if=loading>
                <i class="fa-solid fa-sync fa-spin"></i>
            </template>

            <!-- Error: missing API key -->
            <template v-else-if=api_key_error>
                <span class="text-red-600 text-sm">
                    <i class="fa-solid fa-triangle-exclamation pl-2"></i>
                    {{ Locale.getLabel('offline.errors.missing_api_token') }}
                </span>
            </template>

            <!-- Error: generic -->
            <template v-else-if=api_error>
                <span class="text-red-600 text-sm">
                    <i class="fa-solid fa-triangle-exclamation pl-2"></i>
                    {{ Locale.getLabel('offline.errors.generic') }}
                </span>
            </template>

            <!-- Update -->
            <template v-else-if=downloaded>
                <span v-if=updated class="italic text-xs pr-2">
                    {{ Locale.getLabel('offline.settings.protected_areas.last_update') }}: {{ updated }}
                </span>
                <template v-if="!loaded">
                    <button class="btn-nav gray small whitespace-nowrap" @click="update(iso3)">
                        <span class="fas fa-fw fa-rotate"></span>
                        {{ Locale.getLabel('offline.settings.protected_areas.update') }}
                    </button>
                </template>
                <span class="fas fa-fw fa-check-circle text-green-600 pl-2"></span>
            </template>

            <!-- Download -->
            <template v-else>
                <button class="btn-nav gray small whitespace-nowrap" @click="update(iso3)">
                    <span class="fas fa-fw fa-down-long"></span>
                    {{ Locale.getLabel('offline.settings.protected_areas.download') }}
                </button>
                <span class="fas fa-fw fa-xmark-circle text-red-600 pl-2"></span>
            </template>


        </div>
    </div>

</template>

<script setup>

import { ref } from 'vue';

const Locale = window.ModularForms.Helpers.Locale;

const props = defineProps({
    iso2: String,
    iso3: String,
    name: String,
    downloaded: Boolean,
    updated: String,
    updateUrl: String,
});

const loading = ref(false);
const loaded = ref(false);
const downloaded = ref(props.downloaded);
const updated = ref(props.updated);
const api_key_error = ref(false);
const api_error = ref(false);

function update(iso3) {
    loading.value = true;

    fetch(props.updateUrl, {
        method: 'POST',
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-Token": window.Laravel.csrfToken,
        },
        body: JSON.stringify({
            'iso3': iso3,
        }),
    })
        .then((response) => response.json())
        .then(function(data){
            if (data.status === 'success') {
                downloaded.value = true;
                updated.value = data.updated;
                loaded.value = true;
            } else {
                if(data.message.includes('API key')) {
                    api_key_error.value = true;
                } else {
                    api_error.value = true;
                }
            }
            loading.value = false;
        })
        .catch(function (error) {
            api_error.value = true;
            loading.value = false;
        });
}



</script>
