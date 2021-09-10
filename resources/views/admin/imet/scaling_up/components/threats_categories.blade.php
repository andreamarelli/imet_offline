<container_section :id="'{{$name}}'" :title="'{{$title}}'">
    <template slot-scope="container">
        <div class="row">
            <div class="col-sm">
                <container
                        :loaded_at_once="container.props.show_view"
                        :url=url
                        :parameters="'{{$pa_ids}}'"
                        :func="'get_threats_categories_per_protected_area'"
                >
                    <template slot-scope="data">
                        <div>

                            <div v-for="(value, index) in data.props.values.values" class="align-items-center"
                                 :id="'{{$name}}-'+index">

                                <container_actions :data="value" :name="'{{$name}}-'+index"
                                                   :event_image="'save_entire_block_as_image'"
                                                   :exclude_elements="'{{$exclude_elements}}'">
                                    <template slot-scope="v">

                                        <bar_reverse
                                                :title="(index+1)+'. '+ container.props.stores.BaseStore.localization(`form/imet/v2/context.MenacesPressions.categories.title${index+1}`)"
                                                :event_id="'save_image_s'"
                                                :show_legends="true"
                                                :values="v.props.map(item => item.value)"
                                                :colors="['5C7BD9']"
                                                :fields='v.props.map(item => item.name)'></bar_reverse>
                                    </template>
                                </container_actions>
                            </div>
                        </div>
                    </template>
                </container>
                <container_actions :name="'{{$name}}'" :event_image="'save_entire_block_as_image'"></container_actions>
            </div>
        </div>

    </template>
</container_section>
