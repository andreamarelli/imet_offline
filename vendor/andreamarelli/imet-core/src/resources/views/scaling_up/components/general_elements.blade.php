<container_section
    :title="'{{$title}}'"
    :id="'{{$name}}'"
    :code="'{{$code}}'"
    :info_label="'imet-core::analysis_report.guidance.general_elements'">
    <template v-slot:default="container">
        <div id="{{$name}}-image">
            <container
                :loaded_at_once="container.props.show_view"
                :url=url
                :parameters="'{{$pa_ids}}'"
                :func="'general_info'">
                <template v-slot:default="data">
                    <div :id="'{{$name}}'">

                        <container_actions
                            :data="data.props"
                            :name="'{{$name}}-image'"
                            :event_image="'save_entire_block_as_image'"
                            :exclude_elements="'{{$exclude_elements}}'">
                            <template v-slot:default="values">
                                <div v-if="Object.keys(values.props).length">
                                    <general_info
                                        :values="values.props"
                                    ></general_info>
                                </div>
                            </template>
                        </container_actions>

                    </div>
                </template>
            </container>

        </div>

    </template>
</container_section>
