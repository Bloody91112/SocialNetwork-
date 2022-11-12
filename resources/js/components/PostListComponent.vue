<template>
    <div class="posts-container">
        <div v-if="posts" class="posts">
            <TransitionGroup name="list">
                <PostItemComponent
                    v-for="post in posts"
                    :post="post"
                    :key="post.id">
                </PostItemComponent>
            </TransitionGroup>
        </div>
    </div>
</template>

<script>
import PostItemComponent from "./PostItemComponent.vue";

export default {
    name: "PostListComponent",
    props: ['posts'],
    methods: {},
    components: {
        PostItemComponent,

    }

}
</script>

<style scoped>

.posts-container {
    position: relative;
}

.list-item {
    display: inline-block;
    margin-right: 10px;
}

.list-enter-active,
.list-leave-active {
    transition: all 1s ease;
}

.list-enter-from,
.list-leave-to {
    opacity: 0;
    transform: translateY(30px);
}

.list-move {
    transition: transform 1s ease;
}
</style>
