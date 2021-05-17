<template>

    <div class="no_data">
        {{ Locale.getLabel('mapping.common.no_historic_data') }}
    </div>
</template>

<script>

    export default {

        data: function () {
            return {
                Locale: window.Locale,
            }
        }

    }

</script>


<style lang="scss" type="text/scss" scoped>

</style>
