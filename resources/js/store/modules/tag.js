import router from "../../router";
import axios from "axios";

const state = {
    tags: [],
}

const getters = {
    tags: state => state.tags,
}

const mutations = {
    setTags(state, tags) {
        state.tags = tags
    },
}

const actions = {
    getTags({commit}){
        axios.get('/api/tags')
            .then( res  => { commit('setTags', res.data.data) })
    }
}

export default {
    state, getters, mutations, actions
};
