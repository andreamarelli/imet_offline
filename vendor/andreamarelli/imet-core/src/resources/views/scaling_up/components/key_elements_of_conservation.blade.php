<container_section :id="'{{$name}}'" :title="'{{$title}}'" :code="'{{$code}}'"
                   :guidance="'imet-core::analysis_report.guidance.key_elements'">
    <template slot-scope="container">

        <container
                :loaded_at_once="container.props.show_view"
                :url=url
                :parameters="'{{$pa_ids}}'"
                :func="'get_management_context'"

        >
            <template slot-scope="data">

                <div v-for="(value, index) in data.props.values">
                    <management_context
                            :values="value"
                    ></management_context>
                </div>

            </template>
        </container>

    </template>
</container_section>

