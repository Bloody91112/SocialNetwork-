import router from "../../router";
import axios from "axios";

const state = {
    posts: [],
    postsMode: null,
    createFormStatus: false,
    visibleComment: null,
}

const getters = {
    posts: state => state.posts,
    post: (state) => (id) => {
        return state.posts.find(post => post.id === id)
    },
    postLikes: (state, getters) => (post_id) => {
        return getters.post(post_id).likes
    },
    postsMode: state => state.postsMode,
    createFormStatus: state => state.createFormStatus,
    visibleComment: state => state.visibleComment,
}

const mutations = {
    setPosts(state, posts) {
        state.posts = posts
    },
    setLike(state, {post_id, like}) {
        state.posts = state.posts.map(statePost => {
            if (statePost.id === post_id) {
                statePost.likes = [...statePost.likes, like]
            }
            return statePost
        })
    },
    removeLike(state, {post_id, user}) {
        state.posts = state.posts.map(statePost => {
            if (statePost.id === post_id) {
                statePost.likes = statePost.likes.filter(like => like.user_id !== user.id)
            }
            return statePost
        })
    },
    setCreateFormStatus(state, createFormStatus) {
        state.createFormStatus = createFormStatus
    },
    setPostsMode(state, postsMode) {
        state.postsMode = postsMode
    },
    setVisibleComment(state, visibleComment) {
        state.visibleComment = visibleComment
    },
    addComment(state, {post_id, comment}) {
        state.posts = state.posts.map(statePost => {
            if (statePost.id === post_id) {
                statePost.comments = [...statePost.comments, comment]
            }
            return statePost
        })
    },
    deleteComment(state, {post_id, comment_id}) {
        state.posts = state.posts.map(statePost => {
            if (statePost.id === post_id) {
                statePost.comments = statePost.comments.filter(comment => comment.id !== comment_id)
            }
            return statePost
        })
    },
    deletePost(state, {post_id}) {
        state.posts = state.posts.filter(statePost => statePost.id !== post_id)
    }
}

const actions = {
    getPosts({commit, getters, dispatch}) {
        if (getters.postsMode != null) {
            dispatch('getSortedPosts', getters.postsMode)
        } else {
            commit('setLoading', true)
            axios.get('/api/posts')
                .then(response => {
                    commit('setPostsMode', 'all')
                    commit('setPosts', response.data.data)
                    commit('setLoading', false)
                })
        }

    },
    toggleCreateForm({commit, state}) {
        router.push({name: 'post.index'})
        let content = document.querySelector('.app-content')
        if (!state.createFormStatus) content.scrollTo({top: 0, behavior: 'smooth'})
        commit('setCreateFormStatus', !state.createFormStatus)
    },
    createPost({state, commit}, payload) {
        axios.post('/api/posts', payload)
            .then(res => {
                state.posts.unshift(res.data.data)
            })
    },
    deletePost({commit}, {post_id}) {
        axios.delete(`/api/posts/${post_id}`)
            .then(() => {
                commit('deletePost', {post_id})
            })
    },
    getSortedPosts({commit}, sortValue) {
        commit('setLoading', true)
        commit('setAuthorPosts', null)
        commit('setPostsMode', sortValue)
        axios.post('/api/posts/sort', {sortValue: sortValue})
            .then(res => {
                router.push({name: 'post.index'})
                commit('setPosts', res.data.data)
                commit('setLoading', false)
                document.querySelector('.app-content').scrollTo({top: 0, behavior: 'smooth'})
            })
    },
    toggleLike({commit, getters, state}, {post_id, status, user, button}) {
        button.disabled = true
        if (status) {
            let like = getters.postLikes(post_id).find(likes => likes.user_id === user.id)
            axios.delete(`/api/likes/${like.id}`)
                .then(() => {
                    commit('removeLike', {post_id, user})
                    button.disabled = false
                })
        } else {
            axios.post('/api/likes', {post_id: post_id, user_id: user.id})
                .then((res) => {
                    let like = res.data.data
                    commit('setLike', {post_id, like})
                    button.disabled = false
                })
        }
    },
    createComment({commit}, {post_id, user_id, content}) {
        axios.post('/api/comments', {post_id: post_id, user_id: user_id, content: content})
            .then((res) => {
                commit('addComment', {comment: res.data.data, post_id: post_id})
            })
    },
    deleteComment({commit}, {comment}) {
        axios.delete(`/api/comments/${comment.id}`)
            .then(() => {
                commit('deleteComment', {post_id: comment.post_id, comment_id: comment.id})
            })
    },

    searchPosts({commit}, value) {
        router.push({name: 'post.index'})
        commit('setLoading', true)
        axios.post('/api/posts/filter', {content: value , title: value })
            .then(res => {
                commit('setPosts', res.data.data)
                commit('setLoading', false)
            })
    }

}

export default {
    state, getters, mutations, actions
};
