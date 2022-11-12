import router from "../../router";
import axios from "axios";

const state = {
    author: null,
    authorPosts: null
}

const getters = {
    author: state => state.author,
    authorPosts: state => state.authorPosts,
}

const mutations = {
    setAuthor(state, author) {
        state.author = author
    },
    setAuthorPosts(state, authorPosts) {
        state.authorPosts = authorPosts
    },

}

const actions = {
    getAuthor({commit}, author_id) {
        commit('setLoading', true)
        axios.get(`/api/users/${author_id}`)
            .then(res => {
                commit('setAuthor', res.data.data)
                commit('setLoading', false)
            })
    },
    getAuthorPosts({commit}, author_id) {
        commit('setLoading', true)
        axios.post('/api/posts/filter', {user_id: author_id})
            .then(res => {
                commit('setPosts', res.data.data)
                commit('setAuthorPosts', res.data.data)
                commit('setLoading', false)
            })
    },
    editAvatar({commit, getters}, file){
        let avatar = new FormData();
        avatar.append('avatar', file[0])
        axios.post(`/api/user/image/${getters.author.id}`, avatar)
            .then( res => {
                commit('setAuthor', res.data.data)
            })
    },
    editProfile( { commit, getters }, payload ) {
        debugger
        axios.patch(`/api/users/${getters.author.id}`, payload)
            .then( res => {
                debugger
                commit('setAuthor', res.data.data)
            })
    }
}

export default {
    state, getters, mutations, actions
};
