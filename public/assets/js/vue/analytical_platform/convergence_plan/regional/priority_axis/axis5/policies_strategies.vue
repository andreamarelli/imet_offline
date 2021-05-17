<template>

    <div>
        <div class="content">
            <data_year :year=api_data.last_year></data_year>
            <div class="convergence-plan-2col-indicator">

                <div>
                    <span class="txt">
                        D’ici <span class="highlighted">2020</span>, toutes les <span class="highlighted">politiques et stratégies nationales et sous-régionales</span> concernant le secteur forestier-environnement intègrent explicitement les intérêts des femmes et des populations autochtones tels que recommandés par les plateformes de la CEFDHAC.
                    </span> <br>
                    <span>
                        <span class="highlighted">Politiques et stratégies sous-régionales</span>
                    </span>
                    <i class="fas text-base" :class="[api_data.existence ? 'fa-check-circle green_base' : 'fa-times-circle red_base']"></i>
                </div>

                <div>

                    <span>
                        <span class="highlighted">Politiques et stratégies nationales</span>
                    </span>
                    <gauge_cp  :percentage=api_data.percentage></gauge_cp>
                    <span class="number">{{ api_data.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                        <country_list :api_data=api_data.eligible_country ></country_list>
                        <data_driven_layer_toggle
                            method="country_policies_strategies"
                            title="Pays dont les politiques et stratégies nationales concernant le secteur forestier-environnement intègrent explicitement les intérêts des femmes et des populations autochtones"
                            :api_data=api_data.eligible_country
                            ></data_driven_layer_toggle>
                    </span>



                </div>

            </div>

<!--            <div class="policies_strategies">
                <div class="policies_strategies__content">
                    <span>
                        <span class="highlighted">Politiques et stratégies nationales</span>
                    </span>
                    <data_year :year=api_data.last_year></data_year>
                    <gauge_cp  :percentage=api_data.percentage></gauge_cp>
                    <span class="number">{{ api_data.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                        <country_list :api_data=api_data.eligible_country ></country_list>
                        <data_driven_layer_toggle
                            method="country_policies_strategies"
                            title="Pays dont les politiques et stratégies nationales concernant le secteur forestier-environnement intègrent explicitement les intérêts des femmes et des populations autochtones"
                            :api_data=api_data.eligible_country
                            ></data_driven_layer_toggle>
                    </span>

                </div>

                <div class="policies_strategies__content">



                </div>
            </div>-->

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

<!--<style lang="scss" type="text/scss" scoped>
     .policies_strategies{
        display : flex;
        justify-content: space-around;
        &__content {
            display : flex;
            flex-direction : column;

        }
    }
</style>-->
