<template>

    <div class="layer-card">

        <div class="layer-card__header">

            <!-- title -->
            <div class="layer-card__label">{{ layer.label }}</div>

            <!-- info toggle -->
            <i v-if="has_info && with_info_toggle"
               class="fas fa-info-circle"
               :class="{ active: is_info_visible }"
               @click=toggleAbstract></i>

        </div>

        <div class="layer-card__body" v-show="has_info && (is_info_visible || !with_info_toggle)">

            <!-- abstract -->
            <div class="layer-card__abstract"
                 v-if="has_abstract"
                 v-html="decodeURI(layer.abstract)"></div>

            <!-- legend -->
            <div class="layer-card__legend" v-if="has_legend && legend_with_labels">
                <div class="legend__item" v-for="item in layer.legend">
                    <div class="legend__color" :style="'background-color: ' + item.color"></div>
                    <div class="legend__label" >{{ item.label }}</div>
                </div>
            </div>
            <div class="layer-card__legend palette" v-if="has_legend && !legend_with_labels">
                <div class="legend__item" v-for="item in layer.legend">
                    <div class="legend__color" :style="'background-color: ' + item"></div>
                </div>
            </div>

        </div>

    </div>

</template>

<style lang="scss" type="text/scss" scoped>

    @import "../../../../../sass/abstracts/all";

    .layer-card{

        display: flex;
        flex-direction: column;
        width: 100%;

        font-weight: normal;

        .layer-card__header{
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-content: center;

            i.fas{
                color: $baseBlue;
                &:hover{
                    cursor: pointer;
                }
            }
        }

        .layer-card__label{
            @include text-base;
            color: $baseGreen;
        }

        .layer-card__abstract{
            @include text-xs;
            display: block;
            margin-top: 5px;
        }

        .layer-card__legend{

            @include text-xs;
            margin-top: 5px;

            .legend__item{
                display: flex;
                margin-bottom: 3px;
                align-items: center;
                .legend__color{
                    margin-right: 3px;
                    padding: 7px;
                    height: 1px;
                }
                .legend__label{
                    font-weight: normal;
                    font-style: italic;
                    line-height: 1.1em;
                }
            }
            &.palette{
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0;
                .legend__color{
                    margin-right: 3px;
                }
            }
        }

    }

</style>


<script>
export default {

    props: {
        layer: {
            type: Object,
            default: () => {}
        },
        with_info_toggle: {
            type: Boolean,
            default: true,
        }
    },

    data: function (){
        return {
            is_info_visible: false,
            has_info: false,
            has_abstract: false,
            has_legend: false,
            legend_with_labels: false

        }
    },

    beforeMount() {
        this.has_abstract = this.layer.hasOwnProperty('abstract') && this.layer.abstract!==null;
        this.has_legend =this.layer.hasOwnProperty('legend') && this.layer.legend!==null;
        if(this.has_legend){
            this.legend_with_labels = typeof this.layer.legend[0] === 'object';
        }
        this.has_info = this.has_abstract || this.has_legend;
    },

    methods: {

        toggleAbstract(){
            this.is_info_visible = !this.is_info_visible;
        }

    }

}
</script>
