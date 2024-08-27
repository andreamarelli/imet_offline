<template>
</template>

<script>


export default {
    name: "container_event",
    inject: ['stores'],
    mixins: [
        window.ImetCore.ScalingUp.Mixins.ajax
    ],
    props: {
        event_name: {
            type: String,
            default: ''
        }

    },

    mounted() {
        if (this.event_name) {
            this.$root.$on(this.event_name, () => {
                this.data.show_view = true;
            });
        }
    }
}
</script>
