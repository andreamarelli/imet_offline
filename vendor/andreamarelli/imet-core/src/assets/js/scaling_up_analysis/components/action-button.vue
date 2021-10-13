<template>
  <button :class="className" v-on:click="action">
    {{ label }}
  </button>
</template>

<script>
export default {
  name: "action-button.vue",
  props: {
    event: {
      type: String,
      default: '',
    },
    className: {
      type: String,
      default: 'btn btn-success float-left'
    },
    label: {
      type: String,
      default: 'Submit'
    }
  },
  data() {
    const Locale = window.Locale;
    return {
      Locale: Locale,
      isEnabled: false,
      data: []
    };
  },
  mounted: function () {
    this.$root.$on('actionData', (data) => {
      this.eventFunction(data);
    })
  },
  methods: {
    eventFunction: function(value){
      this.data = value;
      this.isEnabled = true;
    },
    resetValues: function(){
      this.isEnabled = false;
      this.data = [];
    },
    action: function () {
      if (this.event) {
        this.$root.$emit(this.event);
        this.resetValues();
      }

    }
  }
}
</script>

<style scoped>

</style>