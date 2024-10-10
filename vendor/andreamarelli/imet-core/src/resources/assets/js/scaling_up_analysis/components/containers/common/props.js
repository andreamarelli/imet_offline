export const commonProps = {
    loaded_at_once: {
        type: Boolean,
        default: false
    },
    url: {
        type: String,
        default: ''
    },
    method: {
        type: String,
        default: 'POST'
    },
    parameters: {
        type: Array,
        default: []
    },
    func: {
        type: String,
        default: ''
    },
    show_menu: {
        type: Boolean,
        default: false
    },
    title: {
        type: String,
        default: ''
    }
  };
