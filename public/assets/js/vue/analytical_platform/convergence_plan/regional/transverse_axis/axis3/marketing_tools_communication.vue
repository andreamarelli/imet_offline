<template>

    <div>
        <div class="content">

            <span> 
                D’ici <span class="highlighted">2020</span>, la COMIFAC et les organisations sous-régionales ont développés au-moins <span class="highlighted">05 outils de marketing </span> et <span class="highlighted">10 supports de communication</span>  sur le Plan de convergence et ses réalisations.
            </span>
            <data_year :year=api_data.last_year></data_year>
            <div class="regional_tool_marketing">
                <div class="regional_tool_marketing__content">
                    <span><span class="highlighted">Outils de marketing</span></span>
                    <gauge_cp  :percentage=api_data.percentage_marketing_tools></gauge_cp>

                </div>
                <div class="regional_tool_marketing__content">
                    <span><span class="highlighted">Supports de com.</span></span>
                    <gauge_cp  :percentage=api_data.percentage_communication_media></gauge_cp>

                </div>
                
            </div>



        </div>
    </div>



</template>


<script>

    import base from '../../../../components/_base.mixin';

    export default {

        mixins: [
            base,
        ],

        data: function () {
            return {
                baseUrl: window.Laravel.baseUrl
            }
        }
    }
</script>

<style lang="scss" type="text/scss" scoped>
    .regional_tool_marketing {
            display : flex;
            justify-content: space-around;
            &__content {
                display : flex;
                flex-direction : column;
                 justify-content: space-between;
                
            }
    }
</style>