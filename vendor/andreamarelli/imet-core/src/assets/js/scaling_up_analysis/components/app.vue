<template>
  <div>
    <slot>

    </slot>
  </div>
</template>

<script>
import config from './../config/config.js';
import LocalStore from './../stores/local.storage.store';
import basket_store from './../stores/basket.store';
import base_store from './../stores/base.store';


export default {
  name: "app",
  provide() {
    return {
      stores: {
        BasketStore: new basket_store({scaling_up_id: this.scaling_up_id}),
        BaseStore: new base_store({scaling_up_id: this.scaling_up_id}),
        LocalStore
      },
      config: config
    }
  },
  props: {
    scaling_up_id: {
      type: Number,
      default:
          0
    }
  }
}
</script>

<style scoped>

</style>
