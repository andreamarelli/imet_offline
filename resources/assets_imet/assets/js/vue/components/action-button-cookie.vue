<template>
  <button :class="className" v-on:click="store_to_cookie_by_id_and_value('analysis')">
    {{ label }}
  </button>
</template>

<script>
import actionButton from './action-button'

export default {
  name: "action-button-cookie.vue",
  mixins: [actionButton],
  methods: {

    store_to_cookie_by_id_and_value(cookieName) {
      if (this.data.length > 0) {
        const cookieExist = window.Cookies.getByName(cookieName);
        if (cookieExist) {
          const cookie = cookieExist.split('=');
          const cookie_items = JSON.parse(cookie[1]);
          const data = JSON.parse(this.data);
          const merge_values = [...cookie_items, ...data];
          const total = merge_values.reduce((arr, item) => {
            if(Array.isArray(arr)) {
              return arr.some(a => a.id == item.id) ? arr : [...arr, item];
            }

            return arr.id === item.id ? [arr] : [arr, item];
          });
          window.Cookies.create(cookie[0], JSON.stringify(total));
        } else {
          window.Cookies.create(cookieName, (this.data));
        }
        this.$root.$emit('reset_checkboxes');
        this.action();
      }
    },

    store_to_cookie: function (cookieName) {
      if (this.data.length > 0) {
        const cookieExist = window.Cookies.getByName(cookieName);
        if (cookieExist) {
          const cookie = cookieExist.split('=');
          const total = [...new Set([...cookie[1].split('|').map(i => parseInt(i)), ...this.data.map(i => parseInt(i))])];
          window.Cookies.create(cookie[0], total.join("|"));
        } else {
          window.Cookies.create(cookieName, this.data.join("|"));
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