<template>
            <div>
                <div class="content">

                    <data_year :year=api_data.last_year></data_year>
                    <div class="convergence-plan-2col-indicator">
                        <div>
                            <span class="txt">
                                Au moins <span class="highlighted">50%</span> des <span class="highlighted"> opérateurs des filières artisanales et PFNL</span> sont regroupés et encadrés à travers des stratégies nationales appropriées dans
                                au moins <span class="highlighted">07</span> pays d'Afrique Centrale d'ici <span class="highlighted">2025</span>.
                            </span>
                        </div>

                        <div>
                            <gauge_cp  :percentage=api_data.percentage></gauge_cp>
                            <span class="number">{{ api_data.eligible_country.length || '-' }} / 10</span>
                            <span class="txt">
                                <country_list :api_data=api_data.eligible_country ></country_list>
                                <data_driven_layer_toggle
                                    method="country_grouping_artisanal_operators"
                                    title="Pays dont au moins 50% des opérateurs des filières artisanales et PFNL sont regroupés et encadrés à travers des stratégies nationales appropriées"
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
