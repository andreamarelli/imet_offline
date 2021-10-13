<container_section :id="'{{$name}}'" :title="'{{$title}}'">
    <template slot-scope="container">
        <div class="row">
            <div class="col-sm">
                <container
                        :loaded_at_once="container.props.show_view"
                        :url=url
                        :parameters="'{{$pa_ids}}'"
                        :func="'get_assessments'"
                >
                    <template slot-scope="data">
                        <div class="module-body bg-white border-0">
                            <div v-for="(value, index) in data.props.values" class="container" :id="'{{$name}}-'+index">
                                <container_actions :data="value" :name="'{{$name}}-'+index"
                                                   :event_image="'save_entire_block_as_image'"
                                                   :exclude_elements="'{{$exclude_elements}}'">
                                    <template slot-scope="data_elements">
                                        <div class="row">
                                            <div class="col-sm">

                                                <datatable_scaling
                                                        :columns="container.props.config.evaluation_of_protected_area_management_cycle.columns"
                                                        :values="data_elements.props">
                                                </datatable_scaling>

                                            </div>
                                        </div>
                                    </template>
                                </container_actions>
                            </div>
                        </div>
                    </template>
                </container>
            </div>
        </div>
    </template>
</container_section>