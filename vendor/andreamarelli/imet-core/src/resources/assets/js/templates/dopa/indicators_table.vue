<template>
    <div class="list-key-numbers" v-if="api_data !== null">
        <div class="list-head" v-if="title != null">
            {{ title }}
        </div>
        <div class="grid grid-cols-3 gap-4">
            <div v-for="item in indicators" :key="item.label" class="flex flex-col items-center">
                <span class="text-sm mb-1">{{ item.label }}</span>
                <span class="text-lg font-bold highlight" :style="{ color: item.color }">{{
                    pretty_number(getValue(item))
                    }}</span>
            </div>
        </div>
    </div>

</template>

<script>

export default {

    props: {
        title: {
            type: String,
            default: null
        },
        indicators: {
            type: [Array],
            default: () => null
        },
        api_data: {
            type: [Object],
            default: () => null
        },
    },


    methods: {
        pretty_number(value, precision = 0) {
            return window.ModularForms.Helpers.Common.pretty_number(value, precision)
        },
        getValue(item) {
            let value = null;
            if (item.hasOwnProperty('fields')) {
                value = this.api_data[item.fields[item.fields.length - 1]]
            } else if (item.hasOwnProperty('field')) {
                value = this.api_data[item.field];
            }
            return parseFloat(value).toFixed(1);
        }

    }

}

</script>
