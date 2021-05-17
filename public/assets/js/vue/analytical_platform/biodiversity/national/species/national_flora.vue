<template>

    <div>
        <data_year :year=api_data.flora_last_year> </data_year>
        <table class="lines">
            <thead>
                <tr>
                    <th>{{ Locale.getLabel('mapping.platform.cards.biodiversity.national.sections.species.species_an') }}</th>
                    <th>{{ Locale.getLabel('mapping.platform.cards.biodiversity.national.sections.species.number_ap') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in api_data.flora">
                    <td>
                        {{ index }}
                    </td>
                    <td >
                        {{ item }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</template>

<script>

    import base from '../../../components/_base.mixin';

    export default {
        mixins: [base]
    }
</script>