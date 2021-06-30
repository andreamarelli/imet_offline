<template>

    <div>

        <div v-if="Array.isArray(api_data) && api_data.length">
            <table class="lines">
                <thead>
                    <tr>
                        <th>{{ Locale.getLabel('mapping.common.tax_designation') }}</th>
                        <th>{{ Locale.getLabel('mapping.common.amount_to_be_collected') }} US$</th>
                        <th>{{ Locale.getLabel('mapping.common.amount_recovered') }} US$</th>
                        <th>{{ Locale.getLabel('mapping.common.recovery_rate') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in api_data">
                        <td>
                             {{ item.designation }}
                        </td>
                        <td>
                            {{ item.montant_a_percevoir | pretty_number }}
                        </td>
                        <td>
                            {{ item.montant_recouvre | pretty_number }}
                        </td>
                        <td>
                            {{ item.taux_recouvrement }}
                        </td>
                    </tr>
               </tbody>
            </table>
        </div>

    </div>

</template>

<script>

    import base from '../../../components/_base.mixin';

    export default {
        mixins: [base]
    }
</script>