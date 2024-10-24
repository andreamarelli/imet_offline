<div class="module-container">
    <div class="module-header">
        <div class="module-title">Annexes (&copy;Dopa Services)</div>
    </div>
    <div class="module-body">
        <div>
            <div v-if=connection>

                <b>@lang('imet-core::v2_report.forest_cover')</b>
                <dopa_indicators_table :title=dopa_indicators.forest_cover.title_table
                    :indicators=dopa_indicators.forest_cover.indicators :api_data="api_data">
                </dopa_indicators_table>
                <dopa_chart_bar :title=dopa_indicators.forest_cover.title_chart
                    :indicators=dopa_indicators.forest_cover.bar_indicators :api_data=api_data></dopa_chart_bar>

                <hr />

                <b>@lang('imet-core::v2_report.total_carbon')</b>
                <dopa_indicators_table :title=dopa_indicators.total_carbon.title_table
                    :indicators=dopa_indicators.total_carbon.indicators :api_data=api_data>
                </dopa_indicators_table>


                <b>@lang('imet-core::v2_report.agricultural_pressure')</b>
                <dopa_indicators_table :title=dopa_indicators.agricultural_pressure.title_table
                    :indicators=dopa_indicators.agricultural_pressure.indicators :api_data=api_data>
                </dopa_indicators_table>

            </div>
            <div v-else class="dopa_not_available">@lang('imet-core::common.dopa_not_available')</div>
        </div>
    </div>
</div>
