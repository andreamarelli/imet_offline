// initial state
const state = {
    is_admin: false,
};

// getters
const getters = {

};

// mutations
const mutations = {
    toggle_admin: (state, value) => {
        state.is_admin = value==='true' || value===true;
    },

};

export default {
    namespaced: true,
    state,
    getters,
    mutations,
}