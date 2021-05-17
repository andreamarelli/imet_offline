<template>

    <div>
        <data_year :year=api_data.fauna_last_year> </data_year>
        <table class="lines">
            <thead>
                <tr>
                    <th>{{ Locale.getLabel('mapping.platform.cards.biodiversity.national.sections.species.species_an') }}</th>
                    <th>{{ Locale.getLabel('mapping.platform.cards.biodiversity.national.sections.species.number_ap') }}</th>
                    <th>{{ Locale.getLabel('mapping.platform.cards.biodiversity.national.sections.species.iucn_status') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in api_data.fauna">
                    <td>
                        <b> {{ name(item.species) }}</b>
                        <i>{{index}}</i>
                    </td>
                    <td >
                        {{ item.number }}
                    </td>
                    <td >
                        {{ item.category_iucn }}
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