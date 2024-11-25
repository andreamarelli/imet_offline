<container_section :id="'{{$name}}'" :title="'{{$title}}'" :code="'{{$code}}'"
                   :info_label="'imet-core::analysis_report.guidance.key_elements'">
    <template v-slot:default="container">

        <container
                :loaded_at_once="container.props.show_view"
                :url=url
                :parameters="'{{$pa_ids}}'"
                :func="'get_management_context'"

        >
            <template v-slot:default="data">
                <div v-for="(value, index) in data.props">
                    <management_context
                            :values="value"
                    ></management_context>
                </div>

            </template>
        </container>

    </template>
</container_section>

