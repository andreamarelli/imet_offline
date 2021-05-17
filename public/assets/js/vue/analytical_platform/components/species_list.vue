<template>

    <div>
        <table class="lines">
            <thead>
            <tr>
                <th></th>
                <th>{{ Locale.getLabel('entities.biodiversity.taxonomy.species') }}</th>
                <th>{{ Locale.getLabel('entities.biodiversity.taxonomy.family') }}</th>
                <th>{{ Locale.getLabel('entities.biodiversity.taxonomy.order') }}</th>
                <th>{{ Locale.getLabel('entities.biodiversity.taxonomy.class') }}</th>
                <th>Statut</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in filtered_list">
                <td>
                    <redlist_link :redlist_id='item.id_no || item.iucn_species_id' />
                </td>
                <td>
                    {{ item.binomial || item.taxon }}
                </td>
                <td>
                    {{ item.family }}
                </td>
                <td>
                    {{ item.order }}
                </td>
                <td>
                    {{ item.class || item._class }}
                </td>
                <td>
                    <redlist_category :category=item.code :compact=true />
                </td>
            </tr>
            </tbody>
        </table>
    </div>

</template>


<script>

    import base from './_base.mixin';

    export default {
        mixins: [base],

        props: {
            codes: {
                type: [String, Array],
                default: () => null
            },
        },

        computed:{
            filtered_list: function () {
                let _this = this;
                if(this.codes===null){
                    return this.api_data;
                }
                let codes = typeof this.codes === 'string' ? [this.codes] : this.codes;
                return this.api_data.filter(function (item) {
                    return codes.includes(item.code);
                });
            },
            count: function () {
                return this.filtered_list.length;
            }
        }
    }
</script>