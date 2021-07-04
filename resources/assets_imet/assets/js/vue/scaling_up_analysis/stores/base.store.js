export default class BaseStore {

    constructor(args) {
        this.protected_areas = null;
        this.is_country = null;
        this.scaling_up_id = args.scaling_up_id;
        this.init();
    }

    init(){

    }

    is_country_enabled() {
        return this.is_country;
    }

    toggle_country_enabled() {
        return this.is_country != this.is_country;
    }

    add_color_to_value(values, id, colors) {
        const color_items = [];
        const items = Object.values(values);
        items.forEach(item => {
            const color = colors.filter(c => c[id])
            color_items.push({value: item, itemStyle: {color: color[0][id]}});
        })
        return color_items;
    }

    add_color_to_value_by_cat(values, id, indicators, colors) {
        const items = Object.values(values.Average);
        return items;
    }

    add_color_to_value_rel(values, colors) {
        if (!values.Average) {
            return {};
        }
        const items = Object.values(values.Average);

        items.forEach((item, idx) => {
            values.Average[idx] = {value: item, itemStyle: {color: colors[idx]}};
        });

        return values;
    }

    parse_indicators(indicators) {
        return Object.values(indicators);
    }

    is_visible(values) {
        if(typeof values === 'undefined'){
            return false;
        }
        return Object.keys(values).length;
    }

    localization(value) {
        return window.Locale.getLabel(value);
    }
}
