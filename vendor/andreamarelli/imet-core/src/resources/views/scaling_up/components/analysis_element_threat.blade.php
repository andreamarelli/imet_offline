<div class="horizontal">
    <div class="sub-title" v-html="container.props.config.element_diagrams.threats.menu.title"></div>
</div>
<div>
    <guidance :text="'imet-core::analysis_report.guidance.context.threats'"></guidance>
</div>
<div class="horizontal">
    <div class="sub-title sub-title-second">
        <span v-html="container.props.config.element_diagrams.threats.menu.ranking"></span>
        <button class="btn-nav small blue ml-1">
            <span class="fas fa-fw fa-info-circle"></span>
        </button>
        <tooltip>
            {{ trans('imet-core::analysis_report.guidance.info.ranking') }}}
        </tooltip>
    </div>
</div>
<div :id="'{{$name}}-ranking-threat'">
    <container_actions :data="values.props" :name="'{{$name}}-ranking-threat'"
                       :event_image="'save_entire_block_as_image'"
                       :exclude_elements="'{{$exclude_elements}}'">
        <template v-slot:default="v">
            <div v-if="v.props.ranking">
                <bar_category_stack
                    :title="container.props.config.element_diagrams.threats.menu.ranking"
                    :show_y_axis="true"
                    :label_position="'bottom'"
                    :axis_dimensions_y="{max:0, min:-100}"
                    :show_option_label="container.props.config.element_diagrams.threats.ranking_labels"
                    :grid='{"grid": {
                                            "left": "3%",
                                            "right": "4%",
                                            "bottom": "5%",
                                            "containLabel": true,
                                            "top":"19%"
                                            }}'
                    :x_axis_data="values.props.ranking.xAxis"
                    :legends="values.props.ranking.legends"
                    :colors="container.props.config.color_correct_order"
                    :values="values.props.ranking.values"
                    :percent_values="values.props.ranking.percent_value"
                    :raw_values="values.props.ranking.raw_values_protected_area"></bar_category_stack>
            </div>
        </template>
    </container_actions>
</div>
<div class="horizontal">
    <div class="sub-title sub-title-second">
        <span v-html="container.props.config.element_diagrams.threats.menu.average_contribution"></span>
        <button class="btn-nav small blue ml-1">
            <span class="fas fa-fw fa-info-circle"></span>
        </button>
        <tooltip>
            {{ trans('imet-core::analysis_report.guidance.info.average_contribution') }}}
        </tooltip>
    </div>
</div>
<div :id="'{{$name}}-average-contribution-threat'">
    <container_actions :data="values.props"
                       :name="'{{$name}}-average-contribution-threat'"
                       :event_image="'save_entire_block_as_image'">
        <template v-slot:default="v">
            <div v-if="v.props.average_contribution">
                <imet_bar_error
                    :title="container.props.config.element_diagrams.threats.menu.average_contribution"
                    :error_color="'#fff000'"
                    :axis_dimensions_x="{max:100}"
                    :show_legends="true"
                    :values="values.props.average_contribution.data"
                    :legends="values.props.average_contribution.legends"
                    :height="values.props.average_contribution.options.height"
                    :indicators="values.props.average_contribution.indicators"></imet_bar_error>
            </div>
        </template>
    </container_actions>
</div>
<div class="horizontal">
    <div class="sub-title sub-title-second">
        <span v-html="container.props.config.element_diagrams.threats.menu.radar"></span>
        <button class="btn-nav small blue ml-1">
            <span class="fas fa-fw fa-info-circle"></span>
        </button>
        <tooltip>
            {{ trans('imet-core::analysis_report.guidance.info.radar') }}}
        </tooltip>
    </div>
</div>
<div :id="'{{$name}}-radar-threat'">
    <container_actions :data="values.props" :name="'{{$name}}-radar-threat'"
                       :event_image="'save_entire_block_as_image'"
                       :exclude_elements="'{{$exclude_elements}}'">
        <template v-slot:default="v">
            <div v-if="v.props.radar">
                <radar_threats class="sm"
                               :title="container.props.config.element_diagrams.threats.menu.radar"
                               :height=750
                               :single="false"
                               :unselect_legends_on_load="true"
                               :show_legends="true"
                               :indicators="values.props.radar.indicators"
                               :values="values.props.radar.values"></radar_threats>
            </div>
        </template>
    </container_actions>
</div>

<div class="horizontal">
    <div class="sub-title sub-title-second">
        <span v-html="container.props.config.element_diagrams.threats.menu.datatable"></span>
        <button class="btn-nav small blue ml-1">
            <span class="fas fa-fw fa-info-circle"></span>
        </button>
        <tooltip>
            {{ trans('imet-core::analysis_report.guidance.threats.datatable') }}}
        </tooltip>
    </div>
</div>

<div v-for="(value, index) in values.props.values" class="align-items-center">

    <div :id="'{{$name}}-x-'+index">
        <container_actions :data="value" :name="'{{$name}}-x-'+index"
                           :event_image="'save_entire_block_as_image'"
                           :exclude_elements="'{{$exclude_elements}}'">
            <template v-slot:default="v">

                <bar_reverse
                    :title_data="'{{ucfirst(trans('imet-core::v2_common.steps.threats'))}}'"
                    :title="(index+1)+'. '+ container.props.stores.BaseStore.localization(`imet-core::v2_context.MenacesPressions.categories.title${index+1}`)"
                    :show_legends="true"
                    :rotate="0"
                    :values="value.map(item => item.value)"
                    :colors="['5C7BD9']"
                    :fields='value.map(item => item.name)'></bar_reverse>
            </template>
        </container_actions>
    </div>
</div>
