const state = {
    components: []
};

const getters = {
    is_component_visible: (state) => (component) => {
        return state.components.includes(component);
    }
};

const mutations = {

    toggle(state, component){
        if(state.components.includes(component)){
            this.commit('visible_components/hide', component);
        } else {
            this.commit('visible_components/show', component);
        }
    },

    show(state, component){
        state.components.push(component);
    },

    hide(state, component){
        if(state.components.includes(component)){
            state.components.splice(state.components.indexOf(component), 1);
        }
    }
};

export default {
    namespaced: true,
    state,
    getters,
    mutations
}
