<div class="horizontal">
    <div class="sub-title" v-html="container.props.config.element_diagrams.threats.menu.title"></div>
</div>
<div>
    <guidance :text="'imet-core::analysis_report.guidance.context.threats'"/>
</div>
<div class="horizontal">
    <div class="sub-title sub-title-second">
        <span v-html="container.props.config.element_diagrams.threats.menu.ranking"></span>
        <popover>
            <template>
                {{trans('imet-core::analysis_report.guidance.info.ranking')}}
            </template>
        </popover>
    </div>
</div>
<div :id="'{{$name}}-ranking-threat'">
    <container_actions :data="data.props.values" :name="'{{$name}}-ranking-threat'"
                       :event_image="'save_entire_block_as_image'"
                       :exclude_elements="'{{$exclude_elements}}'">
        <template slot-scope="v">
            <div v-if="v.props.ranking">
                <bar_category_stack
                    :show_y_axis="false"
                    :label_position="'bottom'"
                    :show_option_label="container.props.config.element_diagrams.threats.ranking_labels"
                    :grid='{"grid": {
                                            "left": "3%",
                                            "right": "4%",
                                            "bottom": "5%",
                                            "containLabel": true,
                                            "top":"19%"
                                            }}'
                    :x_axis_data="v.props.ranking.xAxis"
                    :legends="v.props.ranking.legends"
                    :colors="container.props.config.color_correct_order"
                    :values="v.props.ranking.values"></bar_category_stack>
            </div>
        </template>
    </container_actions>
</div>
<div class="horizontal">
    <div class="sub-title sub-title-second">
        <span v-html="container.props.config.element_diagrams.threats.menu.average_contribution"></span>
        <popover>
            <template>
                {{trans('imet-core::analysis_report.guidance.info.average_contribution')}}
            </template>
        </popover>
    </div>
</div>
<div :id="'{{$name}}-average-contribution-threat'">
    <container_actions :data="data.props.values"
                       :name="'{{$name}}-average-contribution-threat'"
                       :event_image="'save_entire_block_as_image'">
        <template slot-scope="v">
            <div v-if="v.props.average_contribution">
                <imet_bar_error
                    :error_color="'#fff000'"
                    :axis_dimensions_x="{max:100}"
                    :show_legends="true"
                    :values="v.props.average_contribution.data"
                    :height="v.props.average_contribution.options.height"
                    :indicators="v.props.average_contribution.indicators"></imet_bar_error>
            </div>
        </template>
    </container_actions>
</div>
<div class="horizontal">
    <div class="sub-title sub-title-second">
        <span v-html="container.props.config.element_diagrams.threats.menu.radar"></span>
        <popover>
            <template>
                {{trans('imet-core::analysis_report.guidance.info.radar')}}
            </template>
        </popover>
    </div>
</div>
<div :id="'{{$name}}-radar-threat'">
    <container_actions :data="data.props.values" :name="'{{$name}}-radar-threat'"
                       :event_image="'save_entire_block_as_image'"
                       :exclude_elements="'{{$exclude_elements}}'">
        <template slot-scope="v">
            <div v-if="v.props.radar">
                <radar_threats class="sm"
                               :height=700
                               :single="false"
                               :unselect_legends_on_load="true"
                               :show_legends="true"
                               :indicators="v.props.radar.indicators"
                               :values="v.props.radar.values"></radar_threats>
            </div>
        </template>
    </container_actions>
</div>

<div class="horizontal">
    <div class="sub-title sub-title-second">
        <span v-html="container.props.config.element_diagrams.threats.menu.datatable"></span>
        <popover>
            <template>
                {{trans('imet-core::analysis_report.guidance.threats.datatable')}}
            </template>
        </popover>
    </div>
</div>
<div v-for="(value, index) in data.props.values.values" class="align-items-center" :id="'{{$name}}-'+index">
    <container_actions :data="value" :name="'{{$name}}-'+index"
                       :event_image="'save_entire_block_as_image'"
                       :exclude_elements="'{{$exclude_elements}}'">
        <template slot-scope="v">
            <bar_reverse
                :title="(index+1)+'. '+ container.props.stores.BaseStore.localization(`imet-core::v2_context.MenacesPressions.categories.title${index+1}`)"
                :event_id="'save_image_s'"
                :show_legends="true"
                :values="v.props.map(item => item.value)"
                :colors="['5C7BD9']"
                :fields='v.props.map(item => item.name)'></bar_reverse>
        </template>
    </container_actions>
</div>
