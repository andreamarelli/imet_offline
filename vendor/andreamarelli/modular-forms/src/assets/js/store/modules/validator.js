// initial state
const state = {
    validation_errors : [],
};

// getters
const getters = {

};

// mutations
const mutations = {

    /**
     * Register an invalid module
     * @param state
     * @param $data
     */
    registerInvalidModule: (state, $data) => {
        state.validation_errors.push($data);
    },

    /**
     * Register a module as fixed
     * @param state
     * @param $data
     */
    registerFixedModule: (state, $data) => {
        state.validation_errors.forEach(function(item, index){
            if(item.key===$data){
                state.validation_errors.splice(index, 1);
            }
        });
    }

};

export default {
    namespaced: true,
    state,
    getters,
    mutations,
}