<template>

    <div>
        <div class="list-key-numbers" v-if="api_data.area.not_applicable">
            <div>
                <div class="content">
                    <span class="number">{{ Locale.getLabel('mapping.common.not_applicable') }}</span>
                </div>
            </div>
        </div>
        
        
        <div class="list-key-numbers grid_two_cols" v-else>

            <div>
                <div class="content">
                    <span class="text green_base">{{ Locale.getLabel('mapping.common.forestry') }}</span>
                    <span class="number">{{api_data.area.forest | pretty_number  }} ha</span>
                </div>
            </div>
            <div>
                <div class="content">
                    <span class="text green_base">{{ Locale.getLabel('mapping.common.agro_forestry') }}</span>
                    <span class="number">{{api_data.area.agroforestry | pretty_number  }} ha</span>
                </div>
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
