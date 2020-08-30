const state = {
    all_concept_votes: 0,
    register: {
        mode: '',
        base: {
            concept_id: '',
            concept_layer: ''
        }
    }
};

const mutations = {
    conceptRegister(state, {
        mode,
        concept
    }) {
        state.register.mode = mode
        state.register.base = concept
    },
    setAllConceptVotes(state, value) {
        state.all_concept_votes = value
    }
};

const actions = {
    conceptRegister(context, {
        mode,
        concept
    }) {
        context.commit('conceptRegister', {
            mode: mode,
            concept: concept
        })
    },
    getAllConceptVotes(context, user_id) {
        axios.get('/ajax/query/allConceptVotes', {
                params: {
                    user_id: user_id
                }
            })
            .then(function(response) {
                context.commit('setAllConceptVotes', response.data)
            }.bind(this))
            .catch(function(error) {
                console.log(error);
            });
    }
}

export default {
    namespaced: true,
    state,
    mutations,
    actions
};
