<template>
    <template v-if="comments" >
        <TransitionGroup name="list">
            <PostCommentItemsComponent
                v-for="comment in comments"
                :key="comment.id"
                :comment="comment">
            </PostCommentItemsComponent>
        </TransitionGroup>
        <div class="card custom-card my-2">
            <div class="card-body">
                <div class="row mb-3">
                    <label for="content" class="col-md-2 col-form-label text-md-end">Content</label>
                    <div class="col-md-8">
                        <textarea id="content" v-model.trim="content" type="text" class="form-control" name="content"></textarea>
                        <Transition name="fade">
                            <span v-if="contentError" class="text-green mt-2"> {{ contentError }} </span>
                        </Transition>
                    </div>
                </div>
            </div>
            <div @click.prevent="createComment" class="card-footer card-footer-green-btn">
                <span>Add comment</span>
            </div>
        </div>
    </template>
</template>

<script>
import PostCommentItemsComponent from "./PostCommentItemsComponent.vue";
export default {
    name: "PostCommentComponent",
    props: ['comments', 'post_id'],
    data() {
        return {
            content: null,
            contentError: null,
        }
    },
    computed: {},
    methods: {
        createComment() {
            if (!this.content) return this.contentError = 'Field content is required'
            if (this.content.length > 500) return this.contentError = 'Field`s max length is 500 symbols'

            this.$store.dispatch('createComment', {
                post_id : this.post_id,
                user_id: this.$store.getters.user.id,
                content: this.content
            })
            this.contentError = null
            this.content = null
        }
    },
    components: {
        PostCommentItemsComponent
    }
}
</script>

<style scoped>
.custom-card{
    border: none;
}
.list-item {
    display: inline-block;
    margin-right: 10px;
}

.list-enter-active,
.list-leave-active {
    transition: all 0.5s ease;
}

.list-enter-from,
.list-leave-to {
    opacity: 0;
    transform: translateY(30px);
}

.list-move {
    transition: transform 0.5s ease;
}
</style>
