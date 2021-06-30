<div class="module-container" id="{{$template['name']}}">
    <div class="module-header">
        <div class="module-title" @click="toggle_view()">
                      <span class="fas fa-fw carrot"
                            :class="{'fa-caret-up': !show_view,'fa-caret-down':show_view}"></span> {{ $title }}
        </div>
    </div>
    <div class="module-body collapse" :class="{show: show_view}">
        <div class="align-items-center">
            <container
                    :loaded_at_once="show_view"
                    :url=url
                    :parameters="'{{$pa_ids}}'"
                    :func="'get_dopa_pa_all_indicators'"
            >
                <template slot-scope="data">
                    <div v-for="(value, index) in data.props.values">
                        <div v-for="(area, idx) in value">
                            <div class="list-key-numbers horizontal">
                                <div class="list-head" v-html="idx">
                                </div>
                            </div>
                            <div class="module-body">
                                <dopa_indicators_table
                                        :title=dopa_indicators.forest_cover.title_table
                                        :indicators=dopa_indicators.forest_cover.indicators
                                        :api_data="Object.assign({}, ...area)"
                                        :precision="2"
                                ></dopa_indicators_table>
                                <dopa_chart_bar
                                        :title=dopa_indicators.forest_cover.title_chart
                                        :indicators=dopa_indicators.forest_cover.bar_indicators
                                        :api_data="Object.assign({}, ...area)"
                                ></dopa_chart_bar>
                            </div>
                        </div>
                        <action_buttons :name="'{{$name}}-'+index"
                                        :exclude_elements="'{{$exclude_elements}}'"></action_buttons>
                    </div>
                </template>
            </container>
        </div>
        @include('admin.imet.v2.report.scaling_up.components.action_buttons',['id' => $name])
    </div>
</div>

<script>
    new Vue({
        el: '#{{$name}}',
        mixins: window.Report.vueMixins,
        {!! $javascript !!}
        data: {
            show_view: false,
            dopa_indicators: {
                forest_cover: {
                    title_table: 'Forest Cover',
                    title_chart: 'Forest loss and gain (%)',
                    indicators: [
                        {
                            field: 'gfc_treecover_km2',
                            label: 'Forest cover [km2]',
                            color: '#5b5b5b'
                        },
                        {
                            field: 'gfc_treecover_perc',
                            label: 'Forest cover [%]',
                            color: '#5b5b5b'
                        },
                        {
                            field: 'gfc_loss_km2',
                            label: 'Forest loss [km2]',
                            color: '#D9534F'
                        },
                        {
                            field: 'gfc_loss_perc',
                            label: 'Forest loss [%]',
                            color: '#D9534F'
                        },
                        {
                            field: 'gfc_gain_km2',
                            label: 'Forest gain [km2]',
                            color: '#337AB7'
                        },
                        {
                            field: 'gfc_gain_perc',
                            label: 'Forest gain [%]',
                            color: '#337AB7'
                        },
                    ],
                    bar_indicators: [
                        {
                            field: 'gfc_loss_perc',
                            label: 'Forest loss [%]',
                            color: '#D9534F'
                        },
                        {
                            field: 'gfc_gain_perc',
                            label: 'Forest gain [%]',
                            color: '#337AB7'
                        }
                    ]
                }
            }
        }
    });

</script>