<template>

    <div class="pgr-bar">

        <div v-if="showLimits" class="pgr-bar__limit-left">{{ min }}%</div>

        <!-- bootstrap progress bar -->
        <div class="pgr-bar__bar progress">
            <div class="progress-bar progress-bar-striped" role="progressbar"
                 :style=style>
                <span v-if="value!==null">{{ value }} %</span>
            </div>
        </div>

        <div v-if="showLimits" class="pgr-bar__limit-right">{{ max }}%</div>

    </div>

</template>

<style lang="scss" scoped>

    .pgr-bar{
        font-size: 10px;
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;

        .pgr-bar__bar{
            flex-grow: 1;
        }
        .pgr-bar__limit-left{
            width: 30px;
            text-align: right;
            padding-right: 3px;
        }
        .pgr-bar__limit-right{
            width: 30px;
            text-align: left;
            padding-left: 3px;
        }
    }

</style>

<script>
    export default {
        name: "progress_bar",

        props: {
            value: {
                value: Number,
                default: 0
            },
            color: {
                value: String,
                default: '#ccc'
            },
            showLimits: {
                value: Boolean,
                default: true
            },
            min: {
                value: Number,
                default: 0
            },
            max: {
                value: Number,
                default: 100
            },
        },

        computed:{
            width(){
                return Math.abs(this.value);
            },
            style(){
                return 'width: ' +  this.width + '%; backgroundColor: ' + this.color + ' !important;';
            }
        }

    }
</script>
