<template>
    <div>
        <data_year :year=api_data.list_monitoring_last_year></data_year>
        <table class="lines">
            <tbody>
            <tr v-for="(item, index) in api_data.list_monitoring">
                <td >
                    {{ index }}
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
        mixins: [base]
    }
</script>