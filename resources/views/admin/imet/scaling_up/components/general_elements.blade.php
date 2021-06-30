<container_section :id="'{{$name}}'" :title="'{{$title}}'">
    <template slot-scope="container">
        <div class="row">
            <div class="col">
                <div class="align-items-center">
                    <container
                            :loaded_at_once="container.props.show_view"
                            :url=url
                            :parameters="'{{$pa_ids}}'"
                            :func="'general_info'"
                    >
                        <template slot-scope="data">
                            <container_actions :data="data.props" :name="'{{$name}}'"
                                                :event_image="'save_entire_block_as_image'"
                                                :exclude_elements="'{{$exclude_elements}}'">
                                    <template slot-scope="values">
                                        <general_info
                                                :values="values.props.values"
                                        ></general_info>
                                    </template>
                            </container_actions>
                        </template>
                    </container>
                </div>

            </div>
        </div>
    </template>
</container_section>
