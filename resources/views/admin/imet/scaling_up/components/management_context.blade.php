<container_section :id="'{{$name}}'" :title="'{{$title}}'">
    <template slot-scope="container">
        <div class="row">
            <div class="col-sm">
                <div class="align-items-center">
                    <container
                            :loaded_at_once="container.props.show_view"
                            :url=url
                            :parameters="'{{$pa_ids}}'"
                            :func="'management_context'"

                    >
                        <template slot-scope="data">
                            <div v-for="(value, index) in data.props.values">
                                <management_context
                                        :values="value"
                                ></management_context>
                            </div>
                        </template>
                    </container>
                </div>
                <container_actions :name="'{{$name}}'" :event_image="'save_entire_block_as_image'"></container_actions>
            </div>
        </div>
    </template>
</container_section>

