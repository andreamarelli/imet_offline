<template>

    <div>

        <div class="list-key-numbers">

            <div>
                <div class="content">
                    <span class="two_columns">
                        <span>{{ Locale.getLabel('mapping.common.plan_status') }}</span>
                        <span>{{ api_data.status_management }}</span>
                    </span>
                    <span class="two_columns">
                        <span>{{ Locale.getLabel('mapping.common.date') }}</span>
                        <span>{{ api_data.date_approval_management }}</span>
                    </span>
                    <span class="two_columns">
                        <span>{{ Locale.getLabel('mapping.common.rotation_time') }}</span>
                        <span>{{ api_data.rotation_time }}</span>
                    </span>
                    <span v-if="api_data.download_link_management!==null">
                         <a target="_blank" :href=api_data.download_link_management>
                             <i class="fas fa-file"></i>
                             {{ Locale.getLabel('mapping.common.management_plan') }} 
                         </a>
                    </span>
                </div>
            </div>

            <div>
                <div class="content">
                    <span class="two_columns">
                        <span>{{ Locale.getLabel('mapping.common.convention') }} </span>
                        <span>{{ api_data.status_convention }}</span>
                    </span>
                    <span class="two_columns">
                        <span>{{ Locale.getLabel('mapping.common.date') }} </span>
                        <span>{{ api_data.date_convention }}</span>
                    </span>
                </div>
            </div>

        </div>

        <div class="list-key-numbers" style="margin-top: 20px;">
            <div class="list-head">{{ Locale.getLabel('mapping.common.annual_cutting_plate') }}</div>
            <div v-for="item in api_data.annual_plate">
                <div class="content">
                    <span class="number">{{ item.year }}</span>
                    <span class="two_columns">
                        <span>{{ Locale.getLabel('mapping.common.areas') }}</span>
                        <span>{{ item.area | pretty_number  }} ha</span>
                    </span>
                    <span class="two_columns">
                        <span>{{ Locale.getLabel('mapping.common.opening') }}</span>
                        <span>{{ item.opening_date || '-' }}</span>
                    </span>
                    <span class="two_columns">
                        <span>{{ Locale.getLabel('mapping.common.duration') }}</span>
                        <span>{{ item.duration || '-' }}</span>
                    </span>
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
