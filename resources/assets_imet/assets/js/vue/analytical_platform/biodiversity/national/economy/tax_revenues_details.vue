<template>

    <table class="lines">
        <thead>
            <tr>
                <th>{{ Locale.getLabel('mapping.common.designation') }} </th>
                <th>{{ Locale.getLabel('mapping.common.amount_recovered') }} (USD)</th>
                <th>{{ Locale.getLabel('mapping.common.percentage_returned') }} </th>
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