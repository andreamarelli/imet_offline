<template>
    <div>
        <dopa_indicators_table
                :title=land_degradation.title_table
                :indicators=land_degradation.indicators
                :api_data=api_data
        ></dopa_indicators_table>
        <dopa_chart_doughnut
                :indicators=land_degradation.indicators
                :api_data=api_data
        ></dopa_chart_doughnut>
    </div>

</template>


<script>

    import base from '../../../components/_base.mixin';

    export default {
        mixins: [base],
        data: function () {
            return {
                land_degradation:{
                    title_table: 'Changes over 15 years (1999-2013) in the health and productive capacity of the land [km2]',
                    title_chart: 'Changes over 15 years (1999-2013) in the health and productive capacity of the land [km2]',
                    indicators: [
                        {
                            field: 'lpd_null_km2',
                            label: 'No biomass',
                            color: '#878787'
                        },
                        {
                            field: 'lpd_severe_km2',
                            label: 'Persistent severe decline in productivity',
                            color: '#ab2828'
                        },
                        {
                            field: 'lpd_moderate_km2',
                            label: 'Persistent moderate decline in productivity',
                            color: '#ed7325'
                        },
                        {
                            field: 'lpd_stressed_km2',
                            label: 'Stable, but stressed; persistent strong inter-annual productivity variations',
                            color: '#ffd954'
                        },
                        {
                            field: 'lpd_stable_km2',
                            label: 'Stable Productivity',
                            color: '#b8d879'
                        },
                        {
                            field: 'lpd_increased_km2',
                            label: 'Persistent increase in productivity',
                            color: '#46a246'
                        }
                    ]
                }
            }
        }

    }
</script>
