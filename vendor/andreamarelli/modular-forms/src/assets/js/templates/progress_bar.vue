<template>

    <div class="progress" :class="[small ? 'progress-small' : '', dark ? 'progress-dark' : '']">
        <div class="progress-bar" role="progressbar" :aria-valuenow=value_percentage :style=progress_style aria-valuemin="0" aria-valuemax="100" >
            {{ value_percentage }}%{{ additional_label }}
        </div>
    </div>

</template>

<style lang="scss" scoped>

    @import "../.././sass/abstracts/all";
    .progress{
        margin-bottom: 0;
        border-radius: 2px;
        .progress-bar{
            background-color: $green-600;
            color: $white;
            font-weight: normal;
        }

        &.progress-small{
            height: 12px;
            .progress-bar {
                font-size: 10px;
                line-height: 14px;
            }
        }
        &.progress-dark{
            .progress-bar {
                color: $gray-800;
            }
        }
    }


</style>

<script>
    export default {
        props: {
            percentage: {
                type: [Number, String],
                default: () => 0
            },
            small: {
                type: Boolean,
                default: () => false
            },
            dark: {
                type: Boolean,
                default: () => false
            },
            color: {
                type: String,
                default: () => ''
            },
            additional_label: {
                type: String,
                default: () => ''
            },
            digit:  {
                type: Number,
                default: () => 2
            },
        },

        created() {
            this.value_percentage = this.percentage==null ? (0).toFixed(this.digit) : parseFloat(this.percentage).toFixed(this.digit);
        },

        computed:{
            progress_style(){
                let style = 'width: ' + parseInt(this.value_percentage).toString() + '%; ';
                style += this.color!==''
                    ? ' background-color: ' + this.color +';'
                    : '';
                return style;
            }
        }
    }
</script>

