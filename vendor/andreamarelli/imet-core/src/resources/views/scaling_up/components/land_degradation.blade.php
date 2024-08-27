<div v-for="(value, index) in data.props.values" :id="'{{$name}}-'+index"
     class="module-body bg-white border-0">
    <container_actions :data="value" :name="'{{$name}}-'+index"
                       :event_image="'save_entire_block_as_image'"
                       :exclude_elements="'{{$exclude_elements}}'">
        <template slot-scope="data_elements">
            <div class="list-key-numbers">
                <div class="list-head" v-html="index">
                </div>
            </div>
            <div class="module-body bg-white border-0">
                <dopa_indicators_table
                    :indicators=container.props.config.dopa_indicators.land_degradation.indicators
                    :api_data="Object.assign({}, ...data_elements.props)"
                    :precision="2"
                ></dopa_indicators_table>
                <scaling_dopa_chart_doughnut
                    :title="''"
                    :indicators=container.props.config.dopa_indicators.land_degradation.bar_indicators
                    :api_data="Object.assign({}, ...data_elements.props)"
                ></scaling_dopa_chart_doughnut>
            </div>
            @include('imet-core::scaling_up.components.copyright_dopa')
        </template>
    </container_actions>
</div>

