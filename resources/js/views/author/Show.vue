<template>
    <div class="author-page">
        <template v-if="!this.loading">
            <AuthorInfoComponent v-model="postsStatus" :author="this.author"></AuthorInfoComponent>
            <template v-if="postsStatus">
                <PostListComponent v-if="this.posts.length > 0" :posts="this.posts"></PostListComponent>
                <template v-else>
                    <div class="no-items">No such posts...</div>
                </template>
            </template>
        </template>
        <PreloaderComponent v-if="this.loading"></PreloaderComponent>
    </div>
</template>

<script>
import {mapGetters} from "vuex";
import AuthorInfoComponent from "../../components/AuthorInfoComponent.vue";
import PostListComponent from "../../components/PostListComponent.vue";
import PreloaderComponent from "../../components/PreloaderComponent.vue";

export default {
    name: "Show",
    data() {
        return {postsStatus: false}
    },
    mounted() {
        debugger
        let author_id = Number(this.$route.params.id)
        this.$store.dispatch('getAuthor', author_id)
        this.$store.dispatch('getAuthorPosts', author_id)
    },
    computed: {
        ...mapGetters({
            author: 'author',
            posts: 'authorPosts',
            loading: 'loading'
        }),
    },
    components: {
        PreloaderComponent,
        PostListComponent,
        AuthorInfoComponent
    },
    methods: {},

}
</script>

<style scoped>
.no-items {
    background-color: rgba(0, 0, 0, 0.8);
    color: #00760f;
    padding: 15px;
}
</style>
