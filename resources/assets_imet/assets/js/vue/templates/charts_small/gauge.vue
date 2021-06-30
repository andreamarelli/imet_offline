<template>

    <div class="gauge">
        <svg viewBox="0 0 36 36" :class=color>
            <path class="circle-bg" d="M18 2.0845a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"></path>
            <path class="circle" :stroke-dasharray="parseInt(value_percentage).toString() + ', 100'"
                  d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"></path>
            <text x="50%" y="58%" class="percentage">{{ parseInt(value_percentage).toString() }}%</text>
        </svg>
    </div>

</template>

<style lang="scss" type="text/scss" scoped>

    @import "../../../../sass/abstracts/all";

    .gauge{
        width: 45px;
        display: inline-block;
        @include text-lg;

        >svg {

            display: block;
            margin: 0 auto;
            max-width: 100%;

            .circle-bg {
                fill: none;
                stroke: $lightestGray;
                stroke-width: 4.8;
            }

            .circle {
                fill: none;
                stroke: $darkestGray;
                stroke-width: 4.8;
                animation: progress 1s ease-out forwards;
            }

            .percentage {
                fill: $darkestGray;
                font-size: 0.6em;
                letter-spacing: -0.2px;
                text-anchor: middle;
                font-weight: bold;
            }

            &.green{
                .circle-bg {
                    stroke: $lightestGreen;
                }
                .circle {
                    stroke: $baseGreen;
                }
                .percentage{
                    fill: $baseGreen;
                }
            }

            &.yellow{
                .circle-bg {
                    stroke: $contextual-light-warning;
                }
                .circle {
                    stroke: $contextual-warning;
                }
                .percentage{
                    fill: $contextual-warning;;
                }
            }

            &.red{
                .circle-bg {
                    stroke: $lightRed;
                }
                .circle {
                    stroke: $darkRed;
                }
                .percentage{
                    fill: $darkRed;
                }
            }

        }
    }

    @keyframes progress {
        0% {
            stroke-dasharray: 0 100;
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
            integer: {
                type: Boolean,
                default: false
            },
            gradient: {
                type: Boolean,
                default: false
            }
        },
        computed: {
            color(){
                if(this.gradient){
                    let percentage = this.value_percentage;
                    if(percentage<35){
                        return 'red';
                    } else if(percentage>=35 && percentage<75){
                        return 'yellow';
                    }
                }
                return 'green';
            },
            value_percentage(){
                return this.percentage>0
                    ? (this.integer ? parseInt(this.percentage) : parseFloat(this.percentage).toFixed(1))
                    : 0;
            }
        }
    }
</script>
