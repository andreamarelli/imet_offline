<div class="module-container" id="{{$template['name']}}">
    <div class="module-header">
        <div class="module-title" @click="toggle_view()">
                      <span class="fas fa-fw carrot"
                            :class="{'fa-caret-up': !show_view,'fa-caret-down':show_view}"></span> {{ $title }}
        </div>
    </div>
    <div class="module-body collapse bg-white border-0" :class="{show: show_view}">
        <div class="align-items-center">
            <container
                    :loaded_at_once="show_view"
                    :url=url
                    :parameters="'{{$pa_ids}}'"
                    :func="'get_dopa_pa_all_indicators'"
            >
                <template slot-scope="data">
                    <div v-for="(value, index) in data.props.values" :id="'{{$name}}-'+index">
                        <div v-for="(area, idx) in value">
                            <div class="list-key-numbers horizontal">
                                <div class="list-head" v-html="idx">
                                </div>
                            </div>
                            <div class="module-body bg-white border-0">
                                <dopa_indicators_table
                                        :title=dopa_indicators.inland_cover.title_table
                                        :indicators=dopa_indicators.inland_cover.indicators
                                        :api_data="Object.assign({}, ...area)"
                                        :precision="2"
                                ></dopa_indicators_table>
                                <dopa_chart_bar
                                        :title=dopa_indicators.inland_cover.title_chart
                                        :indicators=dopa_indicators.inland_cover.bar_indicators
                                        :api_data="Object.assign({}, ...area)"
                                ></dopa_chart_bar>

                            </div>
                        </div>
                        {{--                        <action_buttons :name="'{{$name}}-'+index"--}}
                        {{--                                        :exclude_elements="'{{$exclude_elements}}'"></action_buttons>--}}
                    </div>

                </template>
            </container>
        </div>
        @include('imet-core::v2_report.scaling_up.components.action_buttons',['id' => $name])
    </div>
</div>
<style lang="scss" type="text/scss" scoped>
  .bar {
    height: 300px;
    width: 300px;
  }
</style>
<script>
    new Vue({
        el: '#{{$name}}',
        mixins: window.Report.vueMixins,
        {!! $javascript !!}
        data: {
            show_view: false,
            dopa_indicators: {
                inland_cover: {
                    title_table: 'Inland surface water',
                    title_chart: 'Area of Permanent and Seasonal Water',
                    indicators: [
                        {
                            field: 'water_p_now_km2',
                            label: 'Area [km2] of permanent surface water (2018)',
                            color: '#D9534F'
                        },
                        {
                            field: 'water_s_now_km2',
                            label: 'Area [km2] of seasonal inland water (2018)',
                            color: '#337AB7'
                        },
                        {
                            field: 'water_p_1985_km2',
                            label: 'Net change [km2] of permanent surface water (2018-1985)',
                            color: '#D9534F'
                        },
                        {
                            field: 'water_s_1985_km2',
                            label: 'Net change [km2] of seasonal inland water (2018-1985)',
                            color: '#337AB7'
                        },
                        {
                            field: 'water_p_netchange_perc',
                            label: 'Net change (%) of permanent surface water (2018-1985)',
                            color: '#D9534F'
                        },
                        {
                            field: 'water_s_netchange_perc',
                            label: 'Net change (%) of seasonal inland water (2018-1985)',
                            color: '#337AB7'
                        },
                    ],
                    bar_indicators: [
                        {
                            field: 'water_p_1985_km2',
                            label: 'Permanent Water',
                            color: '#D9534F'
                        },
                        {
                            field: 'water_s_1985_km2',
                            label: 'Seasonal Water',
                            color: '#337AB7'
                        },
                        {
                            field: 'water_p_now_km2',
                            label: 'Permanent Water',
                            color: '#D9534F'
                        },
                        {
                            field: 'water_s_now_km2',
                            label: 'Seasonal Water',
                            color: '#337AB7'
                        }
                    ]
                },
            },
        }
    });

</script>
