<template>

    <div class="data data-year" v-if="year!==''">
        {{ Locale.getLabel('mapping.common.data_year') }}&nbsp;
        <strong>{{ year }}</strong>
    </div>

</template>

<script>
    export default {

        props: {
            year: {
                type: [Number, String],
                default: ''
            },
        },

        data: function () {
            return {
                Locale: window.Locale,
            }
        }
    }
</script>