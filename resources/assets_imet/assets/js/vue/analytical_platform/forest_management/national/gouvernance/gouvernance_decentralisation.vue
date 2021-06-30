<template>

    <div>

        <div class="list-key-numbers">
            <div>
                <div class="content">

                    <span class="two_columns">
                        <span>{{ Locale.getLabel('mapping.common.decentralized_management') }}:</span>
                        <span>
                            <span v-if="api_data.decentralized_instrument.not_applicable">{{ Locale.getLabel('mapping.common.not_applicable') }}</span>
                            <i v-else class="fas text-base" :class="[api_data.decentralized_instrument.available ? 'fa-check-circle green_base' : 'fa-times-circle red_base']"></i>
                        </span>
                    </span>

                    <span class="two_columns">
                        <span>Instruments de développement local:</span>
                        <span>
                            <span v-if="api_data.infrastructure.not_applicable">{{ Locale.getLabel('mapping.common.not_applicable') }}</span>
                            <span v-else>{{ api_data.infrastructure.number | pretty_number }}</span>
                        </span>
                    </span>

                    <span class="two_columns">
                        <span>{{ Locale.getLabel('mapping.common.local_development') }}:</span>
                        <span>
                            <span v-if="api_data.local_initiative.not_applicable">{{ Locale.getLabel('mapping.common.not_applicable') }}</span>
                            <span v-else>{{ api_data.local_initiative.number | pretty_number }}</span>
                        </span>
                    </span>

                </div>

            </div>
        </div>

    </div>

</template>


<style lang="scss" type="text/scss" scoped>
    .list-key-numbers{
        width: 500px;
    }
</style>

<script>

    import base from '../../../components/_base.mixin';

    export default {
        mixins: [base]
    }
</script>
