<template>
    <div>
        <dopa_indicators_table
                :title=above_ground_carbon.title_table
                :indicators=above_ground_carbon.indicators
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
                above_ground_carbon: {
                    title_table : 'Amount of above ground carbon',
                    indicators: [
                        {
                            field: 'agb_min_c_mg_total',
                            label: 'Min. [Mg]'
                        },
                        {
                            field: 'agb_mean_c_mg_total',
                            label: 'Mean [Mg]'
                        },
                        {
                            field: 'agb_max_c_mg_total',
                            label: 'Max. [Mg]'
                        },
                        {
                            field: 'agb_stdev_c_mg_total',
                            label: 'Std. Dev. [Mg]'
                        },
                        {
                            field: 'agb_tot_c_pg_total',
                            label: 'Sum [Pg]'
                        },
                    ]
                }
            }
        }

    }
</script>
