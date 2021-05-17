<template>

    <div>
        <div class="content">
            <span>
                D’ici <span class="highlighted">2025</span>, chaque pays d’Afrique Centrale a développé au moins <span class="highlighted">02 outils de marketing</span> et <span class="highlighted">05 supports de communication</span> sur son programme forestier national arrimé au Plan de convergence.
            </span>
            <data_year :year=api_data.last_year></data_year>
            <div class="tool_marketing">
                <div class="tool_marketing__content">
                    <span><span class="highlighted">Outils de marketing</span></span>
                    <gauge_cp  :percentage=api_data.percentage_marketing></gauge_cp>
                    <span class="number">{{ api_data.eligible_country_marketing.length || '-' }} / 10</span>
                    <span class="txt">
                        <country_list :api_data=api_data.eligible_country_marketing ></country_list>
                        <data_driven_layer_toggle
                            method="country_data_marketing"
                            title="Pays ayant développé au moins deux outils de marketing sur son programme forestier national arrimé au Plan de convergence"
                            :api_data=api_data.eligible_country_marketing
                            ></data_driven_layer_toggle>
                    </span>

                </div>

                <div class="tool_marketing__content">
                    <span><span class="highlighted">Supports de com.</span></span>

                    <gauge_cp  :percentage=api_data.percentage_media></gauge_cp>
                    <span class="number">{{ api_data.eligible_country_media.length || '-' }} / 10</span>
                    <span class="txt">
                        <country_list :api_data=api_data.eligible_country_media ></country_list>
                        <data_driven_layer_toggle
                            method="country_data_media"
                            title="Pays ayant développé au moins cinq supports de communication sur son programme forestier national arrimé au Plan de convergence"
                            :api_data=api_data.eligible_country_media
                            ></data_driven_layer_toggle>
                    </span>

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
    .tool_marketing {
        display : flex;
        justify-content: space-around;
        &__content {
            display : flex;
            flex-direction : column;
            justify-content: space-between;

        }
    }
</style>
