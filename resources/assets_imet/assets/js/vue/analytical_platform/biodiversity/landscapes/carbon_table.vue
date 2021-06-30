<template>
    <div class="list-key-numbers horizontal">

        <div class="list-head" >
            {{ title }} {{ unit }}
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



<script>
import base from '../../components/_base.mixin';

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
    }
}
</script>
