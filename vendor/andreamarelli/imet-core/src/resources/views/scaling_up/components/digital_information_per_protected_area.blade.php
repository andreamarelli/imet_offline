<container_section :id="'{{ $name }}'" :title="'{{ $title }}'" :code="'{{ $code }}'"
    :info_label="'imet-core::analysis_report.guidance.digital_information.main'">
    <template v-slot:default="container">
        <div class="flex flex-col">
            <container_view :loaded_at_once="false" :title="'Total carbon'"
                :info_label="'imet-core::analysis_report.guidance.digital_information.total_carbon'">
                <template v-slot:default="data">
                    <div v-if="data.props.show_view">
                        <container :loaded_at_once="true" :url=url :parameters="'{{ $pa_ids }}'"
                            :func="'get_total_carbon'">
                            <template v-slot:default="data">
                                <div v-if="data.props.data">
                                    @include('imet-core::scaling_up.components.total_carbon', [
                                        'name' => $name,
                                    ])
                                </div>
                            </template>
                        </container>
                    </div>
                </template>
            </container_view>
            <container_view :loaded_at_once="false" :title="'Terestial ecoregions'"
                :info_label="'imet-core::analysis_report.guidance.digital_information.terestial_ecoregions'">
                <template v-slot:default="data">
                    <div v-if="data.props.show_view">
                        <container :loaded_at_once="true" :url=url :parameters="'{{ $pa_ids }}'"
                            :func="'get_dopa_pa_ecoregions_terrestial_stats'">
                            <template v-slot:default="data">
                                <div v-if="data.props">
                                    @include('imet-core::scaling_up.components.terestial_ecoregions', [
                                        'name' => $name,
                                    ])
                                </div>
                            </template>
                        </container>
                    </div>
                </template>
            </container_view>
            <container_view :loaded_at_once="false" :title="'Marine ecoregions'"
                :info_label="'imet-core::analysis_report.guidance.digital_information.marine_ecoregions'">
                <template v-slot="data">
                    <div v-if="data.props.show_view">
                        <container :loaded_at_once="true" :url=url :parameters="'{{ $pa_ids }}'"
                            :func="'get_dopa_pa_ecoregions_marine_stats'">
                            <template v-slot:default="data">
                                <div v-if="data.props">
                                    @include('imet-core::scaling_up.components.marine_ecoregions', [
                                        'name' => $name,
                                    ])
                                </div>
                            </template>
                        </container>
                    </div>
                </template>
            </container_view>
            <container_view :loaded_at_once="false" :title="'Copernicus Global Land Cover'"
                :info_label="'imet-core::analysis_report.guidance.digital_information.copernicus'">
                <template v-slot="data">
                    <div v-if="data.props.show_view">
                        <container :loaded_at_once="true" :url=url :parameters="'{{ $pa_ids }}'"
                            :func="'get_dopa_copernicus_land_cover_stats'">
                            <template v-slot:default="data">
                                <div v-if="data.props">
                                    @include('imet-core::scaling_up.components.copernicus', [
                                        'name' => $name,
                                    ])
                                </div>
                            </template>
                        </container>
                    </div>
                </template>
            </container_view>
            <container_view :loaded_at_once="false" :title="'Forest Cover'"
                :info_label="'imet-core::analysis_report.guidance.digital_information.forest_cover'">
                <template v-slot="data">
                    <div v-if="data.props.show_view">
                        <container :loaded_at_once="true" :url=url :parameters="'{{ $pa_ids }}'"
                            :func="'get_dopa_pa_all_indicators'">
                            <template v-slot:default="data">
                                <div v-if="data.props">
                                    @include('imet-core::scaling_up.components.forest_cover', [
                                        'name' => $name,
                                    ])
                                </div>
                            </template>
                        </container>
                    </div>
                </template>
            </container_view>
            <container_view :loaded_at_once="false" :title="'Protected area coverage and connectivity'"
                :info_label="'imet-core::analysis_report.guidance.digital_information.protected_area_coverage_and_connectivity'">
                <template v-slot="data">
                    <div v-if="data.props.show_view">
                        <container :loaded_at_once="true" :url=url :parameters="'{{ $pa_ids }}'"
                            :func="'get_dopa_country_indicators'">
                            <template v-slot:default="data">
                                <div v-if="data.props">
                                    @include(
                                        'imet-core::scaling_up.components.protected_area_coverage_and_connectivity',
                                        ['name' => $name]
                                    )
                                </div>
                            </template>
                        </container>
                    </div>
                </template>
            </container_view>
            <container_view :loaded_at_once="false" :title="'Land degradation'"
                :info_label="'imet-core::analysis_report.guidance.digital_information.land_degradation'">
                <template v-slot="data">
                    <div v-if="data.props.show_view">
                        <container :loaded_at_once="true" :url=url :parameters="'{{ $pa_ids }}'"
                            :func="'get_dopa_wdpa_indicators'">
                            <template v-slot:default="data">
                                <div v-if="data.props">
                                    @include('imet-core::scaling_up.components.land_degradation', [
                                        'name' => $name,
                                    ])
                                </div>
                            </template>
                        </container>
                    </div>
                </template>
            </container_view>
        </div>
    </template>
</container_section>
