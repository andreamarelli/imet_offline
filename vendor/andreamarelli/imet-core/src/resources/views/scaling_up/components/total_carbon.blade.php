<div v-if="data.props.diagram" :id="'sum_diagram'">
    <container_actions :data="data.props.diagram" :name="'sum_diagram'" :event_image="'save_entire_block_as_image'"
        :exclude_elements="'{{ $exclude_elements }}'">
        <template v-slot>
            <imet_bar_chart :fields="Object.keys(data.props.diagram.values)" :rotate="45"
                :zoom="false" :values='Object.values(data.props.diagram.values)'></imet_bar_chart>
        </template>
    </container_actions>

    <div v-for="(value, index) in data.props.data" :id="'{{ $name }}-total-carbon-' + index"
        class="module-body  border-0">
        <container_actions :data="value" :name="'{{ $name }}-total-carbon-' + index"
            :event_image="'save_entire_block_as_image'" :exclude_elements="'{{ $exclude_elements }}'">
            <template v-slot:default="data_elements">
                <div v-for="(area, idx) in data_elements.props">
                    <div class="list-key-numbers">
                        <div class="list-head" v-html="idx">
                        </div>
                    </div>
                    <div class="module-body bg-white border-0">
                        <dopa_indicators_table
                            :indicators=container.props.config.dopa_indicators.total_carbon.indicators
                            :api_data="Object.assign({}, ...area)" :precision="2"></dopa_indicators_table>
                    </div>

                </div>
                @include('imet-core::scaling_up.components.copyright_dopa')
            </template>
        </container_actions>
    </div>
</div>
