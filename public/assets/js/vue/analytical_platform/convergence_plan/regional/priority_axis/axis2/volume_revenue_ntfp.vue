<template>
    <div>
        <div class="content">

            <span>
                D’ici <span class="highlighted">2025</span>, le <span class="highlighted">volume des recettes issus des PFNL et des filières artisanales</span> a augmenté d’au moins <span class="highlighted">25%</span> dans chaque pays d’Afrique Centrale.
            </span>

            <div class="volume_ntfp">
                <div class="volume_ntfp__content">
                    <span>
                        <span class="highlighted">PFNL</span>
                    </span>
                    <data_year :year=api_data.last_year></data_year>
                    <gauge_cp  :percentage=api_data.percentage ></gauge_cp>
                    <span class="number">{{ api_data.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                        <country_list :api_data=api_data.eligible_country ></country_list>
                        <data_driven_layer_toggle
                            method="country_volume_revenue_ntfp"
                            title="Pays dont le volume des recettes issus des PFNL a augmenté de 25%"
                            :api_data=api_data.eligible_country
                            ></data_driven_layer_toggle>
                    </span>
                </div>

                <div class="volume_ntfp__content">
                    <span>
                        <span class="highlighted">Filières artisanales</span>
                    </span>
                    <data_year :year=api_data.artisanal_last_year></data_year>
                    <gauge_cp  :percentage=api_data.artisanal_percentage ></gauge_cp>
                    <span class="number">{{ api_data.artisanal_eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                        <country_list :api_data=api_data.artisanal_eligible_country ></country_list>
                        <data_driven_layer_toggle
                            method="country_volume_artisanal"
                            title="Pays dont le volume des recettes issus des filières artisanales a augmenté de 25%"
                            :api_data=api_data.artisanal_eligible_country
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
    .volume_ntfp {
        display : flex;
        justify-content: space-around;
        &__content {
            display : flex;
            flex-direction : column;

        }
    }
</style>
