import router from "../../router";
import axios from "axios";

const state = {
    loading: false,
}

const getters = {
    loading: state => state.loading,
}

const mutations = {
    setLoading(state, loading) {
        state.loading = loading
    },
}

const actions = {

}

export default {
    state, getters, mutations, actions
};
