<template>

  <div class="list-key-numbers horizontal" v-if="api_data!==null">

    <div class="list-head" v-if="title!=null">
      {{ title }}
    </div>

    <div v-for="item in indicators">
      <div class="content">
        <span>{{ item.label }}</span>
        <span class="number" :style="{ color: item.color }">{{ getValue(item)| pretty_number(precision) }}</span>
      </div>
    </div>

  </div>

</template>

<script>
import base from './dopa_indicators_table';

export default {
  mixins: [base],
}

</script>
