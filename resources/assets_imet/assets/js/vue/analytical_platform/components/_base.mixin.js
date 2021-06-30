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
        },

        country_names(value) {
            return (typeof value !== 'undefined' && value.length > 0)
                ? value.join(', ')  : null
        }

    },

    data: function () {
        return {
            Locale: window.Locale,
            visible_hidden_components: []
        }
    },

    mounted(){
        let _this = this;

        // call toggle functions
        window.vueBus.$on('toggle_hidden_component', function (component) {
            _this.toggle_hidden_component(component);
        });
    },

    methods:{
        toggle_hidden(component){
            window.vueBus.$emit('toggle_hidden_component', component);
        },
        is_hidden_component_visible(component){
            return this.visible_hidden_components.includes(component);
        },
        toggle_hidden_component(component){
            if(this.visible_hidden_components.includes(component)){
                this.visible_hidden_components.splice(this.visible_hidden_components.indexOf(component), 1);
            } else {
                this.visible_hidden_components.push(component);
            }
        },
    }



}
