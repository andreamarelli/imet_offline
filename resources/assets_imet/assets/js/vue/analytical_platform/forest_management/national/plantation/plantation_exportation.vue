<template>

    <div>
        
            <div class="list-key-numbers" v-if="api_data.export.not_applicable">
                <div>
                    <div class="content">
                        <span class="number">{{ Locale.getLabel('mapping.common.not_applicable') }}</span>
                    </div>
                </div>
            </div>
        
            <div class="list-key-numbers" v-else>
                <div>
                    <div class="content">
                        <span class="number">{{api_data.export.volume | pretty_number  }} m<sup>3</sup></span>
                    </div>
                    <gauge :percentage=api_data.export.percent />
                </div>
            </div>

    </div>

</template>


<script>

    import base from '../../../components/_base.mixin';

    export default {
        mixins: [base]
    }
</script>

