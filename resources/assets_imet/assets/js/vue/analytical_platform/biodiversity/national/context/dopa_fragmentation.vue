<template>
    <div>
        <dopa_indicators_table
                :title=land_fragmentation.title_table
                :indicators=land_fragmentation.indicators
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
                land_fragmentation: {
                    title_table: 'Natural land pattern and fragmentation statistics (2015) [km2]',
                    title_chart: 'Natural land pattern dynamics (1995 - 2015)',
                    years: [1995, 2000, 2005, 2010, 2015],
                    indicators: [
                        {
                            fields: ['mspa_core_1995_km2', 'mspa_core_2000_km2', 'mspa_core_2005_km2', 'mspa_core_2010_km2', 'mspa_core_2015_km2'],
                            label: 'Core',
                            color: '#7fad41'
                        },
                        {
                            fields: ['mspa_non_natural_1995_km2', 'mspa_non_natural_2000_km2', 'mspa_non_natural_2005_km2', 'mspa_non_natural_2010_km2', 'mspa_non_natural_2015_km2'],
                            label: 'Non Natural',
                            color: '#878787'
                        },
                        {
                            fields: ['mspa_edges_1995_km2', 'mspa_edges_2000_km2', 'mspa_edges_2005_km2', 'mspa_edges_2010_km2', 'mspa_edges_2015_km2'],
                            label: 'Edge',
                            color: '#52781f'
                        },
                        {
                            fields: ['mspa_perforation_1995_km2', 'mspa_perforation_2000_km2', 'mspa_perforation_2005_km2', 'mspa_perforation_2010_km2', 'mspa_perforation_2015_km2'],
                            label: 'Core Perforation',
                            color: '#f1c200'
                        },
                        {
                            fields: ['mspa_islets_1995_km2', 'mspa_islets_2000_km2', 'mspa_islets_2005_km2', 'mspa_islets_2010_km2', 'mspa_islets_2015_km2'],
                            label: 'Islet',
                            color: '#e89717'
                        },
                        {
                            fields: ['mspa_margins_1995_km2', 'mspa_margins_2000_km2', 'mspa_margins_2005_km2', 'mspa_margins_2010_km2', 'mspa_margins_2015_km2'],
                            label: 'Linear',
                            color: '#d56317'
                        }
                    ],
                },
            }
        }

    }
</script>
