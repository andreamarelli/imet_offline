export default {filters: {

        pretty_number(value, precision = 0){
            value = Number(parseFloat(value).toFixed(precision));
            return isNaN(value)
                ? '-'
                : value.toLocaleString('fr-FR');  // french notation
        }

    }
};
