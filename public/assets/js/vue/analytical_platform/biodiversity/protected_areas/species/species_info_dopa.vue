<template>

    <div>

        <table class="lines">
            <thead>
            <tr>
                <th>Class</th>
                <th>Species</th>
                <th>Menacée<br />(CR, EN, VU)</th>
                <th>
<!--                    {{ Locale.getLabel('entities.biodiversity.red_list_categories.CR') }}-->
                    <redlist_category category="CR" :compact=true />
                </th>
                <th>
<!--                    {{ Locale.getLabel('entities.biodiversity.red_list_categories.EN') }}-->
                    <redlist_category category="EN" :compact=true />
                </th>
                <th>
<!--                    {{ Locale.getLabel('entities.biodiversity.red_list_categories.VU') }}-->
                    <redlist_category category="VU" :compact=true />
                </th>
                <th>
<!--                    {{ Locale.getLabel('entities.biodiversity.red_list_categories.NT') }}-->
                    <redlist_category category="NT" :compact=true />
                </th>
                <th>
<!--                    {{ Locale.getLabel('entities.biodiversity.red_list_categories.LC') }}-->
                    <redlist_category category="LC" :compact=true />
                </th>
                <th>
<!--                    {{ Locale.getLabel('entities.biodiversity.red_list_categories.DD') }}-->
                    <redlist_category category="DD" :compact=true />
                </th>
            </tr>
            </thead>

            <tbody>
            <tr v-for="item in api_data">
                <td>
                    {{ item.class }}
                </td>
                <td>
                    {{ item.total_species }}
                </td>
                <td>
                    {{ item.threatened }}
                </td>
                <td>
                    {{ item.critically_endangered }}
                </td>
                <td>
                    {{ item.endangered }}
                </td>
                <td>
                    {{ item.vulnerable }}
                </td>
                <td>
                    {{ item.near_threatened }}
                </td>
                <td>
                    {{ item.least_concern }}
                </td>
                <td>
                    {{ item.data_deficient }}
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
