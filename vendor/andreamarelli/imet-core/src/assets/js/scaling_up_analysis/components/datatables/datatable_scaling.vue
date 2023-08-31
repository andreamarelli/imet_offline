<template>
    <div>
        <div class="row mb-3 mt-1" style="font-size: 12px" v-if="average.length">
            <div class="col-sm align-self-center">
                {{ stores.BaseStore.localization("imet-core::analysis_report.average_explained") }}
            </div>
        </div>
        <table id="global_scores">
            <tr>
                <th v-for="(column, idx) in columns" @click="sort(column.field)"
                    :style="idx === 0 ? 'width:15%;' : 'width:11%;'">
                    {{ column.label.charAt(0).toUpperCase() + column.label.slice(1) }} {{ (column.extra_label) }} <i
                    :class="sort_icon(column.field)"/>
                </th>
            </tr>
            <tr v-for="(value, index) in items">
                <td v-if="items[index]['name'] != 'Average'" v-for="(column, idx) in columns"
                    v-html="get_value(value[column.field])"
                    :class="idx === 0 ?'' : score_class(value[column.field])"></td>
                <td v-else v-html="get_value(value[column.field])"></td>
            </tr>
        </table>
        <div class="row" style="font-size: 12px">
            <div class="col-3 text-right">
                {{ stores.BaseStore.localization("imet-core::analysis_report.scaling_legend") }} :
            </div>
            <div class="col-8">
                <div class="row">
                    <div class="col text-center" :class="score_class(null)">
                        {{ stores.BaseStore.localization("imet-core::analysis_report.no_value").toLowerCase() }}
                    </div>
                    <div class="col text-center" :class="score_class(-52)">
                        -100 {{ stores.BaseStore.localization("imet-core::analysis_report.to").toLowerCase() }} -51
                    </div>
                    <div class="col text-center" :class="score_class(-35)">
                        -50 {{ stores.BaseStore.localization("imet-core::analysis_report.to").toLowerCase() }} -34
                    </div>
                    <div class="col text-center" :class="score_class(-1)">
                        -33 {{ stores.BaseStore.localization("imet-core::analysis_report.to").toLowerCase() }} 0
                    </div>
                    <div class="col text-center" :class="score_class(10)">1
                        {{ stores.BaseStore.localization("imet-core::analysis_report.to").toLowerCase() }} 33
                    </div>
                    <div class="col text-center" :class="score_class(34)">34
                        {{ stores.BaseStore.localization("imet-core::analysis_report.to").toLowerCase() }} 50
                    </div>
                    <div class="col text-center" :class="score_class(51)">51
                        {{ stores.BaseStore.localization("imet-core::analysis_report.to").toLowerCase() }} 100
                    </div>
                </div>
            </div>
            <div class="col-1 align-self-center"></div>
        </div>

    </div>
</template>

<script>


import datatable_custom from './datatable_custom.vue';

export default {
    name: "datatable_scaling.vue",
    inject: ['stores'],
    mixins: [
        datatable_custom
    ],
    props: {
        default_order: {
            type: String,
            default: null
        },
        default_order_dir: {
            type: String,
            default: "asc"
        },
        refresh_average: {
            type: Boolean,
            default: true
        }
    },
    data: function () {
        const Locale = window.Locale;
        return {
            Locale: Locale,
            list: [],
            pageSize: 100,
            average: []
        }
    },
    computed: {
        items() {
            let items = this.list;

            items = this.filterList(items);     // from filter mixin
            if (this.refresh_average) {
                items = this.calculateAverage(items); //recalculate average
            }
            items = this.sortList(items);       // from sorter mixin
            items = this.paginateList(items);   // from paginate mixin

            return items;
        }
    },
    mounted() {
        this.sortBy = this.default_order;
        this.sortDir = this.default_order_dir;
        this.list.sort((a, b) => {
            return a.name.localeCompare(b.name)
        })
    },
    methods: {
        calculateAverage: function (items) {
            const notAverageItems = items.filter((item) => item['name'] !== 'Average')
            const averageItem = items.find((item) => item['name'] === 'Average');
            const averageItems = [];
            if (averageItem && notAverageItems.length > 0) {
                const averageObj = Object.keys(averageItem).reduce((obj, key) => {
                    obj[key] = 0;
                    averageItems[key] = 0;
                    return obj;
                }, {});

                notAverageItems.map((o, x) => {
                    const keys = Object.keys(o);
                    keys.forEach((v, k) => {
                        if (v !== 'name') {
                            if (o[v] !== '-') {
                                averageObj[v] += o[v]
                                averageItems[v]++;
                            }
                        } else {
                            averageObj[v] = "Average";
                        }
                    })
                    return o;
                });
                const keys = Object.keys(averageObj);
                keys.forEach((v, k) => {
                    if (v !== 'name') {
                        if (averageItems[v] > 0) {
                            averageObj[v] = parseFloat((averageObj[v] / averageItems[v]).toFixed(1));
                        } else {
                            averageObj[v] = '-';
                        }

                    }
                })
                notAverageItems.push(averageObj);
            }

            if (items.length === 1 && notAverageItems.length === 0) {
                return items;
            }

            return notAverageItems;
        },
        get_value: function (value) {
            if (value === "-") {
                return "";
            }
            return value;
        },
        itemLabel: function (value) {
            if (value === 'Average') {
                value = "* " + value;
            }
            if (value === "-") {
                return "";
            }
            return value;
        },
        score_class: function (value, additional_classes = '') {
            let addClass = '';

            if ([null, "-"].includes(value)) {
                addClass = 'score_no';
            } else if (value <= -51) {
                addClass = 'score_danger_alert';
            } else if (value < -33 && value > -51) {
                addClass = 'score_danger_warning';
            } else if (value <= 0) {
                addClass = 'score_danger';
            } else if (value > 0 && value < 34) {
                addClass = 'score_alert';
            } else if (value < 51) {
                addClass = 'score_warning';
            } else {
                addClass = 'score_success';
            }
            return `${addClass} ${additional_classes}`;
        },
        score_class_threats: function (value, $additional_classes = '') {
            let addClass = '';

            if (value < -51) {
                addClass = 'score_danger';
            } else if (value < -34) {
                addClass = 'score_alert';
            } else if (value < -1) {
                addClass = 'score_warning';
            } else {
                addClass = 'score_success';
            }
            return `${addClass} ${$additional_classes}`;
        }
    }
}
</script>
