import { ref } from 'vue';

export function useRadar(component_data) {
    const always_first_in_legend = component_data.always_first_in_legend;
    const radar_indicators_for_negative = component_data.radar_indicators_for_negative;
    const radar_indicators_for_zero_negative = component_data.radar_indicators_for_zero_negative;
    const show_legends = component_data.show_legends;
    const showOnlyScaling = component_data.showOnlyScaling;
    const items = component_data.values;
    const indicators = component_data.indicators;
    const setIndicatorsFunction = component_data.setIndicatorsFunction ?? setIndicators;
    const legend_selected = component_data.legend_selected || [];
    const chart = component_data.chart || ref(null);

    function createItemsForScalingNumbers() {
        const render_items = [];
        if (showOnlyScaling) {
            const indi_length = indicators.length;
            indicators.forEach((i, k) => {
                const item = radar_item();
                item.value = new Array(indi_length).fill(0);
                item.value[0] = (20 * (k));
                item.lineStyle.color = 'rgba(255, 255, 255, 0)';

                render_items.push(item);
            })
        }

        return render_items;
    }

    function radar_item() {
        return {
            value: [],
            name: '',
            itemStyle: {
                color: null
            },
            lineStyle: {
                type: 'solid',
                color: null
            },
            label: {
                normal: {
                    fontWeight: 'bold',
                    color: '#222',
                    show: true
                }
            }
        }
    }

    function multipleData() {
        let indi = [];
        let legends = [];
        const render_items = [];
        const calculatedValues = items;
        if (show_legends) {
            legends = setLegends(calculatedValues);
        }
        const negative_indicators = [];
        const values = JSON.parse(JSON.stringify(calculatedValues));

        Object.entries(values).forEach((data, key) => {
            const item = radar_item();
            const name = data.shift();
            item.name = name;
            Object.entries(data)
                .forEach(([key, value]) => {
                    if (value === Object(value)) {
                        if (showOnlyScaling) {
                            item.label.normal.show = value.label_show ?? true;
                        }
                        item.symbolSize = 0;
                        item.lineStyle.type = value?.lineStyle;
                        item.lineStyle.width = value?.width;
                        item.lineStyle.color = value?.color;
                        item.itemStyle.color = value?.color;
                        if (value.legend_selected) {
                            legend_selected.push(name)
                        }
                        item.tooltip = {
                            trigger: 'item'
                        };
                        //todo check it again
                        delete value['lineStyle'];
                        delete value['color'];
                        delete value['width'];
                        delete value['wdpa_id'];
                        delete value['legend_selected'];

                        indi = Object.values(value);
                    }
                    const index = find_if_array_has_negative_values(indi);
                    if (index > -1) {
                        negative_indicators.push(index);
                    }

                    item.value = indi;

                });
            render_items.push(item);
        });
        indi = setIndicatorsFunction();
        render_items.push(...createItemsForScalingNumbers());

        render_items.map(item => {
            if (item.tooltip) {
                item.tooltip.formatter = (params, ticket) => {
                    let html = '';
                    html = params.data.name + "<br/>";
                    for (const val in params.data.value) {
                        if (indi[val] !== undefined) {
                            html += indi[val]?.text + " : " + params.value[val] + "<br/>";
                        }
                    }
                    return html
                };
            }
            return item;
        });
        return {render_items, legends, indicators: indi};
    }

    function setLegends(values = {}) {
        const legends_items = [];
        if (!values) {
            values = items;
        }
        Object.entries(values)
            .reverse()
            .forEach(([key, value]) => {
                legends_items.push({name: key});
            });
        let on_top = [];
        if (always_first_in_legend.length) {
            on_top = legends_items.slice(0, 3)
        }
        return legends([...on_top, ...legends_items.sort((a, b) => a.name.localeCompare(b.name))]);
    }

    function singleData() {
        const render_items = [];
        const item = radar_item();
        const indi = [];
        let legends = [];
        Object.entries(items).reverse().forEach((data, key) => {
            indi.push({text: data[0].replace(' ', '\n'), max: 100});
            item.value.push(data[1]);
        });
        render_items.push(item);
        return {render_items, legends, indi};
    }

    function find_if_array_has_negative_values(array) {
        return array.findIndex(value => ((value !== "-" ? value < 0 : false)));
    }

    function legends(legends = null) {
        if (!legends) {
            return null;
        }
        return {
            legend: {
                formatter: function (name) {
                    if (name === 'Average') {
                        return `* ${name}`;
                    }
                    return name;
                },
                data: legends,
                padding: [35, 5, 10, 5]
            }

        }
    }

    function colors(colors) {
        return colors;
    }

    function setIndicators() {
        if (!indicators?.length) {
            return [];
        }
        return indicators.map((value, key) => {
            const item = {
                text: value.replace(' ', '\n'), max: 100
            }

            if (radar_indicators_for_negative.includes(key)) {
                item.max = 100;
                item.min = -100;
                item.text += ` \n ${window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.scale.negative_positive')} `;
            }

            if (radar_indicators_for_zero_negative.includes(key)) {
                item.max = 0;
                item.min = -100;
                item.text += ` \n ${window.ModularForms.Helpers.Locale.getLabel('imet-core::analysis_report.scale.zero_negative')}`;
            }
            return item;
        });
    }

    function unselect_all_legends(legends, chartScaling) {
        legends.forEach(legend => {
            if (!legend_selected.includes(legend.name)) {
                chartScaling.dispatchAction({
                    type: 'legendUnSelect',
                    name: legend.name
                });
            }
        })
    }

    function calculateAverage(list_items, legends, values) {
        let average = list_items.find((item) => item.name === "Average")?.value.map(v => 0)
        const averageItems = [...average ?? []];
        if (average) {
            list_items.forEach((item, index) => {
                if (!['Average', 'upper limit', 'lower limit'].includes(item['name']) && legends.selected[item['name']] === true) {
                    item['value'].forEach((val, i) => {
                        if (val !== '-') {
                            averageItems[i]++;
                            average[i] += val;
                        }
                    });
                }
            });

            average?.forEach((value, index) => {
                if (averageItems[index] > 0) {
                    average[index] = parseFloat((average[index] / averageItems[index]).toFixed(1));
                } else {
                    average[index] = "-";
                }
            });

            if (average?.every(i => i === '-')) {
                if(values && values['Average']){
                    average = values['Average'];
                    delete average['color'];
                    delete average['legend_selected']
                }
            }

            list_items.map((item) => {
                if (item['name'] === 'Average') {
                    item['value'] = Object.values(average);
                }
                return item;
            });
        }

        return list_items;
    }

    return {chart, singleData, multipleData, unselect_all_legends, calculateAverage}
}
