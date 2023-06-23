<template>

    <div class="list-key-numbers horizontal" v-if="api_data!==null">

        <div class="list-head" v-if="title!=null">
            {{ title }}
        </div>

        <div v-for="item in indicators" >
            <div class="content">
                <span>{{ item.label }}</span>
                <span class="number" :style="{ color: item.color }">{{ getValue(item)| pretty_number }}</span>
            </div>
        </div>

    </div>

</template>

<script>

    export default {
        mixins: [
            window.ModularForms.FiltersVue.pretty_number
        ],

        props: {
            title: {
                type: String,
                default: null
            },
            indicators: {
                type: [Array],
                default: () => null
            },
            api_data: {
                type: [Object],
                default: () => null
            },
        },

        methods:{

            getValue(item){
                let value = null;
                if(item.hasOwnProperty('fields')){
                    value = this.api_data[item.fields[item.fields.length - 1]]
                } else  if(item.hasOwnProperty('field')){
                    value = this.api_data[item.field];
                }
                return parseFloat(value).toFixed(1);
            }

        }

    }

</script>
