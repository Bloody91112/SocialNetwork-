import router from "../../router";
import axios from "axios";

const state = {
    categories: [],
}

const getters = {
    categories: state => state.categories,
}

const mutations = {
    setCategories(state, categories) {
        state.categories = categories
    },
}

const actions = {
    getCategories({commit}){
        axios.get('/api/categories')
            .then( res  => { commit('setCategories', res.data.data) })
    }
}

export default {
    state, getters, mutations, actions
};
