<container_section :id="'{{$name}}'" :title="'{{$title}}'" :code="'{{$code}}'"
                   :info_label="'imet-core::analysis_report.guidance.map'">
    <template v-slot:default="container">
        <div id="map-view">
            <container_actions
                    :data="{}"
                    :name="'map-view'"
                    :event_image="'save_entire_block_as_image'"
                    :exclude_elements="'{{$exclude_elements}}'">

                <template v-slot:default="data_elements">
                    <map_view v-if="container.props.show_view" form_ids="{{ $pa_ids }}" :url=url></map_view>
                </template>

            </container_actions>
        </div>

    </template>
</container_section>
