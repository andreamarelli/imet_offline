<container_section :id="'{{$name}}'" :title="'{{$title}}'">
    <template slot-scope="container">
        <div class="row">
            <div class="col-sm">
                <div class="align-items-center">
                    <container
                            :loaded_at_once="container.props.show_view"
                            :url=url
                            :parameters="'{{$pa_ids}}'"
                            :func="'get_dopa_pa_ecoregions_marine_stats'"
                    >
                        <template slot-scope="data">
                            <div v-for="(value, index) in data.props.values" :id="'{{$name}}-'+index"
                                 class="module-body">
                                <container_actions :data="value" :name="'{{$name}}-'+index"
                                                    :event_image="'save_entire_block_as_image'"
                                                    :exclude_elements="'{{$exclude_elements}}'">
                                    <template slot-scope="data_elements">
                                        <div class="list-key-numbers horizontal">
                                            <div class="list-head" v-html="index">
                                            </div>
                                        </div>
                                        <div class="module-body">
                                            <datatable_custom
                                                    :columns="container.props.config.marine_ecoregions.columns"
                                                    :values="data_elements.props">
                                            </datatable_custom>
                                        </div>
                                    </template>
                                </container_actions>
                            </div>
                        </template>
                    </container>
                </div>
                <container_actions :name="'{{$name}}'" :event_image="'save_entire_block_as_image'"></container_actions>
            </div>
        </div>
    </template>
</container_section>
