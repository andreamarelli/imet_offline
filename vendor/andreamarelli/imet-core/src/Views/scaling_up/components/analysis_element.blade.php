<div class="row">
    <div class="col-12 " v-for="(value, index) in data.props"
         :id="'{{$name}}-'+index">

        <div class="col-12" v-for="(section_data, section) in value" :id="'{{$name}}-'+section">
            <div class="align-items-center "
                 v-for="(tableValue, tableIndex) in container.props.config.element_diagrams[section]">
                <div v-if="tableValue['menu']['radar'] !== ''">
                    <div>
                        <guidance :text="'imet-core::analysis_report.guidance.context.'+tableValue['key']"/>
                    </div>
                    <?php if (!$dontShowTitle) { ?>
                    <div v-if="tableValue['menu']['title']" :id="'menu-title-'+section+'-'+tableValue['name']"
                         class="horizontal">

                        <div class="sub-title" v-html="tableValue['menu']['title']"></div>
                    </div> <?php } else { ?>

                    <?php
                    } ?>
                </div>
                <div class=" horizontal mt-1">
                    <div class="sub-title {{ $sub_class ?? '' }}" :id="'menu-ranking-'+section+'-'+tableValue['name']">
                        <span v-html="tableValue['menu']['ranking']"></span>
                        <popover>
                            <template>
                                {{trans('imet-core::analysis_report.guidance.info.ranking')}}
                            </template>
                        </popover>
                    </div>
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
                <div class="horizontal mt-1">
                    <div class="sub-title {{ $sub_class ?? '' }}"
                         :id="'menu-average-contribution-'+section+'-'+tableValue['name']">
                        <span v-html="tableValue['menu']['average_contribution']"></span>
                        <popover>
                            <template>
                                {{trans('imet-core::analysis_report.guidance.info.average_contribution')}}
                            </template>
                        </popover>
                    </div>
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
                <div v-if="tableValue['menu']['radar'] !== ''">

                    <div class="horizontal">
                        <div class="sub-title {{ $sub_class ?? '' }}"
                             :id="'menu-radar-'+section+'-'+tableValue['name']">
                            <span v-html="tableValue['menu']['radar']"></span>
                            <popover>
                                <template>
                                    {{trans('imet-core::analysis_report.guidance.context.radar')}}
                                </template>
                            </popover>
                        </div>
                    </div>
                    <div
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
                    <div
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
                <div class="horizontal mt-1">
                    <div class="sub-title {{ $sub_class ?? '' }}"
                         :id="'menu-datatable-'+section+'-'+tableValue['name']">
                        <span v-html="tableValue['menu']['datatable']"></span>
                        <popover>
                            <template>
                                {{trans('imet-core::analysis_report.guidance.info.datatable')}}
                            </template>
                        </popover>
                    </div>
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
