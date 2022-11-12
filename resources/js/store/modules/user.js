import router from "../../router";
import axios from "axios";

const state = {
    user: null,
    editMode: false,
}

const getters = {
    user: state => state.user,
    editMode: state => state.editMode,
}

const mutations = {
    setUser(state, user) {
        state.user = user
    },

    setEditMode(state, editMode) {
        state.editMode = editMode
    },


    setSubscription(state, subscription) {
        state.user.subscriptions.push(subscription)
    },
    deleteSubscription(state, id) {
        state.user.subscriptions = state.user.subscriptions.filter(obj => obj.id !== id)
    }
}

const actions = {
    initializeUser({commit}) {
        let token = localStorage.getItem('x_xsrf_token')
        if (token) {
            axios.get('/api/init')
                .then(res => {
                    commit('setUser', res.data.data)
                })
                .catch(err => {
                    if (err.response.status === 401 || err.response.status === 419) {
                        localStorage.removeItem('x_xsrf_token')
                        router.push({name: 'auth.login'})
                    }
                })
        } else {
            router.push({name: 'auth.login'})
        }

    },
    toggleSubscribe({commit, getters}, { action , button }) {
        button.disabled = true
        if (action) {
            axios.post('/api/subscriptions', {user_id: getters.user.id, friend_id: getters.author.id})
                .then(res => {
                    commit('setSubscription', res.data.data)
                    button.disabled = false
                })
        } else {
            let subscription = getters.user.subscriptions.find(obj => obj.friend.id === getters.author.id)
            axios.delete(`/api/subscriptions/${subscription.id}`)
                .then(() => {
                    commit('deleteSubscription', subscription.id)
                    button.disabled = false
                })
        }
    },
}

export default {
    state, getters, mutations, actions
};
