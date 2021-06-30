<template>
    <div>
        <dopa_indicators_table
                :title=soil_organic_carbon.title_table
                :indicators=soil_organic_carbon.indicators
                :api_data=api_data
        ></dopa_indicators_table>
    </div>

</template>


<script>

    import base from '../../../components/_base.mixin';

    export default {
        mixins: [base],
        data: function () {
            return {
                soil_organic_carbon: {
                    title_table: 'Amount of soil organic carbon (0-30 cm depth)',
                    indicators: [
                        {
                            field: 'gsoc_min_c_mg_total',
                            label: 'Min. [Mg]'
                        },
                        {
                            field: 'gsoc_mean_c_mg_total',
                            label: 'Mean [Mg]'
                        },
                        {
                            field: 'gsoc_max_c_mg_total',
                            label: 'Max. [Mg]'
                        },
                        {
                            field: 'gsoc_stdev_c_mg_total',
                            label: 'Std. Dev. [Mg]'
                        },
                        {
                            field: 'gsoc_tot_c_pg_total',
                            label: 'Sum [Pg]'
                        },
                    ]
                }
            }
        }

    }
</script>
