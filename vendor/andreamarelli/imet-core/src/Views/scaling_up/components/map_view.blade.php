<container_section :id="'{{$name}}'" :title="'{{$title}}'" :code="'{{$code}}'"
                   :guidance="'imet-core::analysis_report.guidance.map'">
    <template slot-scope="container">
        <div class="row">
            <div class="col-sm">
                <div class="align-items-center">
                    <div id="map-view">
                        <container_actions :data="{}" :name="'map-view'"
                                           :event_image="'save_entire_block_as_image'"
                                           :exclude_elements="'{{$exclude_elements}}'">
                            <template slot-scope="data_elements">
                                <map_view v-if="container.props.show_view" pa="{{$pa_ids}}" :url=url></map_view>
                            </template>
                        </container_actions>
                    </div>
                </div>
            </div>
        </div>
    </template>
</container_section>
