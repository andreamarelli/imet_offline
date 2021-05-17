export default {

    props: {
        api_data : {
            type: [Object, Array],
            default: () => {}
        },
        regional: {
            type: Boolean,
            default: false
        }
    },

    filters: {

        pretty_number(value, precision = 0){
            value = Number(parseFloat(value).toFixed(precision));
            return isNaN(value)
                ? '-'
                : value.toLocaleString('fr-FR');  // french notation
        }

    },

    data: function () {
        return {
            Locale: window.Locale
        }
    }


}
