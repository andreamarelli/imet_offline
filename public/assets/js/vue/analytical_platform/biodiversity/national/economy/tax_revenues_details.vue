<template>

    <table class="lines">
        <thead>
            <tr>
                <th>{{ Locale.getLabel('mapping.platform.cards.biodiversity.national.sections.economy.designation') }} </th>
                <th>{{ Locale.getLabel('mapping.platform.cards.biodiversity.national.sections.economy.amount_recovered') }} (USD)</th>
                <th>{{ Locale.getLabel('mapping.platform.cards.biodiversity.national.sections.economy.percentage_returned') }} </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in api_data">
                <td>{{ item.designation }}</td>
                <td>{{ item.montant_recouvre | pretty_number }}</td>
                <td>{{ item.pourcentage }}</td>
            </tr>
        </tbody>
    </table>

</template>

<script>

    import base from '../../../components/_base.mixin';

    export default {
        mixins: [base]
    }

</script>