<template>
    <div class="list-key-numbers horizontal">

        <div class="list-head carbon">
            <div class="title">{{ title }} {{ unit }}</div>
            <div class="toggle" v-if="layer!==null">
                <layer_toggle
                    :layer=layer
                    :as_button=true
                    :exclusive_layer=true
                ></layer_toggle>
            </div>
        </div>

        <div>
            <div class="content">
                <span>{{ Locale.getLabel('mapping.common.carbon.min') }}</span>
                <span class="number">{{ api_data['min'] | pretty_number }}</span>
            </div>
        </div>
        <div>
            <div class="content">
                <span>{{ Locale.getLabel('mapping.common.carbon.average') }}</span>
                <span class="number">{{ api_data['average'] | pretty_number }}</span>
            </div>
        </div>
        <div>
            <div class="content">
                <span>{{ Locale.getLabel('mapping.common.carbon.max') }}</span>
                <span class="number">{{ api_data['max'] | pretty_number }}</span>
            </div>
        </div>
        <div>
            <div class="content">
                <span>{{ Locale.getLabel('mapping.common.carbon.sum') }}</span>
                <span class="number">{{ api_data['sum'] | pretty_number }}</span>
            </div>
        </div>
    </div>
</template>

<style lang="scss" type="text/scss" scoped>

    .list-head.carbon{
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        .title{
            flex-grow: 1;
        }
        .toggle{
            //text-align: right;
        }
    }

</style>


<script>
import base from '../../../components/_base.mixin';

export default {

    mixins: [base],

    props: {
        title: {
            type: String,
            default: null
        },
        unit: {
            type: String,
            default: '[t/ha]'
        },
        api_data: {
            type: Object,
            default: () => {}
        },
        layer: {
            type: Object,
            default: () => null
        },
    }
}
</script>
