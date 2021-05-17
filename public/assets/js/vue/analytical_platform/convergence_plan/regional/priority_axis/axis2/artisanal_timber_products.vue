<template>
            <div>
                <div class="content">
                    <data_year :year=api_data.last_year></data_year>
                    <div class="convergence-plan-2col-indicator">
                        <div>
                            <span class="txt">
                                D'ici <span class="highlighted">2020</span>, au moins <span class="highlighted">07</span> pays d'Afrique Centrale disposent dispose d’une <span class="highlighted">stratégie d’organisation des filières artisanales du bois et autres produits forestiers non ligneux</span>.
                            </span>
                        </div>


                        <div>
                            <gauge_cp  :percentage=api_data.percentage></gauge_cp>
                            <span class="number">{{ api_data.eligible_country.length || '-' }} / 10</span>
                            <span class="txt">
                                <country_list :api_data=api_data.eligible_country ></country_list>
                                <data_driven_layer_toggle
                                    method="country_artisanal_timber_products"
                                    title="Pays disposant d’une stratégie d’organisation des filières artisanales du bois et autres produits forestiers non ligneux"
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
