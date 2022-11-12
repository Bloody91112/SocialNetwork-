<template>
    <div v-if="post" class="card custom-card mb-3">
        <div class="card-header">
            <a href="#" class="title">{{ post.title }}</a>
            <span class="tag-list" v-if="post.tags.length > 0">
                <a href="#" class="tag" v-for="tag in post.tags">{{ tag.name }}</a>
            </span>

            <button @click="deletePost" class="deletePost" v-if="myPost">delete</button>

            <div v-if="post.category" class="category">
                <a href="#">{{ post.category.name }}</a>
            </div>
        </div>
        <div class="card-body">
            {{ post.content }}
        </div>
        <div class="card-footer">
            <div class="card-footer-data">
                <div class="left">
                    <router-link :to="{ name: 'author.show', params: { id: post.user.id } }" class="author">
                        {{ post.user.name }}
                    </router-link>
                    <span class="subscribed" v-if="subscribed">subscribed</span>
                    <span class="date">{{ post.created_at }}</span>
                </div>
                <div class="right">
                    <button @click.prevent="toggleLike" :class="{ 'active' : likeStatus  }" class="likes">
                        <span>Likes:</span>
                        <span class="count">{{ post.likes ? post.likes.length : 0 }}</span>
                    </button>
                    <button @click="commentBarStatus = !commentBarStatus" :class="{ 'active' : commentBarStatus  }"
                            class="comments">
                        Comments:
                        <span class="count">{{ post.comments ? post.comments.length : 0 }}</span>
                    </button>
                </div>
            </div>
        </div>
        <Transition name="fade">
            <div class="card-footer" v-if="commentBarStatus">
                <PostCommentComponent :post_id="post.id" :comments="post.comments"></PostCommentComponent>
            </div>
        </Transition>
    </div>
</template>

<script>
import {mapGetters} from "vuex";

import PostCommentComponent from "./PostCommentComponent.vue";

export default {
    name: "PostItemComponent",
    props: ['post'],
    data() {
        return {
            commentBarStatus: false,
        }
    },
    computed: {
        ...mapGetters({
            user: 'user',
            postLikes : 'postLikes'
        }),

        likeStatus() {return !!this.postLikes(this.post.id).find(obj => obj.user_id === this.user.id)},
        subscribed() { return !!this.user.subscriptions.find(obj => obj.friend.id === this.post.user.id) },
        myPost() { return this.post.user.id === this.user.id }
    },
    methods: {
        toggleLike(event) {
            this.$store.dispatch('toggleLike', {
                post_id: this.post.id,
                status: this.likeStatus,
                user: this.$store.getters.user,
                button: event.currentTarget
            })
        },
        deletePost() { this.$store.dispatch('deletePost', {post_id: this.post.id}) }
    },
    components: {
        PostCommentComponent
    }
}
</script>

<style scoped>
.active {
    border-color: #00b01b !important;
}

.deletePost {
    position: absolute;
    right: 10px;
    top: 5px;
    border: none;
    background-color: black;
    color: #00760f;
    border-radius: 5px;
    font-size: 11px;
    text-transform: uppercase;
    font-weight: bold;
}
</style>
