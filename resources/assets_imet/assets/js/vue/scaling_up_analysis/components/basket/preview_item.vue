<template>
    <div class="img-container">

      <img :src="url" :width="width"/>
      <div class="img-text"> <slot></slot></div>

    </div>
</template>

<script>
export default {
  props:{
    url:{
      type:String,
      default: ''
    },
    width:{
      type:String,
      default: '100px'
    }
  },
  name: "preview_item",
}
</script>

<style scoped>
.img-container{
  position: relative;
  display: inline-block;
  margin: 10px 5px 5px;
  max-width: 450px;
  max-height: 350px;
  overflow: auto;
}
.img-text{
  top:28px;
  margin-top: -25px;
  position: absolute;
  display:block;
  right:5px;
}
</style>