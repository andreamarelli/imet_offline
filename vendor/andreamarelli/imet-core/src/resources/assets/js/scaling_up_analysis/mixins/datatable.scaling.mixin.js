export default {
    props: {
        rows: {
            type: [Array, Object],
            default: null
        },
        columns: {
            type: [Array, Object],
            default: null
        }
    },
    mounted() {

        Object.entries(this.rows).forEach(([key, value]) => {
            const object = {};

            this.columns.forEach((value2) => {
                if (value[value2.field] !== 'undefined') {
                    if (value2['type'] && value2['type'] === 'percentage') {
                        object[value2.field] = this.percentage(value[value2.field], value2.color);
                    } else if (value2['type'] && value2['type'] === 'color') {
                        object[value2.field] = this.colorArea(value[value2.field]);
                    } else if (value2['type'] && value2['type'] === 'value_in_area_with_color') {
                        object[value2.field] = this.colorArea(value2.color, value[value2.field]);
                    } else {
                        object[value2.field] = value[value2.field];
                    }

                }
            });
            this.dataSend.push(object);
        })
    },
    methods: {
        percentage: function (value, color) {
            return `${value} <br/><div class="progress"><div class="progress-bar" style="width: ${value}%; background-color: ${color}"></div></div>`;
        },
        colorArea: function (color, value = '') {
            return `<div class="p-3 mb-2 " style="background-color: ${color}">${value}</div>`;
        }
    }
}