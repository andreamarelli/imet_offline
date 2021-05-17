<template>

    <div>
        <div class="content">

            <data_year :year=api_data.last_year></data_year>
            <div class="convergence-plan-2col-indicator">
                <div>
                    <span class="txt">
                        Au moins <span class="highlighted">02</span> <span class="highlighted">documents de plaidoyer</span> adoptés de manière concertée et prenant en compte les intérêts des groupes vulnérables sont produits par pays annuellement
                    </span>
                </div>

                <div>
                    <gauge_cp  :percentage=api_data.percentage></gauge_cp>
                    <span class="number">{{ api_data.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                        <country_list :api_data=api_data.eligible_country ></country_list>
                        <data_driven_layer_toggle
                            method="country_advocacy_documents_adopted"
                            title="Pays dans lesquels au moins 02 documents de plaidoyer adoptés de manière concertée et prenant en compte les intérêts des groupes vulnérables sont produits annuellement"
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
