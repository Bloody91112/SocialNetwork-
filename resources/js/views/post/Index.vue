<template>
    <div class="posts-page">
        <template v-if="!this.loading">
            <PostFormComponent></PostFormComponent>
            <template v-if="this.posts.length > 0">
                <PostListComponent :posts="this.posts"></PostListComponent>
            </template>
            <template v-else>
                <div class="no-items">No such posts...</div>
            </template>
        </template>

        <PreloaderComponent v-if="this.loading"></PreloaderComponent>
    </div>

</template>

<script>
import PostListComponent from "../../components/PostListComponent.vue";
import PostFormComponent from "../../components/PostFormComponent.vue";
import PreloaderComponent from "../../components/PreloaderComponent.vue";
import {mapGetters} from "vuex";

export default {
    name: "Index",
    mounted() {
        this.$store.dispatch('getPosts')
    },
    computed: {
        ...mapGetters({
            'posts': 'posts',
            'loading': 'loading'
        })
    },

    components: {
        PreloaderComponent,
        PostFormComponent,
        PostListComponent
    }
}
</script>

<style scoped>
.no-items {
    background-color: rgba(0, 0, 0, 0.8);
    color: #00760f;
    padding: 15px;
}
</style>
