export const common = {
    width: {
        type: String,
        default: "100%"
    },
    height: {
        type: String,
        default: "500px"
    },
    values: {
        type: [Array, Object],
        default: () => {}
    },
    colors: {
        type: [Array, Object],
        default: null
    },
    axis_dimensions_x: {
        type: Object,
        default: () => {}
    },
    axis_dimensions_y: {
        type: Object,
        default: () => {}
    },
    title: {
        type: String,
        default: ""
    }
}


export const commonProps = {
    fields: {
        type: Array,
        default: () => {
        }
    },
    rotate: {
        type: Number,
        default: 0
    },
    zoom: {
        type: Boolean,
        default: false
    },
    series_data: {
        type: Object,
        default: () => {
        }
    },
    title_data: {
        type: String,
        default: ''
    }
};
