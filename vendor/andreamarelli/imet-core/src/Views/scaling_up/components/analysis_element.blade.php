<div class="row">
    <div class="col-12 mb-5" v-for="(value, index) in data.props"
         :id="'{{$name}}-'+index">
        <div class="col-12 mb-5" v-for="(section_data, section) in value" :id="'{{$name}}-'+section">
            <div class="align-items-center "
                 v-for="(tableValue, tableIndex) in container.props.config.element_diagrams[section]">
                <div class="col-12 mb-5">
                    <div v-if="tableValue['menu']['title']" :id="'menu-title-'+section+'-'+tableValue['name']"
                         class="list-key-numbers horizontal">
                        <div class="list-head" v-html="tableValue['menu']['title']"></div>
                    </div>
                    <div class="list-key-numbers horizontal">
                        <div class="list-head" :id="'menu-radar-'+section+'-'+tableValue['name']"
                             v-html="tableValue['menu']['radar']"></div>
                    </div>
                    <div v-if="tableValue['menu']['radar'] !== ''"
                         :id="'{{$name}}-'+section+'-'+tableValue['name']+'-'+index+'scaling-radar'">
                        <container_actions :data="section_data"
                                           :name="'{{$name}}-'+section+'-'+tableValue['name']+'-'+index+'scaling-radar'"
                                           :event_image="'save_entire_block_as_image'">
                            <template slot-scope="data_elements">
                                <scaling_radar class="sm" :height=700
                                               :single="false"
                                               :radar_indicators_for_negative="data_elements.props[tableValue['name']].radar.radar_indicators_for_negative"
                                               :unselect_legends_on_load="true"
                                               :show_legends="true"
                                               :indicators="data_elements.props[tableValue['name']].radar.indicators"
                                               :values="data_elements.props[tableValue['name']].radar.values"></scaling_radar>
                            </template>
                        </container_actions>
                    </div>
                    <div v-if="tableValue['menu']['radar'] !== ''"
                         :id="'{{$name}}-'+section+'-'+tableValue['name']+'-'+index+'scaling-datatable-radar'">
                        <container_actions :data="section_data"
                                           :name="'{{$name}}-'+section+'-'+tableValue['name']+'-'+index+'scaling-datatable-radar'"
                                           :event_image="'save_entire_block_as_image'">
                            <template slot-scope="data_elements">
                                <datatable_interact_with_radar class="col-sm"
                                                               :values="data_elements.props[tableValue['name']].radar.values"
                                                               :columns="container.props.stores.BaseStore.find_config_by_name(container.props.config.element_diagrams[section], tableValue['name']).columns"></datatable_interact_with_radar>

                            </template>
                        </container_actions>
                    </div>
                </div>
                <div class="list-key-numbers horizontal mt-5">
                    <div class="list-head" :id="'menu-ranking-'+section+'-'+tableValue['name']"
                         v-html="tableValue['menu']['ranking']"></div>
                </div>
                <div :id="'{{$name}}-'+section+'-'+tableValue['name']+'-'+index+'category-stack'">
                    <container_actions :data="section_data"
                                       :name="'{{$name}}-'+section+'-'+tableValue['name']+'-'+index+'category-stack'"
                                       :event_image="'save_entire_block_as_image'">
                        <template slot-scope="data_elements">
                            <bar_category_stack
                                :show_y_axis="false"
                                :show_option_label="true"
                                :x_axis_data="data_elements.props[tableValue['name']].ranking.xAxis"
                                :legends="data_elements.props[tableValue['name']].ranking.legends"
                                :colors="container.props.config.color_correct_order"
                                :values="data_elements.props[tableValue['name']].ranking.values"></bar_category_stack>

                        </template>
                    </container_actions>
                </div>
                <div class="list-key-numbers horizontal mt-5">
                    <div class="list-head" :id="'menu-average-contribution-'+section+'-'+tableValue['name']"
                         v-html="tableValue['menu']['average_contribution']"></div>
                </div>
                <div :id="'{{$name}}-'+section+'-'+tableValue['name']+'-'+index+'bar-error'">
                    <container_actions :data="section_data"
                                       :name="'{{$name}}-'+section+'-'+tableValue['name']+'-'+index+'bar-error'"
                                       :event_image="'save_entire_block_as_image'">
                        <template slot-scope="data_elements">
                            <imet_bar_error
                                :axis_dimensions_x="{max:100}"
                                :show_legends="true"
                                :values="data_elements.props[tableValue['name']].average_contribution.data"
                                :height="data_elements.props[tableValue['name']].average_contribution.options.height"
                                :indicators="container.props.stores.BaseStore.parse_indicators(data_elements.props[tableValue['name']].average_contribution.data.Average.map(i => i.label))"></imet_bar_error>
                        </template>
                    </container_actions>
                </div>
                <div class="list-key-numbers horizontal mt-5">
                    <div class="list-head" :id="'menu-datatable-'+section+'-'+tableValue['name']"
                         v-html="tableValue['menu']['datatable']"></div>
                </div>
                <div :id="'{{$name}}-'+section+'-'+tableValue['name']+'-'+index+'table-scaling'">
                    <container_actions :data="section_data"
                                       :name="'{{$name}}-'+section+'-'+tableValue['name']+'-'+index+'table-scaling'"
                                       :event_image="'save_entire_block_as_image'">
                        <template slot-scope="data_elements">

                            <datatable_scaling
                                :columns="tableValue.columns"
                                :values="data_elements.props[tableValue['name']].table">
                            </datatable_scaling>

                        </template>
                    </container_actions>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
