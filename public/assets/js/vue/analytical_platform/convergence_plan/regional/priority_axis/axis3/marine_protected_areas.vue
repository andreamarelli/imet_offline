<template>

    <div>
        <div class="content">

            <data_year :year=api_data.last_year></data_year>

            <div class="convergence-plan-2col-indicator">
                <div>
                    <span class="txt">
                        D'ici <span class="highlighted">2025</span> le nombre d’aires protégées marines, côtières, mangroves et de zones humides dotées des programmes de suivi et de gestion conformes aux orientations sous-régionales et internationales a doublé dans chaque pays d’Afrique centrale.
                    </span>
                </div>

                <div>
                    <gauge_cp  :percentage=api_data.percentage></gauge_cp>
                    <span class="number">{{ api_data.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                        <country_list :api_data=api_data.eligible_country ></country_list>
                        <data_driven_layer_toggle
                            method="country_marine_protected_areas"
                            title="Pays dont le nombre d’aires protégées marines, côtières, mangroves et de zones humides dotées des programmes de suivi et de gestion conformes aux orientations sous-régionales et internationales a doublé"
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
