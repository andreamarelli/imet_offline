<template>

    <div>
        <data_year :year=api_data.quota_last_year></data_year>
        <table class="lines">
            <thead>
                <tr>
                    <th>{{ Locale.getLabel('mapping.platform.cards.biodiversity.national.sections.species.species_an') }}</th>
                    <th>{{ Locale.getLabel('mapping.platform.cards.biodiversity.national.sections.species.quotas') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in api_data.quota">
                    <td>
                        {{ name(index) }}
                    </td>
                    <td >
                        {{ item | pretty_number }}
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
        methods:{
            name: function(item){
                if(item.includes("|")){
                    let taxonomy = item.split('|');
                    return  taxonomy[4] + ' ' + taxonomy[5];
                }
                return item
            }
        }
    }
</script>