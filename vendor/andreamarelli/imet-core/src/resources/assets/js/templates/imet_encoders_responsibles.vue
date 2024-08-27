<template>

    <div class="imet_responsible">

        <div v-if="to_be_shown['internal'].length>0">
            <b>{{ Locale.getLabel('imet-core::common.responsible_internal') }}</b>:<br />
            <ul>
                <li v-for="resp in to_be_shown['internal']"
                    >{{ resp['Name'] }} <span v-if="resp['Institution']"><i>({{ resp['Institution'] }})</i></span></li>
            </ul>
        </div>

        <div v-if="to_be_shown['external'].length>0">
            <b>{{ Locale.getLabel('imet-core::common.responsible_external') }}</b>:
            <ul>
                <li v-for="resp in to_be_shown['external']"
                    >{{ resp['Name'] }} <span v-if="resp['Institution']"><i>({{ resp['Institution'] }})</i></span></li>
            </ul>
        </div>

        <div v-if="to_be_shown['encoders'].length>0">
            <b>{{ Locale.getLabel('imet-core::common.encoders') }}</b>:
            <ul>
                <li v-for="resp in to_be_shown['encoders']"
                    >{{ resp['name']}} <span v-if="resp['institution']"><i>({{ resp['institution'] }})</i></span></li>
            </ul>
        </div>


        <button class="btn-nav small" v-if="total_count>max_visible && !showHidden" @click=toggleShown ><i class="fas fa-plus-square" /> {{ Locale.getLabel('modular-forms::common.view_all') }}</button>
        <button class="btn-nav small" v-if="showHidden" @click=toggleShown ><i class="fas fa-minus-square" /> {{ Locale.getLabel('modular-forms::common.hide') }}</button>

    </div>


</template>

<style lang="scss" scoped>

  .imet_responsible {
    font-size: 0.85em;
    text-align: left;

    ul {
      margin: 0;
      padding-inline-start: 15px;

      li {
        line-height: 1.4em;
      }
    }

    button {
      margin-top: 5px;
    }

    .hidden {
      display: none !important;
    }
  }

</style>

<script setup>

import { computed, ref } from "vue";

const Locale = window.ModularForms.Helpers.Locale;
const showHidden = ref(false);

const props = defineProps({
    max_visible: {
        type: Number,
        default: 4
    },
    items: {
        type: [String, Object],
        default: () => {
            return {
                'internal': [],
                'external': [],
                'encoders': [],
            }
        }
    }
});

const total_count = computed(() => {
    return props.items['internal'].length
        + props.items['external'].length
        + props.items['encoders'].length;
});

const to_be_shown = computed(() => {
    let items = {
        'internal': [],
        'external': [],
        'encoders': [],
    };

    let current_shown = 0;
    Object.values(props.items['internal']).forEach(function (item) {
        if(current_shown<props.max_visible || showHidden.value){
            if(item['Name']!==null){
                items['internal'].push(item);
            }
        }
        current_shown++;
    });
    Object.values(props.items['external']).forEach(function (item) {
        if(current_shown<props.max_visible || showHidden.value){
            if(item['Name']!==null) {
                items['external'].push(item);
            }
        }
        current_shown++;
    });
    Object.values(props.items['encoders']).forEach(function (item) {
        if(current_shown<props.max_visible || showHidden.value){
            if(item['name']!==null && item['name'].trim()!=="") {
                items['encoders'].push(item);
            }
        }
        current_shown++;
    });
    return items;
});

function  toggleShown(){
    showHidden.value = !showHidden.value;
}


</script>
