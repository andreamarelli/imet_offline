<container_section :id="'{{$name}}'" :title="'{{$title}}'">
    <template slot-scope="container">
        <div class="row">
            <div class="col-sm">
                <div class="align-items-center">
                    <container
                            :loaded_at_once="container.props.show_view"
                            :url=url
                            :parameters="'{{$pa_ids}}'"
                            :func="'get_imet_ranking'"
                    >
                        <template slot-scope="data" class="col-24">
                            <div class="row">
                                <div class="col-12 mb-5" v-for="(value, index) in data.props.values"
                                     :id="'{{$name}}-'+index">
                                    <container_actions :data="value" :name="'{{$name}}'"
                                                       :event_image="'save_entire_block_as_image'">
                                        <template slot-scope="data_elements">
                                            <div class="align-items-center ">
                                                {{--                                                                            <div v-html="data_elements.props"></div>--}}
                                                <bar_category_stack
                                                        :axis_dimensions_y="{max:100}"
                                                        :x_axis_data="data_elements.props.xAxis"
                                                        :legends="data_elements.props.legends"
                                                        :colors="container.props.config.color_correct_order"
                                                        :values='data_elements.props.values'></bar_category_stack>
                                            </div>
                                        </template>
                                    </container_actions>
                                </div>
                            </div>
                        </template>
                    </container>
                </div>
            </div>
        </div>
    </template>
</container_section>