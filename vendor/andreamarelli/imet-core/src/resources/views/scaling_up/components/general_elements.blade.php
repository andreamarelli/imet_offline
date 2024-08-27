<container_section
    :title="'{{$title}}'"
    :id="'{{$name}}'"
    :code="'{{$code}}'"
    :guidance="'imet-core::analysis_report.guidance.general_elements'">
    <template slot-scope="container">

        <div id="{{$name}}-image">

            <container
                :loaded_at_once="container.props.show_view"
                :url=url
                :parameters="'{{$pa_ids}}'"
                :func="'general_info'">
                <template slot-scope="data">
                    <div :id="'{{$name}}'">

                        <container_actions
                                :data="data.props"
                                :name="'{{$name}}-image'"
                                :event_image="'save_entire_block_as_image'"
                                :exclude_elements="'{{$exclude_elements}}'">
                            <template slot-scope="values">

                                <general_info
                                    :values="values.props.values"
                                ></general_info>

                            </template>
                        </container_actions>

                    </div>
                </template>
            </container>

        </div>

    </template>
</container_section>
