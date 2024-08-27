<div v-for="(value, index) in data.props.values" :id="'{{$name}}-protected-'+index"
     class="module-body bg-white border-0">
    <container_actions :data="value" :name="'{{$name}}-protected-'+index"
                       :event_image="'save_entire_block_as_image'"
                       :exclude_elements="'{{$exclude_elements}}'">
        <template slot-scope="data_elements">
            <div class="list-key-numbers">
                <div class="list-head" v-html="index">
                </div>
            </div>
            <div class="module-body bg-white border-0">
                <scaling_dopa_chart_bar class="col-sm"
                                        :title=container.props.config.dopa_indicators.protected_area_coverage_and_connectivity.title_chart
                                        :indicators=container.props.config.dopa_indicators.protected_area_coverage_and_connectivity.bar_indicators
                                        :api_data="Object.assign({}, ...data_elements.props)"
                ></scaling_dopa_chart_bar>

                <dopa_indicators_table
                    :indicators=container.props.config.dopa_indicators.protected_area_coverage_and_connectivity.table_bar_indicators
                    :api_data="Object.assign({}, ...data_elements.props)"
                    :precision="2"
                ></dopa_indicators_table>
            </div>
            @include('imet-core::scaling_up.components.copyright_dopa')
        </template>
    </container_actions>
</div>
