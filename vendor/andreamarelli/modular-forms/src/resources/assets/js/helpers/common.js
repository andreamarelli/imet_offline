export default {

    isEmpty(value){
        return value === ''
           || value === '{}'
           || value === {}
            || value === '[]'
           || value === []
           || value === null;
    },

    isNumeric(value) {
        if(typeof value === 'string'){
            value = value.replace(' ', '');
        }
        return !(this.isEmpty(value)
            || value === false
            || isNaN(value));
    },

    pretty_number(value, precision = 0){
        value = Number(parseFloat(value).toFixed(precision));
        return isNaN(value)
            ? '-'
            : value.toLocaleString('fr-FR');  // french notation
    },

    isValidJSON(value){
        try {
            JSON.parse(value);
        } catch (e) {
            return false;
        }
        return true;
    }

}
