<container_section :id="'{{$name}}'" :title="'{{$title}}'" :code="'{{$code}}'"
                   :guidance="'{{trans('imet-core::analysis_report.guidance.additional_options.main')}}'">
    <template slot-scope="container">
        <div class="row">
            <div class="col-sm">
                <div class="align-items-center">
                    <container_view
                        :loaded_at_once="true"
                        :title="'Management effectiveness analysis'"
                        :guidance="'{{trans('imet-core::analysis_report.guidance.additional_options.management_effectiveness')}}'">
                        <template slot-scope="data" class="col-24">
                            @include('imet-core::scaling_up.components.management_effectiveness_analysis', ['name' => $name])
                        </template>
                    </container_view>
                    <container_view
                        :loaded_at_once="true"
                        :title="'Summary of key elements affecting the management elements'"
                        :guidance="'{{trans('imet-core::analysis_report.guidance.additional_options.specific_actions_mention')}}'">
                        <template slot-scope="data" class="col-24">
                            @include('imet-core::scaling_up.components.specific_actions_mention', ['name' => $name])
                        </template>
                    </container_view>
                    <container_view
                        :loaded_at_once="false"
                        :title="'Total carbon'"
                        :url=url
                        :parameters="'{{$pa_ids}}'"
                        :func="'getTotalCarbon'"
                        :guidance="'{{trans('imet-core::analysis_report.guidance.additional_options.total_carbon')}}'">
                        <template slot-scope="data">
                            @include('imet-core::scaling_up.components.total_carbon', ['name' => $name])
                        </template>
                    </container_view>
                    <container_view
                        :loaded_at_once="false"
                        :title="'Terestial ecoregions'"
                        :url=url
                        :parameters="'{{$pa_ids}}'"
                        :func="'get_dopa_pa_ecoregions_terrestial_stats'"
                        :guidance="'{{trans('imet-core::analysis_report.guidance.additional_options.terestial_ecoregions')}}'">
                        <template slot-scope="data" class="contailer">
                            @include('imet-core::scaling_up.components.terestial_ecoregions', ['name' => $name])
                        </template>
                    </container_view>
                    <container_view
                        :loaded_at_once="false"
                        :url=url
                        :title="'Marine ecoregions'"
                        :parameters="'{{$pa_ids}}'"
                        :func="'get_dopa_pa_ecoregions_marine_stats'"
                        :guidance="'{{trans('imet-core::analysis_report.guidance.additional_options.marine_ecoregions')}}'">
                        <template slot-scope="data">
                            @include('imet-core::scaling_up.components.marine_ecoregions', ['name' => $name])
                        </template>
                    </container_view>
                    <container_view
                        :loaded_at_once="false"
                        :title="'Copernicus Global Land Cover'"
                        :url=url
                        :parameters="'{{$pa_ids}}'"
                        :func="'get_dopa_copernicus_land_cover_stats'"
                        :guidance="'{{trans('imet-core::analysis_report.guidance.additional_options.copernicus')}}'">
                        <template slot-scope="data">
                            @include('imet-core::scaling_up.components.copernicus', ['name' => $name])
                        </template>
                    </container_view>
                    <container_view
                        :loaded_at_once="false"
                        :title="'Forest Cover'"
                        :url=url
                        :parameters="'{{$pa_ids}}'"
                        :func="'get_dopa_pa_all_indicators'"
                        :guidance="'{{trans('imet-core::analysis_report.guidance.additional_options.forest_cover')}}'">
                        <template slot-scope="data">
                            @include('imet-core::scaling_up.components.forest_cover', ['name' => $name])
                        </template>
                    </container_view>
                    <container_view
                        :loaded_at_once="false"
                        :url=url
                        :title="'Protected area coverage and connectivity'"
                        :parameters="'{{$pa_ids}}'"
                        :func="'get_dopa_country_indicators'"
                        :guidance="'{{trans('imet-core::analysis_report.guidance.additional_options.protected_area_coverage_and_connectivity')}}'">
                        <template slot-scope="data">
                            @include('imet-core::scaling_up.components.protected_area_coverage_and_connectivity', ['name' => $name])
                        </template>
                    </container_view>
                    <container_view
                        :loaded_at_once="false"
                        :title="'Land degradation'"
                        :url=url
                        :parameters="'{{$pa_ids}}'"
                        :func="'get_dopa_wdpa_indicators'"
                        :guidance="'{{trans('imet-core::analysis_report.guidance.additional_options.land_degradation')}}'">
                        <template slot-scope="data">
                            @include('imet-core::scaling_up.components.land_degradation', ['name' => $name])
                        </template>
                    </container_view>
                </div>
            </div>
        </div>
    </template>
</container_section>
