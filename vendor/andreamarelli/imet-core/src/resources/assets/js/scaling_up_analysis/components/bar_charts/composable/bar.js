import {ref} from "vue";

export function useBar(component_data) {
    const zoom = component_data.zoom;
    const colors = component_data.colors;
    const fields = component_data.fields;

    function has_zoom() {
        if (zoom) {
            return {
                dataZoom: [
                    {
                        show: true,
                        start: 0,
                        end: 100
                    }
                ]
            }
        }
        return {};
    }

    function get_colors() {
        if (colors === null) {
            return {};
        }
        return {colors}
    }

    function field_name() {
        return fields.map(field => {
            return field;
        })
    }


    return {
        has_zoom,
        get_colors,
        field_name
    }
}
