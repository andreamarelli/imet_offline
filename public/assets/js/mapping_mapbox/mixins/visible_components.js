export default {

    methods: {

        toggle_component(component){
            this.$store.commit('visible_components/toggle', component);
        },

        show_component(component){
            this.$store.commit('visible_components/show', component);
        },

        hide_component(component){
            this.$store.commit('visible_components/hide', component);
        },

        is_component_visible: function(component){
            return this.$store.getters['visible_components/is_component_visible'](component)
        },

    }

}
