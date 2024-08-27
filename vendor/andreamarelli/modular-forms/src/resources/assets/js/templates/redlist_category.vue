<template>

    <div>
        <span :class="[compact ? 'compact' : '', 'red-list_'+category]">
            {{ category }}
        </span>
        <tooltip>
            {{ category_plain }}
        </tooltip>
    </div>

</template>


<script setup>

    const Locale = window.ModularForms.Helpers.Locale;

    const props = defineProps({
        category: {
            type: String,
            default: null
        },
        compact:{
            type: Boolean,
            default: false
        }
    });

    const category_plain = Locale.getLabel('modular-forms::entities.biodiversity.red_list_categories.'+props.category)

</script>
