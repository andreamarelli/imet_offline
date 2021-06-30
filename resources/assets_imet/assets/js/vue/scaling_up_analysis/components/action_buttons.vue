<template>
  <div class="mb-5 mt-5">
    <div class="mt-3 text-black-50 font-weight-bold generic-comments"  >{{stores.BaseStore.localization('form/imet/analysis_report/report.comments')}} :</div>
    <p>
      <editor></editor>
    </p>
    <html_to_image :element="name"
                   :exclude_elements="exclude_elements"
                   :type_image="type_image" :event_id="event_id"></html_to_image>
  </div>
</template>

<script>
export default {
  name: "action_buttons",
  inject:['stores'],
  props: {
    name: {
      type: String,
      default: null
    },
    exclude_elements: {
      type: String,
      default: ''
    },
    event_id:{
      type:String,
      default:'save_image'
    },
    type_image:{
      type:String,
      default:'entire'
    }
  }
}
</script>