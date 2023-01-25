<template>
    <button :class="className" v-on:click="store_to_cookie_by_id_and_value('analysis')">
        {{ label }}
    </button>
</template>

<script>
import actionButton from './action-button.vue'

export default {
    name: "action-button-cookie.vue",
    mixins: [actionButton],
    mounted: function () {
        this.$root.$on('store_cookie_and_value', (name, data) => {
            this.store_to_cookie_by_id_and_value(name, data);
        })
    },
    methods: {

        store_to_cookie_by_id_and_value(cookieName, data_values = null) {
            if (data_values === null) {
                data_values = this.data;
            }
            if (data_values.length > 0) {
                const cookieExist = window.ModularForms.Mixins.Cookies.getByName(cookieName);
                if (cookieExist) {
                    const cookie = cookieExist.split('=');
                    const cookie_items = JSON.parse(cookie[1]);
                    const data = JSON.parse(data_values);
                    const merge_values = [...cookie_items, ...data];
                    const total = merge_values.reduce((arr, item) => {
                        if (Array.isArray(arr)) {
                            return arr.some(a => a.id == item.id) ? arr : [...arr, item];
                        }

                        return arr.id === item.id ? [arr] : [arr, item];
                    });
                    window.ModularForms.Mixins.Cookies.create(cookie[0], JSON.stringify(total));
                } else {
                    window.ModularForms.Mixins.Cookies.create(cookieName, (data_values));
                }
                this.$root.$emit('reset_checkboxes');
                this.action();
            }
        },

        store_to_cookie: function (cookieName) {
            if (this.data.length > 0) {
                const cookieExist = window.ModularForms.Mixins.Cookies.getByName(cookieName);
                if (cookieExist) {
                    const cookie = cookieExist.split('=');
                    const total = [...new Set([...cookie[1].split('|').map(i => parseInt(i)), ...this.data.map(i => parseInt(i))])];
                    window.ModularForms.Mixins.Cookies.create(cookie[0], total.join("|"));
                } else {
                    window.ModularForms.Mixins.Cookies.create(cookieName, this.data.join("|"));
                }
                this.$root.$emit('reset_checkboxes');
                this.action();
            }
        }
    }
}
</script>

<style scoped>

</style>
