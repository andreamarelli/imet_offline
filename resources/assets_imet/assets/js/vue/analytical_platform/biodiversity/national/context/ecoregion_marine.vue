<template>

    <div>
        <table class="lines">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Surperficie Km <sup>2</sup></th>
                    <th>% Ecorégion dans le pays</th>
                    <th>% Ecorégions protégés dans le pays</th>
                    <th>% de contribution du pays au plan global</th>
                    <th>% D'Ecorégions protégés au plan international</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in ecoregions_stats">
                    <td v-if="item.is_marine">
                        {{ item.ecoregion }}
                    </td>
                    <td v-if="item.is_marine">
                        {{ item.area_km2 | pretty_number }}
                    </td>
                    <td v-if="item.is_marine">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped" aria-valuemin="0"
                                 :style="{ width: Math.abs(item.percentage_of_ecoregion_in_country) + '%', backgroundColor: '#87c89b'}">
                                {{ item.percentage_of_ecoregion_in_country }} %
                            </div>
                        </div>
                    </td>
                    <td v-if="item.is_marine">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped" aria-valuemin="0"
                                 :style="{ width: Math.abs(item.percentage_of_ecoregion_protected_in_country) + '%', backgroundColor: '#87c89b'}">
                                {{ item.percentage_of_ecoregion_protected_in_country }} %
                            </div>
                        </div>
                    </td>
                    <td v-if="item.is_marine">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped" aria-valuemin="0"
                                 :style="{ width: Math.abs(item.country_contribution_to_global_ecoregion_protection) + '%', backgroundColor: '#87c89b'}">
                                {{ item.country_contribution_to_global_ecoregion_protection }} %
                            </div>
                        </div>
                    </td>
                    <td v-if="item.is_marine">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped" aria-valuemin="0"
                                 :style="{ width: Math.abs(item.ecoregion_protection_percentage) + '%', backgroundColor: '#87c89b'}">
                                {{ item.ecoregion_protection_percentage }} %
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</template>


<script>
    export default {
        props: {
            ecoregions_stats: {
                type: [Array, Object],
                default: () => null
            },
        }
    }
</script>