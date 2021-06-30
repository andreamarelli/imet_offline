<template>

    <div>     
        <div class="list-key-numbers">
            <div>
                <div class="content">
                    <span class="txt">{{ Locale.getLabel('mapping.common.total') }}</span>
                    <span class="number">{{ api_data.forest_concessions.total_number | pretty_number }}</span>
                    <span class="txt">{{ api_data.forest_concessions.total_area | pretty_number }} ha</span>
                </div>
            </div>
            <div>
                <div class="content">
                    <span class="txt">{{ Locale.getLabel('mapping.common.attributed') }}</span>
                    <span class="number">{{ api_data.forest_concessions.assigned_number | pretty_number }}</span>
                    <span class="txt">{{ api_data.forest_concessions.allocated_area | pretty_number }} ha</span>
                </div>
            </div>
            <div>
                <div class="content">
                    <span class="txt">{{ Locale.getLabel('mapping.common.planning') }}</span>
                    <span class="number">
                            {{ api_data.forest_concessions.development_area | pretty_number }} ha
                            <br />
                            ({{ api_data.forest_concessions.development_area_percent | pretty_number }}%) aménagés
                        </span>
                </div>
            </div>
            <div>
                <div class="content">
                    <span class="txt">{{ Locale.getLabel('mapping.common.durability') }}</span>
                    <span class="number">
                            {{ api_data.forest_concessions.durability_area | pretty_number }} ha
                            <br />
                            ({{ api_data.forest_concessions.durability_area_percent | pretty_number }}%) certifiés
                        </span>
                </div>
            </div>
            <div>
                <div class="content">
                    <span class="txt">{{ Locale.getLabel('mapping.common.legality') }}</span>
                    <span class="number">
                            {{ api_data.forest_concessions.legality_area | pretty_number }} ha
                            <br />
                            ({{ api_data.forest_concessions.legality_area_percent | pretty_number }}%) certifiés
                        </span>
                </div>
            </div>
        </div>

        <br />
        <data_source :source=api_data.forest_concessions_chart.source></data_source>
        <chart_lines_and_pie
            title="Aménagement national"
            :input_data=api_data.forest_concessions_chart.data
            unit="ha"
        ></chart_lines_and_pie>

        <br />

        <div v-if="Array.isArray(api_data.forest_concessions.durability_details) && api_data.forest_concessions.durability_details.length">
            <table class="lines">
                <thead>
                    <tr>
                        <th>{{ Locale.getLabel('mapping.common.concession_name') }}</th>
                        <th>{{ Locale.getLabel('mapping.common.concessionaire_name') }}</th>
                        <th>{{ Locale.getLabel('mapping.common.certified_area') }}</th>
                        <th>{{ Locale.getLabel('mapping.common.sustainability_certificate') }}</th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="item in api_data.forest_concessions.durability_details">
                        <td>
                            {{ item.name_concession }}
                        </td>
                        <td>
                            {{ item.name_concessionnaire }}
                        </td>
                        <td>
                            {{ item.superficie | pretty_number }}
                        </td>
                        <td>
                            {{ item.certificat }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div v-if="Array.isArray(api_data.forest_concessions.legality_details) && api_data.forest_concessions.legality_details.length">
            <table class="lines">
                <thead>
                    <tr>
                        <th>{{ Locale.getLabel('mapping.common.concession_name') }}</th>
                        <th>{{ Locale.getLabel('mapping.common.concessionaire_name') }}</th>
                        <th>{{ Locale.getLabel('mapping.common.certified_area') }}</th>
                        <th>{{ Locale.getLabel('mapping.common.legality_certificate') }}</th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="item in api_data.forest_concessions.legality_details">
                        <td>
                            {{ item.name_concession }}
                        </td>
                        <td>
                            {{ item.name_concessionnaire }}
                        </td>
                        <td>
                            {{ item.superficie | pretty_number }}
                        </td>
                        <td>
                            {{ item.certificat }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>


    </div>

</template>


<style lang="scss" type="text/scss" scoped>

    @import "../../../../../../sass/abstracts/all";

    .list-key-numbers{
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        div:first-child{
            grid-column-end: 3 span;
        }
        div:nth-child(2){
            border-top: 1px dashed $lightGray;
            grid-column-end: 3 span;
        }
        div:nth-child(3),
        div:nth-child(4),
        div:nth-child(5){
            grid-column-end: 2 span;
        }
    }
</style>

<script>

    import base from '../../../components/_base.mixin';

    export default {
        mixins: [base]
    }
</script>

