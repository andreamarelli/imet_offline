<template>

    <div>
        <table class="lines">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Surperficie Km <sup>2</sup></th>
                    <th>Ecorégion dans le pays</th>
                    <th>Ecorégions protégés dans le pays</th>
                    <th>Contribution du pays au plan global</th>
                    <th>Ecorégions protégés au plan international</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in ecoregions_stats">
                    <td>
                        {{ item.ecoregion }}
                    </td>
                    <td>
                        {{ item.area_km2| pretty_number }}
                    </td>
                    <td>
                        <progress_bar :percentage=item.percentage_of_ecoregion_in_country :digit=1 :dark=true></progress_bar>
                    </td>
                    <td>
                        <progress_bar :percentage=item.percentage_of_ecoregion_protected_in_country :digit=1 :dark=true></progress_bar>
                    </td>
                    <td>
                        <progress_bar :percentage=item.country_contribution_to_global_ecoregion_protection :digit=1 :dark=true></progress_bar>
                    </td>
                    <td>
                        <progress_bar :percentage=item.ecoregion_protection_percentage :digit=1 :dark=true></progress_bar>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</template>


<script>

    import base from '../../../components/_base.mixin';

    export default {
        mixins: [base],
        props: {
            marine : {
                type: Boolean,
                default: false
            }
        },
        computed: {
            ecoregions_stats: function () {
                let _this = this;
                return this.api_data.filter(function (item) {
                    return item.is_marine === _this.marine;
                });
            }
        }
    }
</script>