
<template>

    <div>
        <div class="content">
            <div class="convergence-plan-2col-indicator">

                <div>
                    <span class="txt">
                        D’ici <span class="highlighted">2025</span> ,<span class="highlighted">la superficie des Aires Protégées (AP)</span> a augmenté de  <span class="highlighted">5%</span> au moins dans chaque pays.
                    </span>
                </div>


                <div>
                    <gauge_cp  :percentage=api_data.percentage></gauge_cp>
                    <span class="number">{{ api_data.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                        <country_list :api_data=api_data.eligible_country ></country_list>
                        <data_driven_layer_toggle
                            method="country_pa"
                            title="Pays dont la superficie des Aires Protégées (AP) a augmenté de 5%"
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
