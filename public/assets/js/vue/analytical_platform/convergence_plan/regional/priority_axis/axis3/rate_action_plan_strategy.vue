<template>

    <div>
        <div class="content">
            <span>
                D'ici <span class="highlighted">2025</span>, au moins <span class="highlighted">50%</span> des résultats du <span class="highlighted">plan d’action sous régional et des stratégies nationales de gestion et de valorisation</span> des AP sont atteints.
            </span>

            <div class="rate_action">
                <div class="rate_action__content">
                    <span><span class="highlighted">Régional</span></span>
                    <data_year :year=api_data.regional_last_year></data_year>
                    <gauge_cp :percentage=api_data.regional_percentage></gauge_cp>
                </div>
                <div class="rate_action__content">
                    <span><span class="highlighted">National</span></span>
                    <data_year :year=api_data.last_year></data_year>
                    <gauge_cp  :percentage=api_data.percentage></gauge_cp>
                    <span class="number">{{ api_data.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                        <country_list :api_data=api_data.eligible_country ></country_list>
                        <data_driven_layer_toggle
                            method="country_rate_action_plan_strategy"
                            title="Pays dont au moins 50% des résultats du Plan d’action et des stratégies nationales de gestion et de valorisation des AP sont atteints"
                            :api_data=api_data.eligible_country
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
    .rate_action {
        display : flex;
        justify-content: space-around;
        &__content {
            display : flex;
            flex-direction : column;

        }
    }
</style>
