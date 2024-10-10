export const commonProps = {
    title: {
        type: String,
        default: ''
    },
    width: {
        type: Number,
        default: 180
    },
    height: {
        type: Number,
        default: 180
    },
    values: {
        type: Object,
        default: () => {
        }
    },
    indicators: {
        type: [Array, Object],
        default: () => {
        }
    },
    show_legends: {
        type: Boolean,
        default: false
    },
    single: {
        type: Boolean,
        default: true
    },
    showOnlyScaling: {
        type: Boolean,
        default: false
    },
    unselect_legends_on_load: {
        type: Boolean,
        default: false
    },
    radar_indicators_for_negative: {
        type: Array,
        default: () => {
            return [];
        }
    },
    radar_indicators_for_zero_negative: {
        type: Array,
        default: () => {
            return [];
        }
    },
    always_first_in_legend: {
        type: Array,
        default: () => {
            return [0, 1, 2];
        }
    },
    refresh_average: {
        type: Boolean,
        default: true
    },
    event_key: {
        type: String,
        default: ''
    }
  };
